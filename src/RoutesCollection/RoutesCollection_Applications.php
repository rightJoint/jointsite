<?php


namespace Src\RoutesCollection;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Applications
{
    static function getRoute_Applications($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('Src\Controllers\Controller_Applications')
            ->withModel('Src\Models\Applications\Model_Applications');
        if(!isset($routes_ns[2])){
            $route
                //->withController('Src\Controllers\Controller_User', ['actionName' => 'actionIndex'])
                ->withAction('actionIndex')
                ->withView('JointApp\Views\View');
        }
        /*
        if(strtolower($routes_ns[2]) == 'cmd'){
            $route
                //->withController('Src\Controllers\Controller_User', ['actionName' => 'actionIndex'])
                ->withAction('actionCmd')
                ->withView('JointApp\Views\View');
        }
        elseif(strtolower($routes_ns[2]) == 'signin'){
            $route
                //->withController('Src\Controllers\Controller_User', ['actionName' => 'actionIndex'])
                ->withAction('actionGetSignIn')
                ->withView('Src\Views\User\View_User_SignIn');
        }elseif(strtolower($routes_ns[2]) == 'signup'){
            $route
                //->withController('Src\Controllers\Controller_User', ['actionName' => 'actionIndex'])
                ->withAction('actionGetSignUp')
                ->withView('Src\Views\User\View_User_SignUp');
        }
        */
        return $route;
    }

    static function postRoute_Applications($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('Src\Controllers\Controller_Applications')
            ->withModel('Src\Models\Applications\Model_Applications');
        $route
            //->withController('Src\Controllers\Controller_User', ['actionName' => 'actionIndex'])
            ->withAction('mkApplicationModal')
            ->withView('JointApp\Views\View')
        ->responseFormat('json');
        /*
        if(isset($routes_ns[2]) and (strtolower($routes_ns[2]) == 'signin')){

            $route
                //->withController('Src\Controllers\Controller_User', ['actionName' => 'actionIndex'])
                ->withAction('actionPostSignIn')
                ->withView('Src\Views\User\View_User_SignIn');

        }elseif(isset($routes_ns[2]) and strtolower($routes_ns[2]) == 'signup'){
            $route
                //->withController('Src\Controllers\Controller_User', ['actionName' => 'actionIndex'])
                ->withAction('actionPostSignUp')
                ->withView('Src\Views\User\View_User_SignUp');
        }
        */
        return $route;
    }
}