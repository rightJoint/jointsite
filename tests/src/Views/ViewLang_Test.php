<?php
//php ./vendor/bin/phpunit tests/JointApp/Views/ViewLang_Test.php


class ViewLang_Test extends PHPUnit\Framework\TestCase
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

            'JointApp\Views\Modules\ModulesListView',

            //'JointApp\Views\Records\RecordListView',
            //'JointApp\Views\Records\RecordDetailView',

        );

        $docRoot = 'C:\OSPanel\domains\x-site.local';

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