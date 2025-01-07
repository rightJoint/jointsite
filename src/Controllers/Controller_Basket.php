<?php


namespace Src\Controllers;


use JointApp\Controllers\Controller;

class Controller_Basket extends Controller
{
    private string $prodAlias = '';

    public function controllerFilterQuery($queryParams = []): void
    {
        if(isset($queryParams['lBasketAdd'])){
            $this->prodAlias = $queryParams['lBasketAdd'];
        }
    }

    public function actionAdd()
    {
        $_SESSION['basket']['lang'] = $this->langLw;
        $this->model->lBasketAdd($this->prodAlias);
        $this->view->responseJson['basket'] = $this->view->printBasket($this->model->basketCalc(), $this->langLw);
        if (isset($_SESSION['basket']['total'])) {
            $this->view->responseJson['total'] = $_SESSION['basket']['total'];
        } else {
            $this->view->responseJson['total'] = 0;
        }
    }

    public function actionDrop()
    {
        unset($_SESSION['basket']);
    }
}