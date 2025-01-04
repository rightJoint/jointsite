<?php


namespace Src\RoutesCollection;

//use JointApp\Controllers\Controller;
use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Music
{
    static function getRoute_Music($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('Src\Controllers\Controller_Music');
        /*
        $route = (new JointSiteRoute())
            ->withController('Src\Controllers\Controller_User')
            ->withModel('JointApp\Models\Model');
        */
        if(!isset($routes_ns[2])){
            $route
                //->withController('Src\Controllers\Controller_User', ['actionName' => 'actionIndex'])
                ->withModel('Src\Models\Music\Model_Music_Main')
                ->withAction('actionIndex')
                ->withView('Src\Views\Music\View_Music_Main');
        }
        //GET: /music/albums
        elseif(strtolower($routes_ns[2]) == 'albums'){
            $route
                ->withController('Src\Controllers\Controller_Music_Alb')
                ->withModel('Src\Models\Music\Model_Music_Main')
                //->withController('Src\Controllers\Controller_User', ['actionName' => 'actionIndex'])
                ->withAction('getListView')
                ->withView('Src\Views\Music\View_Music_Albums');
        }
        //GET: /music/albums
        elseif(strtolower($routes_ns[2]) == 'tracks'){
            $route
                ->withController('Src\Controllers\Controller_Music_Tracks')
                ->withModel('Src\Models\Music\Model_Music_Tracks')
                //->withController('Src\Controllers\Controller_User', ['actionName' => 'actionIndex'])
                ->withAction('getListView')
                ->withView('Src\Views\Music\View_Music_Tracks');
        }

        /*elseif(strtolower($routes_ns[2]) == 'signup'){
            $route
                //->withController('Src\Controllers\Controller_User', ['actionName' => 'actionIndex'])
                ->withAction('actionGetSignUp')
                ->withView('Src\Views\User\View_User_SignUp');
        }*/
        return $route;

    }

    static function postRoute_Music($routes_ns):JointSiteRoute
    {
        if(strtolower($routes_ns[2]) == 'tracks') {
            if (!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview') {
                $route = (new JointSiteRoute())
                    ->withController('Src\Controllers\Controller_Music_Tracks')
                    ->withAction('applyFilterView')
                    ->withModel('Src\Models\Music\Model_Music_Tracks')
                    ->withView('Src\Views\Music\View_Music_Tracks')
                    ->responseFormat('json');
            }
        }
        /*
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
        }*/
        return $route;

    }
}