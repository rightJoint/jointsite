<?php
//php ./vendor/bin/phpunit tests/Lang_Test.php

require_once __DIR__.'/JointApp/Controllers/JointApp_ControllerLang_Test.php';
require_once __DIR__.'/JointApp/Views/JointApp_ViewLang_Test.php';
require_once __DIR__.'/JointApp/Models/JointApp_ModelLang_Test.php';
require_once __DIR__.'/src/Controllers/Src_ControllerLang_Test.php';
require_once __DIR__.'/src/Views/Src_ViewLang_Test.php';
require_once __DIR__.'/src/Models/Src_ModelLang_Test.php';

class Lang_Test extends PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {

    }

    public function testCommon():void
    {
        $total = 6;
        $success = 0;

        try {
            $webViewCase = new JointApp_ControllerLang_Test();
            $webViewCase->testLang();
            $success++;
        }catch (Exception $e) {

        }

        try {
            $webViewCase = new JointApp_ViewLang_Test();
            $webViewCase->testLang();
            $success++;
        }catch (Exception $e) {

        }

        try {
            $webViewCase = new Src_ControllerLang_Test();
            $webViewCase->testLang();
            $success++;
        }catch (Exception $e) {

        }

        try {
            $webViewCase = new Src_ViewLang_Test();
            $webViewCase->testLang();
            $success++;
        }catch (Exception $e) {

        }

        try {
            $webViewCase = new JointApp_ModelLang_Test();
            $webViewCase->testLang();
            $success++;
        }catch (Exception $e) {

        }

        try {
            $webViewCase = new Src_ModelLang_Test();
            $webViewCase->testLang();
            $success++;
        }catch (Exception $e) {

        }

        $this->assertEquals($total, $success);
    }
}
