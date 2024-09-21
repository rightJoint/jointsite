<?php
//php ./vendor/bin/phpunit tests/core/AppEnvirTest.php
//php ./vendor/bin/phpunit --stderr tests/core/AppEnvirTest.php
    //php ./vendor/bin/phpunit --debug tests/core/AppEnvir.php
    //php ./vendor/bin/phpunit --verbose -c tests/core/AppEnvir.php
class AppEnvirTest extends PHPUnit\Framework\TestCase
{
    //protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    public $jointSite;

    protected function setUp(): void
    {
        global $document_root;
        $document_root = "C:/OSPanel/domains/rj-test.local";
        require_once "application/core/jointSite.php";
        $this->jointSite = $this->getMockBuilder('jointSite')->onlyMethods(array("js_config_dir"))->getMock();
        //$this->createMock("jointSite");
        $this->jointSite->expects($this->any())->method('js_config_dir')->willReturn('geralt.of.rivia');
            //->expects($this->once())
            //->method('js_config_dir')
            //->with($featureName, $context)
           // ->willReturn("xa-xa-xa");
        //$this->jointSite->method('js_config_dir')
        //    ->willReturn('foo');

        /*$this->jointSite = $this->createStub("jointSite");
        $this->jointSite->method('js_config_dir')
            ->willReturn('foo');
        */
         //   ->willReturn('foo');
        //$stub->expects($this->any())
        //    ->method('doSomething')
        //    ->will($this->returnCallback('callback'));

        //$this->jointSite = $this->getMockBuilder('ntSendModel')->onlyMethods(array("js_config_dir"))->getMock();



        //$this->jointSite->expects($this->once())->method("sendOnEmail");
    }

    protected function tearDown(): void
    {

    }

    function test_request_main_default()
    {
        global $document_root, $request;

        $this->jointSite = $this->createStub("jointSite");
        $this->jointSite->method('js_config_dir')
            ->willReturn(['foo']);

        //$jointSite = new jointSite();
        //$jointSite = $this->createMock(jointSite::class);
       // $jointSite->method('js_config_dir')
       //     ->willReturn('xxxx');
        //$test_site = new jointSite();

        //$jointSite =


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
            "exec_path" => null,
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
        $this->assertEquals("__xxxx", JOINT_SITE_CONF_DIR);


    }

    /*
    function test_request_main_en()
    {
        global $document_root, $request;

        $test_site = new jointSite();

        $test_site->js_PrepareRequest(null, $document_root,
            "/en/test/phpmysqladmin/printquery?test=1111");

        $result_req = array(
            "routes_uri" => "/en/test/phpmysqladmin/printquery?test=1111",
            "routes_path" => "/en/test/phpmysqladmin/printquery",
            "routes" => array(
                "", "test", "phpmysqladmin", "printquery",
            ),
            "exec_dir" => array(""),
            "routes_cnt" => 4,
            "exec_path" => null,
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

        $test_site = new jointSite();

        $test_site->js_PrepareRequest(null, $document_root,
            "/ru/test/phpmysqladmin/printquery?test=1111");

        $result_req = array(
            "routes_uri" => "/ru/test/phpmysqladmin/printquery?test=1111",
            "routes_path" => "/ru/test/phpmysqladmin/printquery",
            "routes" => array(
                "", "test", "phpmysqladmin", "printquery",
            ),
            "exec_dir" => array(""),
            "routes_cnt" => 4,
            "exec_path" => null,
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

        $test_site = new jointSite();

        $test_site->js_PrepareRequest("/mirror", $document_root,
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
        $this->assertEquals("/mirror/test/phpmysqladmin/printquery?test=1111", JOINT_SITE_REQ_ROOT);
        $this->assertEquals("mirror", JS_SAIK);
    }

    function test_request_mirror_en()
    {
        global $document_root, $request;

        $test_site = new jointSite();

        $test_site->js_PrepareRequest("/mirror", $document_root,
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
        $this->assertEquals("/mirror/test/phpmysqladmin/printquery?test=1111", JOINT_SITE_REQ_ROOT);
        $this->assertEquals("mirror", JS_SAIK);
    }

    function test_request_mirror_ru()
    {
        global $document_root, $request;

        $test_site = new jointSite();

        $test_site->js_PrepareRequest("/mirror", $document_root,
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

        $this->assertEquals("/mirror", JOINT_SITE_EXEC_DIR);
        $this->assertEquals("C:/OSPanel/domains/rj-test.local/mirror", JOINT_SITE_REQUIRE_DIR);
        $this->assertEquals("C:/OSPanel/domains/rj-test.local/mirror/application/lang_files/ru", JOINT_SITE_REQ_LANG);
        $this->assertEquals("ru", JOINT_SITE_APP_LANG);
        $this->assertEquals("/ru", JOINT_SITE_APP_REF);
        $this->assertEquals("/mirror/test/phpmysqladmin/printquery?test=1111", JOINT_SITE_REQ_ROOT);
        $this->assertEquals("mirror", JS_SAIK);
    }
*/
}