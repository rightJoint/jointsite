<?php
//php ./vendor/bin/phpunit tests/core/AlertsTest.php

require_once "application/core/alerts/Alerts_model.php";
class AlertsTest extends PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        require_once "tests/setEnvir.php";
    }

    protected function tearDown(): void
    {

    }

    public function test_response_codes()
    {
        ob_start();

        $alertsModel = new Alerts_model();

        foreach ($alertsModel->response_codes as $err_type => $code){
            $url = "http://rj-test.local/test/testErr?errType=".$err_type."&message=test_response_codes-".$code;
            $http = curl_init($url);
            curl_exec($http);
            $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
            $this->assertEquals($code, $http_status);
        }

        curl_close($http);

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