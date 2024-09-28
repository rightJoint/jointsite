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
        global $env;
        $env= parse_ini_file('.env');

        require_once $env["JOINT_SITE_TEST_ROOT"]."/application/core/jointSite.php";

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

    function test_request_default()
    {
        global $request, $env;

        $this->jointSite->request_uri = "/test/phpmysqladmin/printquery?test=1111";
        $this->jointSite->js_PrepareRequest();

        $result_req = array(
            "routes_uri" => "/test/phpmysqladmin/printquery?test=1111",
            "routes_path" => "/test/phpmysqladmin/printquery",
            "routes" => array(
                "", "test", "phpmysqladmin", "printquery",
            ),
            "routes_cnt" => 4,
        );

        $this->assertSame($result_req, $request);

        $this->assertEquals($this->jointSite->document_root, JOINT_SITE_REQUIRE_DIR);
        $this->assertEquals($this->jointSite->document_root."/application/lang_files/ru", JOINT_SITE_REQ_LANG);
        $this->assertEquals("ru", JOINT_SITE_APP_LANG);
        $this->assertEquals(null, JOINT_SITE_APP_REF);
        $this->assertEquals("/test/phpmysqladmin/printquery?test=1111", JOINT_SITE_REQ_ROOT);
        $this->assertEquals($this->jointSite->document_root."/".$env["JOINT_SITE_CONFIG_DIR"], JOINT_SITE_CONF_DIR);
        $this->assertEquals($this->jointSite->document_root."/".$env["JOINT_SITE_USERS_DIR"], JOINT_SITE_USERS_DIR);


    }

    function test_request_en()
    {
        global $request, $env;

        $this->jointSite->request_uri = "/en/test/phpmysqladmin/printquery?test=1111";
        $this->jointSite->js_PrepareRequest();

        $result_req = array(
            "routes_uri" => "/en/test/phpmysqladmin/printquery?test=1111",
            "routes_path" => "/en/test/phpmysqladmin/printquery",
            "routes" => array(
                "", "test", "phpmysqladmin", "printquery",
            ),
            "routes_cnt" => 4,
        );

        $this->assertSame($result_req, $request);

        $this->assertEquals($this->jointSite->document_root, JOINT_SITE_REQUIRE_DIR);
        $this->assertEquals($this->jointSite->document_root."/application/lang_files/en", JOINT_SITE_REQ_LANG);
        $this->assertEquals("en", JOINT_SITE_APP_LANG);
        $this->assertEquals("/en", JOINT_SITE_APP_REF);
        $this->assertEquals("/test/phpmysqladmin/printquery?test=1111", JOINT_SITE_REQ_ROOT);
        $this->assertEquals($this->jointSite->document_root."/".$env["JOINT_SITE_CONFIG_DIR"], JOINT_SITE_CONF_DIR);
        $this->assertEquals($this->jointSite->document_root."/".$env["JOINT_SITE_USERS_DIR"], JOINT_SITE_USERS_DIR);
    }

    function test_request_ru()
    {
        global $request, $env;

        $this->jointSite->request_uri = "/ru/test/phpmysqladmin/printquery?test=1111";
        $this->jointSite->js_PrepareRequest();

        $result_req = array(
            "routes_uri" => "/ru/test/phpmysqladmin/printquery?test=1111",
            "routes_path" => "/ru/test/phpmysqladmin/printquery",
            "routes" => array(
                "", "test", "phpmysqladmin", "printquery",
            ),
            "routes_cnt" => 4,
        );

        $this->assertSame($result_req, $request);

        $this->assertEquals($this->jointSite->document_root, JOINT_SITE_REQUIRE_DIR);
        $this->assertEquals($this->jointSite->document_root."/application/lang_files/ru", JOINT_SITE_REQ_LANG);
        $this->assertEquals("ru", JOINT_SITE_APP_LANG);
        $this->assertEquals("/ru", JOINT_SITE_APP_REF);
        $this->assertEquals("/test/phpmysqladmin/printquery?test=1111", JOINT_SITE_REQ_ROOT);
        $this->assertEquals($this->jointSite->document_root."/".$env["JOINT_SITE_CONFIG_DIR"], JOINT_SITE_CONF_DIR);
        $this->assertEquals($this->jointSite->document_root."/".$env["JOINT_SITE_USERS_DIR"], JOINT_SITE_USERS_DIR);
    }
}