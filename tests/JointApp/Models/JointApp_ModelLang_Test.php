<?php
//php ./vendor/bin/phpunit tests/JointApp/Models/JointApp_ModelLang_Test.php


class JointApp_ModelLang_Test extends PHPUnit\Framework\TestCase
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
            'JointApp\Models\Model_Pdo',

            'JointApp\Models\Records\RecordsModel',

            'JointApp\Models\ModuleModel',

            'JointApp\Models\Migrations\Model_Migrations',
            'JointApp\Models\Migrations\Model_MigrationsLog',

            'JointApp\Models\Components\Model_Components_Groups',
            'JointApp\Models\Components\Model_Components_MusicAlb',
            'JointApp\Models\Components\Model_Components_MusicTracks',
            'JointApp\Models\Components\Model_Components_MusicTracksToAlb',
            'JointApp\Models\Components\Model_Components_NtfList',
            'JointApp\Models\Components\Model_Components_NtfRead',
            'JointApp\Models\Components\Model_Components_NtfTemplates',
            'JointApp\Models\Components\Model_Components_User',
            'JointApp\Models\Components\Model_Components_UsersToGroups',
        );

        $docRoot = 'C:/OSPanel/domains/x-site.local';
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