<?php


namespace Src\Views\JointSite\Deploy;


use JointApp\Interfaces\LangWebViewInterface;
use Src\Views\JointSite\View_JointSite;

class View_JointSite_Deploy extends View_JointSite
{
    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_JointSite_Deploy';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/JointSite/Deploy/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }
}