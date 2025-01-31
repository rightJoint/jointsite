<?php


namespace JointApp\Controllers\User;


use JointApp\Factories\ModelFactory;
use JointApp\Factories\MailFactory;
use JointApp\JointAppMailer;

class Controller_User_Validate extends Controller_User_Account
{
    public string $vldCode = '';

    public function loadLangController(): string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_User_Validate';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/User/'.$name.'.php';
        return $name;
    }

    public function controllerFilterQuery($queryParams = []): void
    {
        parent::controllerFilterQuery($queryParams);

        if(isset($queryParams['vldCode']) and !empty($queryParams['vldCode'])){
            $this->vldCode = $queryParams['vldCode'];
        }
    }

    public function actionIndex()
    {
        $result_key = $this->model->checkVldCode($this->vldCode);

        switch ($result_key){
            case "empty":
                $this->logger->error($this->langMap->vldErr->empty, $this->logger->logger_context);
                break;
            case "not-found":
                $this->logger->error($this->langMap->vldErr->notFound, $this->logger->logger_context);
                break;
            case "repeated":
                $this->view->vldRes = 'repeated';
                break;
            case "success":
                $this->view->vldRes = 'success';
                break;
            default:
                //code block

        }
    }
}