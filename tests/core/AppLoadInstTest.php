<?php
//php ./vendor/bin/phpunit tests/core/AppLoadInstTest.php
//php ./vendor/bin/phpunit --stderr tests/core/AppLoadInstTest.php
//php ./vendor/bin/phpunit --debug tests/core/AppLoadInstTest.php
//php ./vendor/bin/phpunit --verbose -c tests/core/AppLoadInstTest.php
class AppLoadInstTest extends PHPUnit\Framework\TestCase
{
    //protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    protected function setUp(): void
    {
        global $document_root, $exec_dir;
        $document_root = "C:/OSPanel/domains/rj-test.local";
        $exec_dir = null; //mirror
        require_once "application/core/jointSite.php";
    }

    protected function tearDown(): void
    {

    }

    function test_run_err()
    {
        global $document_root, $request, $exec_dir;

        jointSite::jointSiteRun($exec_dir, $document_root,
            $exec_dir."/xxx/phpmysqladmin/printquery?test=1111");

        //jointSite::set_app_config();

        //$loaded_controller = jointSite::loadControllerFromRequest();
        //$this->assertEquals(false, $loaded_controller);

        //$loaded_model = jointSite::loadModelFromRequest();
        //$this->assertEquals("Model_pdo", $loaded_model);

        //$loaded_view = jointSite::loadViewFromRequest();
        //$this->assertEquals("SiteView", $loaded_view);

        //$loaded_view = jointSite::getActionFromRequest();
        //$this->assertEquals("SiteView", $loaded_view);
    }

    /*
    function test_contr_err()
    {
        global $document_root, $request, $exec_dir;

        jointSite::set_app_envir($exec_dir, $document_root,
            $exec_dir."/xxx/phpmysqladmin/printquery?test=1111");

        jointSite::set_app_config();

        $loaded_controller = jointSite::loadControllerFromRequest();
        $this->assertEquals(false, $loaded_controller);

        $loaded_model = jointSite::loadModelFromRequest();
        $this->assertEquals("Model_pdo", $loaded_model);

        $loaded_view = jointSite::loadViewFromRequest();
        $this->assertEquals("SiteView", $loaded_view);

        $loaded_view = jointSite::getActionFromRequest();
        $this->assertEquals("SiteView", $loaded_view);
    }
    */
/*
    function test_app_dir_ok_1()
    {
        global $document_root, $request;
        jointSite::set_app_envir(null, $document_root,
            "/test/phpmysqladmin/printquery?test=1111");

        $this->assertEquals(true, jointSite::checkAppDir());
    }

    function test_app_dir_fail_1()
    {
        global $document_root, $request;
        jointSite::set_app_envir("/mirror", $document_root,
            "/test/phpmysqladmin/printquery?test=1111");

        $this->assertEquals(false, jointSite::checkAppDir());
    }

    function test_load_phpmysqladmin_default()
    {
        global $document_root, $request, $exec_dir;

        jointSite::set_app_envir($exec_dir, $document_root,
            $exec_dir."/test/phpmysqladmin/printquery?test=1111");

        jointSite::set_app_config();

        $loaded_controller = jointSite::loadControllerFromRequest();
        $this->assertEquals("Controller_phpmysqladmin", $loaded_controller);

        $loaded_model = jointSite::loadModelFromRequest();
        $this->assertEquals("Model_test", $loaded_model);

        $loaded_view = jointSite::loadViewFromRequest();
        $this->assertEquals("View_test", $loaded_view);

        $action_name = jointSite::getActionFromRequest();
        $this->assertEquals("printquery", $action_name);
    }

    function test_load_phpmysqladmin_ru()
    {
        global $document_root, $request, $exec_dir;

        jointSite::set_app_envir($exec_dir, $document_root,
            $exec_dir."/ru/test/phpmysqladmin/printquery?test=1111");

        jointSite::set_app_config();

        $loaded_controller = jointSite::loadControllerFromRequest();
        $this->assertEquals("Controller_phpmysqladmin", $loaded_controller);

        $loaded_model = jointSite::loadModelFromRequest();
        $this->assertEquals("Model_test", $loaded_model);

        $loaded_view = jointSite::loadViewFromRequest();
        $this->assertEquals("View_test", $loaded_view);

        $action_name = jointSite::getActionFromRequest();
        $this->assertEquals("printquery", $action_name);
    }

    function test_load_xxx_default()
    {
        global $document_root, $request, $exec_dir;

        jointSite::set_app_envir($exec_dir, $document_root,
            $exec_dir."/test/xxx/phpmysqladmin/printquery?test=1111");

        jointSite::set_app_config();

        $loaded_controller = jointSite::loadControllerFromRequest();
        $this->assertEquals("Controller_test", $loaded_controller);

        $loaded_model = jointSite::loadModelFromRequest();
        $this->assertEquals("Model_test", $loaded_model);

        $loaded_view = jointSite::loadViewFromRequest();
        $this->assertEquals("View_test", $loaded_view);

        $action_name = jointSite::getActionFromRequest();
        $this->assertEquals("xxx", $action_name);
    }
*/
}