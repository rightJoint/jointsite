<?php


namespace JointApp\Views\User;


use JointApp\Views\Records\RecordListView;
use JointApp\Interfaces\LangWebViewInterface;

class View_User_NtfList extends RecordListView
{
    public string $logo = '/img/modImg/eMail-logo.png';
    public string $shortcutIcon = '/img/modImg/eMail-logo.png';
    public bool $robotNoIndex = true;

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_User_Notifications';
        $loads[] = [$name => $docRoot.'/JointApp/LangFiles/Views/User/'.$name];

        return parent::loadLangView($docRoot, $viewLang, $loads);
    }
}