<?php
//php ./vendor/bin/phpunit tests/Src/Controllers/ControllerLang_Test.php


class ControllerLang_Test extends PHPUnit\Framework\TestCase
{
    public $server_params;

    protected function setUp(): void
    {

    }

    public function testLang():void
    {
        echo "\nControllerTestLang-START>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>\n";

        global $currentUser;
        $currentUser = new \JointApp\CurrentUser();
        //empty - default lang = "ru"
        $acceptableLangs = ['', 'en', 'ru',];

        $controllerCheckList = array(
            'Src\Controllers\Controller_Music',
            'Src\Controllers\Controller_Music_Alb',
            'Src\Controllers\Controller_Music_Tracks',
            'Src\Controllers\Controller_Test',
            'Src\Controllers\Controller_User',

            'Src\Controllers\Test\Controller_Test_MigrationsTest',
            'Src\Controllers\Test\Controller_Test_Tables',

        );

        $docRoot = 'C:\OSPanel\domains\x-site.local\src';

        global $jointAppResponse;
        $jointAppResponse = new \JointApp\JointAppResponse();

        $model = new \JointApp\Models\Model();
        $view_tmp = new \JointApp\Views\View();

        //create server request from server params
        $factory = new \JointFramework\Http\ServerRequestFactory();

        $serverParams['DOCUMENT_ROOT'] = $docRoot;

        foreach ($acceptableLangs as $lang){
            $uri_lang = '';
            if(empty($lang)){
                echo "\ntestLang: TestDefaultLang\n";
            }else{
                $uri_lang = '/'.$lang;
                echo "\ntestLang: TestLang > ".$lang."\n";
            }

            $uri = new \JointFramework\Http\Uri('http://rightjoint.com:8080'.$uri_lang.'/xxx/yyy/iii');
            $request = $factory->createServerRequest('GET', $uri, $serverParams);
            $jointAppRequest = \JointApp\JointSite::requestAdapter($request);

            foreach ($controllerCheckList as $namespace){
                $controller = new $namespace($jointAppRequest, $model,
                    $view_tmp, []);
                echo $namespace.' '.$jointAppRequest->langNs.' - ok'."\n";
            }
        }
        $testComplete = 1;
        $this->assertEquals(1, $testComplete);

        echo "\nControllerTestLang-END<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n";
    }
}