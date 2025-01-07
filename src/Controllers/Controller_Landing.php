<?php
namespace Src\Controllers;

use JointApp\Controllers\Controller;

class Controller_Landing extends Controller
{
    function actionIndex()
    {
        $this->view->basket = $this->model->basketCalc();
        $this->view->serviceList = $this->model->getServiceList();
    }
}