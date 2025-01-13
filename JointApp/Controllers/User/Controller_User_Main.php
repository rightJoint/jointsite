<?php


namespace JointApp\Controllers\User;


class Controller_User_Main extends Controller_User_Account
{
    const USER_AVATARS_DIR = '/userdata/avatars/';
    public function loadLangController(): string
    {

        parent::loadLangController();

        $name = 'LangFiles_'.$this->langNs.'_Controller_User_Main';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/User/'.$name.'.php';
        return $name;
    }

    public function actionGetUserMain()
    {
        global $currentUser;

        if($this->model->getUser($currentUser->user_id)){
            $this->view->h2 = $this->langMap->h2;
            $this->view->process_url = '';
            $this->view->fieldAliases = [];
            $this->view->actionResult = null;
            $this->view->logMessage = '';
            $this->prepareEditFields();
            $this->updateEditFieldsFromRecord();
            $this->view->editFields = $this->editFields;
            $this->view->fieldAliases = $this->langMap->fieldAliases;
            $this->view->type = 'edit';
        }else{
            $this->logger->error('Model_User_Main getUser return false on actionGetUserMain', $this->logger->logger_context);
        }
    }

    public function actionPostUserMain()
    {

        global $currentUser;
        if($this->model->getUser($currentUser->user_id)){
            $this->prepareEditFields();
            $this->updateModelRecordFromRequest();

            if($this->model->updateRecord()){
                $this->view->h2 = $this->langMap->h2;
                $this->view->process_url = '';
                $this->view->fieldAliases = [];
                $this->view->actionResult = true;
                $this->view->logMessage = $this->model->log_message;
                //$this->prepareEditFields();
                $this->updateEditFieldsFromRecord();
                $this->view->editFields = $this->editFields;
                $this->view->fieldAliases = $this->langMap->fieldAliases;
                $this->view->type = 'edit';
            }
        }else{
            $this->logger->error('Model_User_Main getUser return false on actionPostUserMain', $this->logger->logger_context);
        }

    }

    public function prepareEditFields(): void
    {
        $this->editFields = array(
            'accAlias' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'photoLink' => array(
                'format' => 'file',
                'file_options' => array(
                    "load_dir" => self::USER_AVATARS_DIR,
                    'file_type' => 'img',
                    'accept' => '.jpg, .jpeg, .bmp, .git, .png',
                    'button' => true,
                ),
                'with_name' => 'GUID',
                'curVal' => '',
            ),
            'birthDay' => array(
                'format' => 'date',
                'curVal' => '',
            ),
            'send_ntf' => array(
                'format' => 'tinyint',
                'curVal' => '',
            ),
            'user_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'curVal' => '',
                'readonly' => 1,
            ),
            'accLogin' => array(
                'format' => 'varchar',
                'curVal' => '',
                'readonly' => 1,
            ),

            'regDate' => array(
                'format' => 'datetime',
                'curVal' => '',
                'readonly' => 1,
            ),
            'netWork' => array(
                'format' => 'varchar',
                'curVal' => '',
                'readonly' => 1,
            ),
            'validDate' => array(
                'format' => 'datetime',
                'curVal' => '',
                'readonly' => 1,
            ),
            'eMail' => array(
                'format' => 'varchar',
                'curVal' => '',
                'readonly' => 1,
            ),
            'socProf' => array(
                'format' => 'varchar',
                'curVal' => '',
                'readonly' => 1,
            ),
            'blackList' => array(
                'format' => 'tinyint',
                'curVal' => '',
                'readonly' => 1,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'curVal' => '',
                'readonly' => 1,
            ),
            'is_admin' => array(
                'format' => 'tinyint',
                'curVal' => '',
                'readonly' => 1,
            ),
            'pref_lang' => array(
                'format' => 'varchar',
                'curVal' => '',
                'readonly' => 1,
            ),
        );
    }
}