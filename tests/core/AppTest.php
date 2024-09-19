<?php
//php ./vendor/bin/phpunit tests/core/AppTest.php
//php ./vendor/bin/phpunit --stderr tests/core/AppTest.php
    //php ./vendor/bin/phpunit --debug tests/core/AppTest.php
    //php ./vendor/bin/phpunit --verbose -c tests/core/AppTest.php
class AppTest extends PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        //@session_start();
        global $test_settings;
        $test_settings = array(
            "JOINT_SITE_EXEC_DIR" => "/mirror",
            "DOCUMENT_ROOT" => "C:/OSPanel/domains/rj-test.local",
            "REQUEST_URI" => "/ru",
        );
        require_once "application/core/jointSite.php";
    }

    protected function tearDown(): void
    {

    }

    public function test_app_request()
    {
        ob_start();

        global $test_settings, $request;
        //jointSite::test();
        jointSite::jointSiteRun($test_settings["JOINT_SITE_EXEC_DIR"], $test_settings["DOCUMENT_ROOT"],
            $test_settings["REQUEST_URI"]);
        //jointSite::jointSiteRun(
        //if($request == 2){
        //    fwrite(STDERR, print_r("YYYYYYYY", true));
        //}else{
            fwrite(STDERR, print_r(JS_SAIK, true));
        //}
        //echo ;


        //print_r($request);

        //$alertsModel = new Alerts_model();

        //foreach ($alertsModel->response_codes as $err_type => $code){
        //    $url = "http://rj-test.local/test/testErr?errType=".$err_type."&message=test_response_codes-".$code;
        //    $http = curl_init($url);
        //    curl_exec($http);
        //    $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
        //    $this->assertEquals($code, $http_status);
        //}

        //curl_close($http);

        //echo $http_status;

        //$mock = $this->getMockBuilder('Alerts_controller')
        //    ->setMethods(array("send_response_code"))
        //    ->setConstructorArgs(array())
        //    ->setMockClassName('')
            // отключив вызов конструктора, можно получить Mock объект "одиночки"
        //    ->disableOriginalConstructor()
//            ->disableOriginalClone()
  //          ->disableAutoload()
    //        ->getMock();
      //  $mock->expects($this->once())->method('send_response_code');

       // jointSite::throwErr("notFound", "AlertsTest - throwErr not found");

        //echo "xaxaxaxa";




        //$this->assertEquals(404, http_response_code());
    }
}