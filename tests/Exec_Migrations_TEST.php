<?php
//php ./vendor/bin/phpunit tests/Exec_Migrations_TEST.php
//php ./vendor/bin/phpunit --stderr tests/Exec_Migrations_TEST.php

//docker compose run --build --rm server ./vendor/bin/phpunit tests/Exec_Migrations_TEST.php

//docker build -t php-docker-image-test --progress plain --no-cache --target test .
//docker build -t php-docker-image-test --progress plain --target test .

use JointSite\Models\Migrations\Model_Migrations;

class Exec_Migrations_TEST extends PHPUnit\Framework\TestCase
{
    protected $runTestInSeparateProcess = TRUE;

    public $JointSite;

    protected function setUp(): void
    {

    }

    protected function tearDown(): void
    {

    }

    function testExecMigrations()
    {
        global $jointAppResponse;

        $jointAppResponse = new \JointApp\JointAppResponse();
        $docRoot = 'C:\OSPanel\domains\x-site.local';
        $configDir = 'C:\OSPanel\domains\x-site.local\src\__config';
        $model = new JointApp\Models\Migrations\Model_Migrations($docRoot, $configDir);

        $update_rsf = false;
        if(!$model->connect_database_status){
            $model->checkDatabase();
            $update_rsf = true;
        }
        $this->assertEquals($model->connect_database_status, true);

        if($model->connect_database_status){
            if($update_rsf){
                $model = new JointApp\Models\Migrations\Model_Migrations($docRoot, $configDir);;
            }
            $exec_res = $model->exec_new_migrations();

            if($exec_res['result'] == true){
                echo 'execNewMigrations: Success'."\n".
                    'count_total = '.$exec_res['count_total'].' vs count_success = '.$exec_res['count_success']."\n";
            }elseif(($exec_res["count_total"] != $exec_res["count_success"]) and $exec_res["result"] == false){
                echo 'execNewMigrations: Fail, total count = '.$exec_res['count_total'].
                    'success count = '.$exec_res['count_success'];
            }else{
                echo 'execNewMigrations: Fail, db conn problem '."\n".$exec_res['count_total'].' vs '.$exec_res['count_success'];
            }

            $this->assertEquals($exec_res["count_total"], $exec_res["count_success"]);
            $this->assertEquals($exec_res["result"], true);
        }
    }
}