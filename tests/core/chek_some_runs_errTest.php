<?php
//php ./vendor/bin/phpunit tests/core/chek_some_runs_errTest.php
//php ./vendor/bin/phpunit --stderr tests/core/chek_some_runs_errTest.php
//php ./vendor/bin/phpunit --debug tests/core/chek_some_runs_errTest.php
//php ./vendor/bin/phpunit --verbose -c tests/core/chek_some_runs_errTest.php
class chek_some_runs_errTest extends PHPUnit\Framework\TestCase
{
    //protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    public $jointSite;
    public $test_exec_dir;

    protected function setUp(): void
    {
        global $env;

        $env = parse_ini_file('.env');

        require_once $env["JOINT_SITE_TEST_DIR"]."/application/core/jointSite.php";


        //$this->test_exec_dir = null;
        //global $document_root;
        //$document_root = "C:/OSPanel/domains/rj-test.local";
        //require_once "application/core/jointSite.php";

        $this->jointSite = $this->getMockBuilder('jointSite')->onlyMethods(array("js_config_dir", "js_HandleResult"))->getMock();
        $this->jointSite->expects($this->any())->method('js_config_dir')->willReturn('C:/OSPanel/domains/rj-test.local/__testconfig');
        $this->jointSite->expects($this->any())->method('js_HandleResult')->willReturn('Ok');
    }

    protected function tearDown(): void
    {

    }

    function test_run_err()
    {
        global $env, $js_result;

        $this->jointSite->js_Run($env["JOINT_SITE_EXEC_DIR"], $env["JOINT_SITE_TEST_DIR"],
            $env["JOINT_SITE_EXEC_DIR"]."/xxx/phpmysqladmin/printquery?test=1111");

        $expect_result = array(
            "error" => true,
            "errType" => "request",
            "message" => $this->jointSite->lang_map->app_err["request_controller"],
        );
        $this->assertSame($expect_result, $js_result);
    }
}