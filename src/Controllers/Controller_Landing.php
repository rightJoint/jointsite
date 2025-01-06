<?php
namespace Src\Controllers;

use JointApp\Controllers\Controller;

class Controller_Landing extends Controller
{
    function actionTest()
    {
        //$this->view->pageContent = 'added-actionTest'.$this->view->pageContent;
    }

    function actionIndex()
    {
        if(isset($_GET['lBasketAdd'])){
            $this->model->lBasketAdd();
            $this->view->basket_prod = $this->model->basketCalc();
            $modalOrder = $this->view->print_basket();
            if(isset($_SESSION[JOINT_SITE_LW_LANG]['basket']['total'])){
                $modalOrder['total'] = $_SESSION[JOINT_SITE_LW_LANG]['basket']['total'];
            }else{
                $modalOrder['total'] = 0;
            }

            $this->view->generateJson($modalOrder);
        }elseif(isset($_GET['basket-clear'])){
            unset($_SESSION[JOINT_SITE_LW_LANG]['basket']);
        }else{
            $this->view->basket_prod = $this->model->basketCalc();
            $this->view->serviceList = $this->model->getServiceList();
        }
    }
}