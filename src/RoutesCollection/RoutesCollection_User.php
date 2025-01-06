<?php


namespace Src\RoutesCollection;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_User
{
    static function getRoute_User($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('Src\Controllers\Controller_User')
            ->withModel('JointApp\Models\Model');
        if(!isset($routes_ns[2])){
            $route
                //->withController('Src\Controllers\Controller_User', ['actionName' => 'actionIndex'])
                ->withAction('actionIndex')
                ->withView('JointApp\Views\View');
        }
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
        return $route;
    }

    static function postRoute_User($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('Src\Controllers\Controller_User')
            ->withModel('Src\Models\Model_User');
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
        return $route;
    }
}