<?php


namespace JointApp\Views\User;


use JointApp\Views\Records\RecordEditView;
use JointApp\Interfaces\LangWebViewInterface;


class View_User_Email extends RecordEditView
{
    public string $logo = "/img/popimg/eMailLogo.png";
    public string $shortcutIcon = "/img/popimg/eMailLogo.png";

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_User_Email';
        $loads[] = [$name => $docRoot.'/JointApp/LangFiles/Views/User/'.$name];

        return parent::loadLangView($docRoot, $viewLang, $loads);
    }
}