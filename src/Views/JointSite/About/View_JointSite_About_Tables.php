<?php


namespace Src\Views\JointSite\About;


use JointApp\Interfaces\LangWebViewInterface;

class View_JointSite_About_Tables extends View_JointSite_About
{
    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_JointSite_About_Tables';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/JointSite/About/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    //content after menu
    protected static function pageContentJointSite(\stdClass $contentBlock, string $langSl = ''):string
    {
        return '<section>'.
            '<h3>Работа с таблицами</h3>'.
            '<p>'.
            'Для работы с таблицами в небольшой базе данных были разработаны модель и контроллер. '.
            'Экраны можно найти по <a href="'.$langSl.'/test/tables" title="операции с таблицами через web-интерфейс">ссылке</a>. '.
            'Можно выгружать таблицы в текстовый файл целиком, загружать из файла, очищать, удалять и создавать таблицы в базе данных.'.
            '</p>'.
            '</section>'.
            '<section>'.
            '<h3>Работа с записями</h3>'.
            '<p>'.
            'Для работы с записями в таблицах используются разработанные RecordsModel, RecordsController и представления. '.
            'Экраны можно найти по <a href="'.$langSl.'/test/records" title="операции с записями в таблицах через web-интерфейс">ссылке</a>. '.
            'Можно создавать, обновлять, удалять и искать записи в таблицах.'.
            '</p>'.
            '</section>';
    }
}