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
        global $env;
        $env = parse_ini_file('.env');

        $this->JointSite = $this->getMockBuilder('JointSite\Core\JointSite')
            ->onlyMethods(array("jsGetEnv"))
            //->setConstructorArgs(['2021-03-08'])
            ->getMock();
        $this->JointSite->expects($this->once())
            ->method('jsGetEnv')
            ->willReturn($env);

        $this->JointSite->document_root = $env["JOINT_SITE_TEST_ROOT"];

    }

    protected function tearDown(): void
    {

    }

    function testExecMigration()
    {
        $this->JointSite->request_uri = "/test/phpmysqladmin/printquery?test=1111";
        $this->JointSite->jsPrepareRequest();

        $migrations_model = new Model_Migrations();

        $update_rsf = false;
        if(!$migrations_model->connect_database_status){
            $migrations_model->checkDatabase();
            $update_rsf = true;
        }

        $this->assertEquals($migrations_model->connect_database_status, true);

        if($migrations_model->connect_database_status){
            if($update_rsf){
                $migrations_model = new Model_Migrations();
            }

            $exec_res = $migrations_model->exec_new_migrations();
        }

        echo "count_total = ".$exec_res["count_total"]." vs count_success = ".$exec_res["count_success"]."\n";

        echo $migrations_model->conn_db;

        $this->assertEquals($exec_res["count_total"], $exec_res["count_success"]);
        $this->assertEquals($exec_res["result"], true);
    }
}