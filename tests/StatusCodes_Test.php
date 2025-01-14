<?php
//php ./vendor/bin/phpunit tests/StatusCodes_Test.php


class StatusCodes_Test extends PHPUnit\Framework\TestCase
{
    public $server_params;

    protected function setUp(): void
    {

    }

    public function testLang():void
    {
        echo "\nTestResponseCodes-START>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>\n";

        global $currentUser;
        $currentUser = new \JointApp\CurrentUser();
        //empty - default lang = "ru"
        $acceptableLangs = ['', 'en', 'ru',];

        $uriList = array(
            '/' => 200,

            '/xxx' => 404,

            '/siteman' => 403,

            '/test' => 200,
            '/test/records' => 200,
            '/test/tables' => 200,

            '/music' => 200,
            '/music/albums' => 200,
            '/music/tracks' => 200,

            '/user/signIn' => 200,
            '/user/signUp' => 200,
        );

        global $jointAppResponse;
        $jointAppResponse = new \JointApp\JointAppResponse();

        $domen = 'http://x-site.local';

        foreach ($acceptableLangs as $lang){
            $uri_lang = '';
            if(empty($lang)){
                echo "\ntestLang: TestDefaultLang\n";
            }else{
                $uri_lang = '/'.$lang;
                echo "\ntestLang: TestLang > ".$lang."\n";
            }

            foreach ($uriList as $checkUri => $expectedCode){
                $uri = $domen.$uri_lang.$checkUri;
                $http = curl_init($uri);
                curl_setopt($http, CURLOPT_RETURNTRANSFER, TRUE);
                curl_exec($http);
                $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);

                if($expectedCode == $http_status){
                    echo $uri.' expectedCode > '.$expectedCode.' - ok'."\n";
                }else{
                    echo $uri.' expectedCode > '.$expectedCode.' '.'responseCode > '.$http_status.' - fail'."\n";
                }
                $this->assertEquals($expectedCode, $http_status);
            }
        }
        echo "\nTestResponseCodes-END<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n";
    }
}