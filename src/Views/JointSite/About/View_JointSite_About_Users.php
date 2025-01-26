<?php


namespace Src\Views\JointSite\About;


use JointApp\Interfaces\LangWebViewInterface;

class View_JointSite_About_Users extends View_JointSite_About
{
    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_JointSite_About_Users';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/JointSite/About/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    //content after menu
    protected static function pageContentJointSite(\stdClass $contentBlock, string $langSl = ''):string
    {
        return '<section>'.
            '<p>'.
            'Страница управления сайтом (админка) находится по  <a href="'.$langSl.'/siteman" title="Управление сайтом">адресу</a>. '.
            'Группы пользователей можно создать в админке. '.
            'Доступ к компонентам задается для одной или нескольких групп в файле <b>/JointApp/ModulesAccessList.php</b>. '.
            'Пользователям наздачаются права в группе.'.
            '<table>'.
            '<tr>'.
            '<td>Разрешение</td>'.
            '<td>Уровень-7</td>'.
            '<td>Уровень-2</td>'.
            '<td>Уровень-0</td>'.
            '</tr>'.
            '<tr>'.
            '<td>Просмотр</td>'.
            '<td>any</td>'.
            '<td>own</td>'.
            '<td>forbidden</td>'.
            '</tr>'.
            '<tr>'.
            '<td>Создание</td>'.
            '<td>enable</td>'.
            '<td> - </td>'.
            '<td>disable</td>'.
            '</tr>'.
            '<tr>'.
            '<td>Редактирование</td>'.
            '<td>any</td>'.
            '<td>own</td>'.
            '<td>forbidden</td>'.
            '</tr>'.
            '<tr>'.
            '<td>Удаление</td>'.
            '<td>any</td>'.
            '<td>own</td>'.
            '<td>forbidden</td>'.
            '</tr>'.
            '</table>'.
            '</p>'.
            '<p>'.
            'Если компонет настроен на доступ к нескольким гуппамм, то модель, для провеки действий, применяет максимальные права во всех группах.'.
            '</p>'.
            //'<p>'.
            //'Для дообавления в мею неб.'.
            //'</p>'.
            '</section>';
    }
}