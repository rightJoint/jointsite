<?php


namespace JointApp\Controllers\User;


class Controller_User_Password extends Controller_User_Account
{
    public function actionGetUserPassword()
    {
        global $currentUser;

        $this->model->getUser($currentUser->user_id);

        $this->view->h2 = $this->langMap->h2;
        $this->view->process_url = '';
        $this->view->fieldAliases = [];
        $this->view->actionResult = null;
        $this->view->logMessage = '';
        $this->view->editFields = $this->model->record;
        $this->view->type = 'edit';
    }

    public function loadLangController(): string
    {

        parent::loadLangController();

        $name = 'LangFiles_'.$this->langNs.'_Controller_User_Password';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/User/'.$name.'.php';
        return $name;
    }
}