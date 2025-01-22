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
            'материал подготавливается к публикации'.
            '</p>'.
            '</section>';
    }
}