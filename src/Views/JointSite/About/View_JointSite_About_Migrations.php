<?php


namespace Src\Views\JointSite\About;


use JointApp\Interfaces\LangWebViewInterface;

class View_JointSite_About_Migrations extends View_JointSite_About
{
    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_JointSite_About_Migrations';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/JointSite/About/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    //content after menu
    protected static function pageContentJointSite(\stdClass $contentBlock, string $langSl = ''):string
    {
        return '<section>'.
            '<p>'.
            'Изменения в базе данных (создание таблиц, добавление записей и т.п.) обычно накатываются с помощью миграций. '.
            'sql-файлы миграция находятся в директории <b>/migrations</b> '.
            '</p>'.
            '<p>'.
            'Для создания/изменения sql-запросов в файлах, проведения миграции и контроля ошибок, разработаны '.
            'модели Model_Migrations и Model_MigrationsLog, View и контроллеры. '.
            'Web-интерфейс настроен на тесте по <a href="'.$langSl.'/test/migrations" title="экраны работы с мограциями">ссылке</a>'.
            '</p>'.
            '<p>'.
            'Провести сразу все миграции можно с помощью теста <b>/test/Exec_Migrations_Test.php</b> '.
            'для этого необходимо запустить команду в консоле <b>php ./vendor/bin/phpunit tests/Exec_Migrations_TEST.php</b>'.
            '</p>'.
            '</section>';
    }
}