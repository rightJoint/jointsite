<?php
//php ./vendor/bin/phpunit tests/JointApp/Views/JointApp_ViewLang_Test.php


class JointApp_ViewLang_Test extends PHPUnit\Framework\TestCase
{
    public $server_params;

    protected function setUp(): void
    {

    }

    public function testLang():void
    {
        echo "\ntestLang-START>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>\n";

        global $currentUser;
        $currentUser = new \JointApp\CurrentUser();
        //empty - default lang = "ru"
        $acceptableLangs = ['', 'en', 'ru',];

        $viewCheckList = array(
            'JointApp\Views\WebView',
            'JointApp\Views\SiteView',

            'JointApp\Views\ErrorsView',

            'JointApp\Views\Records\RecordView',
            'JointApp\Views\Records\RecordListView',
            'JointApp\Views\Records\RecordDetailView',
            'JointApp\Views\Records\RecordEditView',

            'JointApp\Views\Modules\ModulesListView',
            'JointApp\Views\Modules\ModuleListView',
            'JointApp\Views\Modules\ModuleDetailView',
            'JointApp\Views\Modules\ModuleEditView',

            'JointApp\Views\User\View_User_SignIn',
            'JointApp\Views\User\View_User_SignUp',
            'JointApp\Views\User\View_User_Main',
            'JointApp\Views\User\View_User_Email',
            'JointApp\Views\User\View_User_Groups',
            'JointApp\Views\User\View_User_NtfDetail',
            'JointApp\Views\User\View_User_NtfList',
            'JointApp\Views\User\View_User_Password',

        );

        $docRoot = 'C:/OSPanel/domains/x-site.local';

        $totalTime = 0;
        $testCounter = 0;

        global $jointAppResponse;
        $jointAppResponse = new \JointApp\JointAppResponse();
        $jointAppResponse->customLog[]['debug'] = 'test debug';
        $jointAppResponse->customLog[]['notice'] = '1test notice';
        $jointAppResponse->customLog[]['info'] = '2test info';
        $jointAppResponse->customLog[]['info'] = '3test info';

        foreach ($acceptableLangs as $viewLang){
            if(empty($viewLang)){
                echo "\ntestLang: TestDefaultLang\n";
            }else{
                echo "\ntestLang: TestLang > ".$viewLang."\n";
            }
            foreach ($viewCheckList as $namespace){
                $testCounter++;
                $view = new $namespace($docRoot, $viewLang);
                $view->createResponseText();
                $runTime = $view->getViewTime();
                echo $namespace.': runTime = '.$runTime."\n";
                $totalTime+=$runTime;
                $this->assertLessThan(
                    0.1,
                    $runTime,
                    "actual value is not less than expected"
                );
            }
        }
       //var_dump($jointAppResponse->stopwatch);
        echo "\nAppViewTest-RESULTS-------------------------\n";
        echo "testCounter: ".$testCounter.", totalTime: ".$totalTime."\n";
        $this->assertLessThan(
            1.0,
            $totalTime,
            "actual value is not less than expected"
        );
        echo "\ntestLang-END<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n";
    }
}