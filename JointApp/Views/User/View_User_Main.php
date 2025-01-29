<?php


namespace JointApp\Views\User;


use JointApp\Views\Records\RecordEditView;
use JointApp\Interfaces\LangWebViewInterface;

class View_User_Main extends RecordEditView
{
    public string $logo = "/img/popimg/user-logo.png";
    public string $shortcutIcon = "/img/popimg/user-logo.png";
    public bool $robotNoIndex = true;

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_User_Main';
        $loads[] = [$name => $docRoot.'/JointApp/LangFiles/Views/User/'.$name];

        return parent::loadLangView($docRoot, $viewLang, $loads);
    }
}