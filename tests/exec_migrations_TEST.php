<?php
//php ./vendor/bin/phpunit tests/exec_migrations_TEST.php
//php ./vendor/bin/phpunit --stderr tests/exec_migrations_TEST.php
class exec_migrations_TEST extends PHPUnit\Framework\TestCase
{
    protected $runTestInSeparateProcess = TRUE;

    public $jointSite;

    protected function setUp(): void
    {
        global $env;
        $env = parse_ini_file('.env');

        require_once $env["JOINT_SITE_TEST_ROOT"] . "/application/core/jointSite.php";

        $this->jointSite = $this->getMockBuilder('jointSite')
            ->onlyMethods(array("js_get_env"))
            //->setConstructorArgs(['2021-03-08'])
            ->getMock();
        $this->jointSite->expects($this->once())
            ->method('js_get_env')
            ->willReturn($env);

        $this->jointSite->document_root = $env["JOINT_SITE_TEST_ROOT"];

    }

    protected function tearDown(): void
    {

    }

    function test_exec_migration()
    {
        $this->jointSite->request_uri = "/test/phpmysqladmin/printquery?test=1111";
        $this->jointSite->js_PrepareRequest();

        require_once JOINT_SITE_REQUIRE_DIR."/application/core/Model_pdo.php";
        require_once JOINT_SITE_REQUIRE_DIR."/application/core/RecordsModel.php";
        require_once JOINT_SITE_REQUIRE_DIR."/application/models/migrations/model_migrations.php";
        require_once JOINT_SITE_REQUIRE_DIR."/application/models/migrations/model_migrations_log.php";

        $migrations_model = new model_migrations();

        $update_rsf = false;
        if(!$migrations_model->connect_database_status){
            $migrations_model->check_database();
            $update_rsf = true;
        }

        $this->assertEquals($migrations_model->connect_database_status, true);

        if($migrations_model->connect_database_status){
            if($update_rsf){
                $migrations_model = new model_migrations();
            }

            $exec_res = $migrations_model->exec_new_migrations();
        }

        echo "count_total = ".$exec_res["count_total"]." vs count_success = ".$exec_res["count_success"]."\n";

        $this->assertEquals($exec_res["count_total"], $exec_res["count_success"]);
        $this->assertEquals($exec_res["result"], true);
    }
}