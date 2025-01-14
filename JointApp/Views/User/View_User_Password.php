<?php


namespace JointApp\Views\User;


use JointApp\Views\Records\RecordEditView;
use JointApp\Interfaces\LangWebViewInterface;

class View_User_Password extends RecordEditView
{
    public string $logo = "/img/popimg/pass-img.png";
    public string $shortcutIcon = "/img/popimg/pass-img.png";

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_User_Password';
        $loads[] = [$name => $docRoot.'/JointApp/LangFiles/Views/User/'.$name];

        return parent::loadLangView($docRoot, $viewLang, $loads);
    }
}