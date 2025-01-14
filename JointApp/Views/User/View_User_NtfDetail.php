<?php


namespace JointApp\Views\User;


use JointApp\Views\Records\RecordDetailView;
use JointApp\Interfaces\LangWebViewInterface;

class View_User_NtfDetail extends RecordDetailView
{
    public string $logo = '/img/popimg/eye-icon.png';
    public string $shortcutIcon = '/img/popimg/eye-icon.png';

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_User_NtfDetail';
        $loads[] = [$name => $docRoot.'/JointApp/LangFiles/Views/User/'.$name];

        return parent::loadLangView($docRoot, $viewLang, $loads);
    }
}