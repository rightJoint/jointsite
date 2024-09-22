<?php
//php ./vendor/bin/phpunit tests/core/js_prepare_request_Test.php
//php ./vendor/bin/phpunit --stderr tests/core/js_prepare_request_Test.php
//php ./vendor/bin/phpunit --debug tests/core/js_prepare_request_Test.php
//php ./vendor/bin/phpunit --verbose -c tests/core/js_prepare_request_Test.php
class js_prepare_request_Test extends PHPUnit\Framework\TestCase
{
    protected $runTestInSeparateProcess = TRUE;

    public $jointSite;

    protected function setUp(): void
    {
        global $document_root;
        $document_root = "C:/OSPanel/domains/rj-test.local";
        require_once "application/core/jointSite.php";
        $this->jointSite = $this->getMockBuilder('jointSite')->onlyMethods(array("js_config_dir"))->getMock();
        $this->jointSite->expects($this->any())->method('js_config_dir')->willReturn('C:/OSPanel/domains/rj-test.local/__testconfig');
    }

    protected function tearDown(): void
    {

    }

    function test_request_main_default()
    {
        global $document_root, $request;

        $this->jointSite->js_PrepareRequest(null, $document_root,
            "/test/phpmysqladmin/printquery?test=1111");

        $result_req = array(
            "routes_uri" => "/test/phpmysqladmin/printquery?test=1111",
            "routes_path" => "/test/phpmysqladmin/printquery",
            "routes" => array(
                "", "test", "phpmysqladmin", "printquery",
            ),
            "exec_dir" => array(""),
            "routes_cnt" => 4,
            "exec_path" => "",
            "exec_dir_cnt" => 1,
            "diff_cnt" => 3,
        );

        $this->assertSame($result_req, $request);

        $this->assertEquals(null, JOINT_SITE_EXEC_DIR);
        $this->assertEquals("C:/OSPanel/domains/rj-test.local", JOINT_SITE_REQUIRE_DIR);
        $this->assertEquals("C:/OSPanel/domains/rj-test.local/application/lang_files/ru", JOINT_SITE_REQ_LANG);
        $this->assertEquals("ru", JOINT_SITE_APP_LANG);
        $this->assertEquals(null, JOINT_SITE_APP_REF);
        $this->assertEquals("/test/phpmysqladmin/printquery?test=1111", JOINT_SITE_REQ_ROOT);
        $this->assertEquals("main", JS_SAIK);
        $this->assertEquals("C:/OSPanel/domains/rj-test.local/__testconfig", JOINT_SITE_CONF_DIR);


    }

    function test_request_main_en()
    {
        global $document_root, $request;

        $this->jointSite->js_PrepareRequest(null, $document_root,
            "/en/test/phpmysqladmin/printquery?test=1111");

        $result_req = array(
            "routes_uri" => "/en/test/phpmysqladmin/printquery?test=1111",
            "routes_path" => "/en/test/phpmysqladmin/printquery",
            "routes" => array(
                "", "test", "phpmysqladmin", "printquery",
            ),
            "exec_dir" => array(""),
            "routes_cnt" => 4,
            "exec_path" => "",
            "exec_dir_cnt" => 1,
            "diff_cnt" => 4,
        );

        $this->assertSame($result_req, $request);

        $this->assertEquals(null, JOINT_SITE_EXEC_DIR);
        $this->assertEquals("C:/OSPanel/domains/rj-test.local", JOINT_SITE_REQUIRE_DIR);
        $this->assertEquals("C:/OSPanel/domains/rj-test.local/application/lang_files/en", JOINT_SITE_REQ_LANG);
        $this->assertEquals("en", JOINT_SITE_APP_LANG);
        $this->assertEquals("/en", JOINT_SITE_APP_REF);
        $this->assertEquals("/test/phpmysqladmin/printquery?test=1111", JOINT_SITE_REQ_ROOT);
        $this->assertEquals("main", JS_SAIK);
    }

    function test_request_main_ru()
    {
        global $document_root, $request;

        $this->jointSite->js_PrepareRequest(null, $document_root,
            "/ru/test/phpmysqladmin/printquery?test=1111");

        $result_req = array(
            "routes_uri" => "/ru/test/phpmysqladmin/printquery?test=1111",
            "routes_path" => "/ru/test/phpmysqladmin/printquery",
            "routes" => array(
                "", "test", "phpmysqladmin", "printquery",
            ),
            "exec_dir" => array(""),
            "routes_cnt" => 4,
            "exec_path" => "",
            "exec_dir_cnt" => 1,
            "diff_cnt" => 4,
        );

        $this->assertSame($result_req, $request);

        $this->assertEquals(null, JOINT_SITE_EXEC_DIR);
        $this->assertEquals("C:/OSPanel/domains/rj-test.local", JOINT_SITE_REQUIRE_DIR);
        $this->assertEquals("C:/OSPanel/domains/rj-test.local/application/lang_files/ru", JOINT_SITE_REQ_LANG);
        $this->assertEquals("ru", JOINT_SITE_APP_LANG);
        $this->assertEquals("/ru", JOINT_SITE_APP_REF);
        $this->assertEquals("/test/phpmysqladmin/printquery?test=1111", JOINT_SITE_REQ_ROOT);
        $this->assertEquals("main", JS_SAIK);
    }

    function test_request_mirror_default()
    {
        global $document_root, $request;

        $this->jointSite->js_PrepareRequest("/mirror", $document_root,
            "/mirror/test/phpmysqladmin/printquery?test=1111");

        $result_req = array(
            "routes_uri" => "/mirror/test/phpmysqladmin/printquery?test=1111",
            "routes_path" => "/mirror/test/phpmysqladmin/printquery",
            "routes" => array(
                "", "mirror", "test", "phpmysqladmin", "printquery",
            ),
            "exec_dir" => array("", "mirror"),
            "routes_cnt" => 5,
            "exec_path" => "/mirror",
            "exec_dir_cnt" => 2,
            "diff_cnt" => 3,
        );

        $this->assertSame($result_req, $request);

        $this->assertEquals("/mirror", JOINT_SITE_EXEC_DIR);
        $this->assertEquals("C:/OSPanel/domains/rj-test.local/mirror", JOINT_SITE_REQUIRE_DIR);
        $this->assertEquals("C:/OSPanel/domains/rj-test.local/mirror/application/lang_files/ru", JOINT_SITE_REQ_LANG);
        $this->assertEquals("ru", JOINT_SITE_APP_LANG);
        $this->assertEquals(null, JOINT_SITE_APP_REF);
        $this->assertEquals("/test/phpmysqladmin/printquery?test=1111", JOINT_SITE_REQ_ROOT);
        $this->assertEquals("mirror", JS_SAIK);
    }

    function test_request_mirror_en()
    {
        global $document_root, $request;

        $this->jointSite->js_PrepareRequest("/mirror", $document_root,
            "/mirror/en/test/phpmysqladmin/printquery?test=1111");

        $result_req = array(
            "routes_uri" => "/mirror/en/test/phpmysqladmin/printquery?test=1111",
            "routes_path" => "/mirror/en/test/phpmysqladmin/printquery",
            "routes" => array(
                "", "mirror", "test", "phpmysqladmin", "printquery",
            ),
            "exec_dir" => array("", "mirror"),
            "routes_cnt" => 5,
            "exec_path" => "/mirror",
            "exec_dir_cnt" => 2,
            "diff_cnt" => 4,
        );

        $this->assertSame($result_req, $request);

        $this->assertEquals("/mirror", JOINT_SITE_EXEC_DIR);
        $this->assertEquals("C:/OSPanel/domains/rj-test.local/mirror", JOINT_SITE_REQUIRE_DIR);
        $this->assertEquals("C:/OSPanel/domains/rj-test.local/mirror/application/lang_files/en", JOINT_SITE_REQ_LANG);
        $this->assertEquals("en", JOINT_SITE_APP_LANG);
        $this->assertEquals("/en", JOINT_SITE_APP_REF);
        $this->assertEquals("/test/phpmysqladmin/printquery?test=1111", JOINT_SITE_REQ_ROOT);
        $this->assertEquals("mirror", JS_SAIK);
    }

    function test_request_mirror_ru()
    {
        global $document_root, $request;

        $this->jointSite->js_PrepareRequest("/mirror", $document_root,
            "/mirror/ru/test/phpmysqladmin/printquery?test=1111");

        $result_req = array(
            "routes_uri" => "/mirror/ru/test/phpmysqladmin/printquery?test=1111",
            "routes_path" => "/mirror/ru/test/phpmysqladmin/printquery",
            "routes" => array(
                "", "mirror", "test", "phpmysqladmin", "printquery",
            ),
            "exec_dir" => array("", "mirror"),
            "routes_cnt" => 5,
            "exec_path" => "/mirror",
            "exec_dir_cnt" => 2,
            "diff_cnt" => 4,
        );

        $this->assertSame($result_req, $request);

        $this->assertEquals("/mirror", JOINT_SITE_EXEC_DIR);
        $this->assertEquals("C:/OSPanel/domains/rj-test.local/mirror", JOINT_SITE_REQUIRE_DIR);
        $this->assertEquals("C:/OSPanel/domains/rj-test.local/mirror/application/lang_files/ru", JOINT_SITE_REQ_LANG);
        $this->assertEquals("ru", JOINT_SITE_APP_LANG);
        $this->assertEquals("/ru", JOINT_SITE_APP_REF);
        $this->assertEquals("/test/phpmysqladmin/printquery?test=1111", JOINT_SITE_REQ_ROOT);
        $this->assertEquals("mirror", JS_SAIK);
    }
}