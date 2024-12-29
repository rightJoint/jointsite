<?php
//toDo RightJoint -del this view cause used LoggerView


namespace Src\Views\User;

use JointApp\Interfaces\LangWebViewInterface;
use JointApp\Views\SiteView;

class View_User_SignIn extends SiteView
{
    protected string $logo = '/img/popimg/checkInNow.png';
    public string $shortcutIcon = '/img/popimg/checkInNow.png';

    public $modalMenuActive = true;

    public $robot_no_index = true;
    public $metrik_block = false;

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_User_SignIn';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/User/'.$name];

        return parent::loadLangView($docRoot, $viewLang, $loads);
    }


}