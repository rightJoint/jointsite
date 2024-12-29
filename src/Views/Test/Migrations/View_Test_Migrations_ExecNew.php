<?php

namespace Src\Views\Test\Migrations;

use JointApp\Interfaces\LangWebViewInterface;

class View_Test_Migrations_ExecNew extends View_Test_Migrations
{
    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_Test_Migrations_ExecNew';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/Test/Migrations/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    public static function createPageContent(\stdClass $langPageContent, \stdClass $viewParams):string
    {
        //parent::printPageContent();
        return '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<div class="test-menu" style="text-align: left">'.
            '<h2>Tests migrations list</h2>'.
            '<ul>'.
            '<li><a href="'.$viewParams->langSl.'/test/migrations/checkConnectServerStatus">checkConnectServerStatus</a></li>'.
            '<li><a href="'.$viewParams->langSl.'/test/migrations/createMigrationsTables">createMigrationsTables</a></li>'.
            '<li><a href="'.$viewParams->langSl.'/test/migrations/execNewMigrations">execNewMigrations</a></li>'.
            '<li><a href="'.$viewParams->langSl.'/test/migrations/migrationsList">migrationsList</a></li>'.
            '<li><a href="'.$viewParams->langSl.'/test/migrations/migrationsLog">migrationsLog</a></li>'.
            '</ul>'.
            '</div>'.
            '</div></div></div>';
    }
}