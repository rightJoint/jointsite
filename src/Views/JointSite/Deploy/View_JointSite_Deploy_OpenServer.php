<?php


namespace Src\Views\JointSite\Deploy;


use JointApp\Interfaces\LangWebViewInterface;

class View_JointSite_Deploy_OpenServer extends View_JointSite_Deploy
{
    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_JointSite_Deploy_OpenServer';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/JointSite/Deploy/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }
}