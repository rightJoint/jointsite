<?php
//php ./vendor/bin/phpunit tests/src/Models/Src_ModelLang_Test.php


class Src_ModelLang_Test extends PHPUnit\Framework\TestCase
{
    public $server_params;

    protected function setUp(): void
    {

    }

    public function testLang():void
    {
        echo "\nModelsTestLang-START>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>\n";

        global $currentUser;
        $currentUser = new \JointApp\CurrentUser();
        $acceptableLangs = ['', 'en', 'ru',];

        $modelsCheckList = array(
            'Src\Models\Model_User',

            'Src\Models\Test\Model_Test_Tables',
        );

        $docRoot = 'C:/OSPanel/domains/x-site.local/src';
        $configDir = $docRoot.'/__config';
        global $jointAppResponse;
        $jointAppResponse = new \JointApp\JointAppResponse();

        foreach ($acceptableLangs as $lang){

            if(empty($lang)){
                $modelLang = 'ru';
                echo "\ntestLang: TestDefaultLang\n";
            }else{
                $modelLang = $lang;
                echo "\ntestLang: TestLang > ".$lang."\n";
            }

            foreach ($modelsCheckList as $namespace){
                $model = new $namespace($docRoot, $configDir, [], $modelLang);
                echo $namespace.' '.$modelLang.' - ok'."\n";
            }
        }
        $testComplete = 1;
        $this->assertEquals(1, $testComplete);

        echo "\nModelsTestLang-END<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n";
    }
}