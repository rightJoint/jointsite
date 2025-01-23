<?php


namespace Src\Views\JointSite\About;


use JointApp\Interfaces\LangWebViewInterface;

class View_JointSite_About_Api extends View_JointSite_About
{
    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_JointSite_About_Api';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/JointSite/About/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    public static function addStyleLinks(callable $addStyleLinks):void
    {
        parent::addStyleLinks($addStyleLinks);

        $addStyleLinks([
            '/css/jointSite/diffTable.css',
        ]);
    }

    //content after menu
    protected static function pageContentJointSite(\stdClass $contentBlock, string $langSl = ''):string
    {
        return '<section>'.
            '<h3>Типы апи в приложении</h3>'.
            '<p>'.
            'Приложение поддерживает два типа rest json апи:'.
            '<ul>'.
            '<li>Records api на основе RecordsModel и RecordsController</li>'.
            '<li>Module api на основе ModuleModel и ModuleController</li>'.
            '</ul>'.
            '</p>'.
            '<p>'.
            '<ul>'.
            'Методы АПИ: '.
            '<li>get - получить запись или список записей</li>'.
            '<li>put - добавить запись</li>'.
            '<li>delete - удалить запись</li>'.
            '<li>post - обновить запись</li>'.
            '</ul>'.
            '</p>'.
            '</section>'.
            '<section>'.
            '<h3>Доступы АПИ</h3>'.
            '<p>'.
            'Для доступа к Records api вы должны передовать параметр <b>record_api_access_token</b> '.
            'тем методом, которым обращаетесь. '.
            '</p>'.
            '<p>'.
            'Для доступа к Module api, ...'.
            '</p>'.
            '</section>'.
            '</section>'.
            '<section>'.
            '<h3>Uri для запросов</h3>'.
            '<p>'.
            'Маршруты к Records api, как и другие маршруты, задаются в RoutesCollection, RoutesCollection_Api'.
            '<div class="diffTable">'.
            '<table>'.
            '<tr>'.
            '<td>Метод</td>'.
            '<td>Маршрут</td>'.
            '<td>Метод контроллера</td>'.
            '<td>Примечание</td>'.
            '</tr>'.
            '<tr>'.
            '<td>get</td>'.
            '<td>/api/records/tableName</td>'.
            '<td>getListRecords</td>'.
            '<td>list records</td>'.
            '</tr>'.
            '<tr>'.
            '<td>get</td>'.
            '<td>/api/records/tableName/list</td>'.
            '<td>getListRecords</td>'.
            '<td>list records</td>'.
            '</tr>'.
            '<tr>'.
            '<td>get</td>'.
            '<td>/api/records/tableName/detail</td>'.
            '<td>getDetailRecord</td>'.
            '<td>detail record</td>'.
            '</tr>'.
            '<tr>'.
            '<td>put</td>'.
            '<td>/api/records/tableName</td>'.
            '<td>putRecord</td>'.
            '<td>create record</td>'.
            '</tr>'.
            '<tr>'.
            '<td>put</td>'.
            '<td>/api/records/tableName/new</td>'.
            '<td>putRecord</td>'.
            '<td>create record</td>'.
            '</tr>'.
            '<tr>'.
            '<td>delete</td>'.
            '<td>/api/records/tableName</td>'.
            '<td>deleteRecord</td>'.
            '<td>delete record</td>'.
            '</tr>'.
            '<tr>'.
            '<td>delete</td>'.
            '<td>/api/records/tableName/delete</td>'.
            '<td>deleteRecord</td>'.
            '<td>delete record</td>'.
            '</tr>'.
            '<tr>'.
            '<td>post</td>'.
            '<td>/api/records/tableName</td>'.
            '<td>editRecord</td>'.
            '<td>edit record</td>'.
            '</tr>'.
            '<tr>'.
            '<td>post</td>'.
            '<td>/api/records/tableName/edit</td>'.
            '<td>editRecord</td>'.
            '<td>edit record</td>'.
            '</tr>'.
            '</table>'.
            '</div>'.
            '</p>'.
            '<p>'.
            'Для доступа к Module api, ...'.
            '</p>'.
            '</section>';
    }
}