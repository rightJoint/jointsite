<?php


namespace JointApp\Controllers\User;


use JointApp\Controllers\Controller;
use JointApp\Views\User\UserSubMenu;

class Controller_User_Account extends Controller
{
    public array $editFields = [];

    public function loadLangController(): string
    {

        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Records';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/'.$name.'.php';

        $name = 'LangFiles_'.$this->langNs.'_Controller_User_Account';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/User/'.$name.'.php';
        return $name;
    }

    public function actionUserSubMenu()
    {

        $subMenu = $this->view::printMenuItems($this->langMap->userSubMenuItems, '/user', $this->langSl, $this->routes_ns);
        $contentMenu = UserSubMenu::printUserSubMenu($subMenu['text']);

        $this->view->putPageContentBefore($contentMenu);
    }
}