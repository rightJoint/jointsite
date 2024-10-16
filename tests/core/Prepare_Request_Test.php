<?php
//php ./vendor/bin/phpunit tests/core/Prepare_Request_Test.php
//docker compose run --build --rm server ./vendor/bin/phpunit tests/core/Prepare_Request_Test.php
//docker build -t php-docker-image-test --progress plain --no-cache --target test .

class Prepare_Request_Test extends PHPUnit\Framework\TestCase
{
    protected $runTestInSeparateProcess = TRUE;

    public $JointSite;

    protected function setUp(): void
    {
        global $env;
        $env= parse_ini_file('.env');

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

    function testRequestDefault()
    {
        global $request, $env;

        $this->JointSite->request_uri = "/test/migrationstest/migrationsList?xxx=yyy";
        $this->JointSite->jsPrepareRequest();

        $result_req = array(
            "routes_uri" => "/test/migrationstest/migrationsList?xxx=yyy",
            "routes_path" => "/test/migrationstest/migrationsList",
            "routes" => array(
                "", "test", "migrationstest", "migrationsList",
            ),
            "routes_ns" => array(
                "", "test", "migrationstest", "migrationsList",
            ),
        );

        $this->assertSame($result_req, $request);

        $this->assertEquals("/".$env["JOINT_SITE_USERS_DIR"], JOINT_SITE_USERS_DIR);
        $this->assertEquals($this->JointSite->document_root."/".$env["JOINT_SITE_CONFIG_DIR"], JOINT_SITE_CONF_DIR);
        $this->assertEquals($this->JointSite->document_root, JOINT_SITE_ROOT_DIR);

        $this->assertEquals($this->JointSite->document_root."/Application/LangFiles/Ru", JOINT_SITE_REQ_LANG);
        $this->assertEquals("Ru", JOINT_SITE_NS_LANG);
        $this->assertEquals("ru", JOINT_SITE_LW_LANG);
        $this->assertEquals("", JOINT_SITE_SL_LANG);
        $this->assertEquals("/test/migrationstest/migrationsList?xxx=yyy", JOINT_SITE_LP_LANG);
    }

    function testRequestEn()
    {
        global $request, $env;

        $this->JointSite->request_uri = "/en/test/migrationstest/migrationsList?xxx=yyy";
        $this->JointSite->jsPrepareRequest();

        $result_req = array(
            "routes_uri" => "/en/test/migrationstest/migrationsList?xxx=yyy",
            "routes_path" => "/en/test/migrationstest/migrationsList",
            "routes" => array(
                "", "en", "test", "migrationstest", "migrationsList",
            ),
            "routes_ns" => array(
                "", "test", "migrationstest", "migrationsList",
            ),
        );

        $this->assertSame($result_req, $request);

        $this->assertEquals("/".$env["JOINT_SITE_USERS_DIR"], JOINT_SITE_USERS_DIR);
        $this->assertEquals($this->JointSite->document_root."/".$env["JOINT_SITE_CONFIG_DIR"], JOINT_SITE_CONF_DIR);
        $this->assertEquals($this->JointSite->document_root, JOINT_SITE_ROOT_DIR);

        $this->assertEquals($this->JointSite->document_root."/Application/LangFiles/En", JOINT_SITE_REQ_LANG);
        $this->assertEquals("En", JOINT_SITE_NS_LANG);
        $this->assertEquals("en", JOINT_SITE_LW_LANG);
        $this->assertEquals("/en", JOINT_SITE_SL_LANG);
        $this->assertEquals("/test/migrationstest/migrationsList?xxx=yyy", JOINT_SITE_LP_LANG);
    }

    function testRequestRu()
    {
        global $request, $env;

        $this->JointSite->request_uri = "/ru/test/migrationstest/migrationsList?xxx=yyy";
        $this->JointSite->jsPrepareRequest();

        $result_req = array(
            "routes_uri" => "/ru/test/migrationstest/migrationsList?xxx=yyy",
            "routes_path" => "/ru/test/migrationstest/migrationsList",
            "routes" => array(
                "", "ru", "test", "migrationstest", "migrationsList",
            ),
            "routes_ns" => array(
                "", "test", "migrationstest", "migrationsList",
            ),
        );

        $this->assertSame($result_req, $request);

        $this->assertEquals("/".$env["JOINT_SITE_USERS_DIR"], JOINT_SITE_USERS_DIR);
        $this->assertEquals($this->JointSite->document_root."/".$env["JOINT_SITE_CONFIG_DIR"], JOINT_SITE_CONF_DIR);
        $this->assertEquals($this->JointSite->document_root, JOINT_SITE_ROOT_DIR);

        $this->assertEquals($this->JointSite->document_root."/Application/LangFiles/Ru", JOINT_SITE_REQ_LANG);
        $this->assertEquals("Ru", JOINT_SITE_NS_LANG);
        $this->assertEquals("ru", JOINT_SITE_LW_LANG);
        $this->assertEquals("/ru", JOINT_SITE_SL_LANG);
        $this->assertEquals("/test/migrationstest/migrationsList?xxx=yyy", JOINT_SITE_LP_LANG);
    }
}