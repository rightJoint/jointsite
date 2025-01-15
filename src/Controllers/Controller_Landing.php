<?php
namespace Src\Controllers;

use JointApp\Controllers\Controller;

class Controller_Landing extends Controller
{
    function actionIndex()
    {
        $this->view->serviceList = $this->model->getServiceList();
        $this->view->artList = $this->model->getBlogArts();
    }
}