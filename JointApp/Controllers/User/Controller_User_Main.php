<?php


namespace JointApp\Controllers\User;


class Controller_User_Main extends Controller_User_Account
{
    public function actionGetUserMain()
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

    public function actionPostUserMain()
    {

        global $currentUser;

        $this->model->getUser($currentUser->user_id);

        $this->editFields = $this->model->record;

        $this->updateModelRecordCurVals();

        if($this->model->updateRecord()){
            $this->view->h2 = 'test';
            $this->view->process_url = '';
            $this->view->fieldAliases = [];
            $this->view->actionResult = true;
            $this->view->logMessage = 'dddd';
            $this->view->editFields = $this->model->record;
            $this->view->type = 'edit';
        }
    }

    public function updateModelRecordCurVals()
    {
        foreach ($this->editFields as $fN => $fOpt){
            if(isset($this->requestParams[$fN])){
                $this->model->record[$fN]['curVal'] = $this->requestParams[$fN];
            }
        }
    }
}