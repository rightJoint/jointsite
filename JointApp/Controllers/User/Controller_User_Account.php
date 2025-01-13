<?php


namespace JointApp\Controllers\User;


use JointApp\Controllers\Records\RecordsController;
use JointApp\Views\User\UserSubMenu;

class Controller_User_Account extends RecordsController
{
    public function loadLangController(): string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_User_Account';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/User/'.$name.'.php';
        return $name;
    }

    public function actionUserSubMenu()
    {

        $subMenu = $this->view::printMenuItems($this->langMap->userSubMenuItems, '/user', $this->langSl, $this->routes_ns);
        $contentMenu = UserSubMenu::printUserSubMenu($this->langMap->userSubMenuItems['main'], $this->routes_ns, $subMenu['text']);

        $this->view->putPageContentBefore($contentMenu);
    }
}