<?php


namespace Src\Controllers\Handbook;


use JointApp\Controllers\Controller;

class Controller_HandbookMain extends Controller
{
    public function actionIndex()
    {
        $this->view->envCount = $this->model->countEnv();
        $this->view->hvCount = $this->model->countHw();
        $this->view->processCount = $this->model->countProcess();
        $this->view->servicesCount = $this->model->countServices();
    }
}