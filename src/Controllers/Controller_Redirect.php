<?php

namespace Src\Controllers;

use JointApp\Controllers\Controller;

class Controller_Redirect extends Controller
{
    private $langRedir = '';

    public function controllerFilterQuery($queryParams = []): void
    {
        parent::controllerFilterQuery($queryParams);
        if(isset($queryParams['lang']) and !empty($queryParams['lang'])){
            if($queryParams['lang'] == 'en'){
                $this->langRedir = '/en';
            }elseif($queryParams['lang'] == 'ru'){
                $this->langRedir = '/ru';
            }elseif($queryParams['lang'] == 'rus'){
                $this->langRedir = '/ru';
            }
        }
    }

    function actionIndex()
    {
        if(isset($this->routes_ns[1]) and strtolower($this->routes_ns[1]) == 'products'){
            if(isset($this->routes_ns[2]) and $this->routes_ns[2] == 'jointpass'){
                $this->logger->redirect($this->langRedir.'/blog/article/joint-pass');
            }else{
                $this->logger->error('Controller_Redirect - last uri not found', $this->logger->logger_context);
            }
        }else{
            $this->logger->error('Controller_Redirect - last uri not found', $this->logger->logger_context);
        }
    }
}