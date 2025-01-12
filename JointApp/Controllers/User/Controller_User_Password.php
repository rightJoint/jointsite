<?php


namespace JointApp\Controllers\User;


class Controller_User_Password extends Controller_User_Account
{
    public function actionGetUserPassword()
    {
        global $currentUser;

        $this->model->getUser($currentUser->user_id);

        $this->view->h2 = 'test';
        $this->view->process_url = '';
        $this->view->fieldAliases = [];
        $this->view->actionResult = null;
        $this->view->logMessage = '';
        $this->view->editFields = $this->model->record;
        $this->view->type = 'edit';
    }
}