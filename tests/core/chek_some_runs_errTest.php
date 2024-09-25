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
        $env["JOINT_SITE_EXEC_DIR"] = null;

        require_once $env["JOINT_SITE_TEST_DIR"]."/application/core/jointSite.php";

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

        $this->assertSame(true, $js_result["error"]);
        $this->assertSame("request", $js_result["errType"]);
    }
}