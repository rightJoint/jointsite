<?php

namespace Src\RoutesCollection;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_JointSite
{
    //jointsite
    static function getRoute_Jointsite($routes_ns):JointSiteRoute
    {
        //jointsite
        if(!isset($routes_ns[2])){
            return (new JointSiteRoute())
            ->withController('JointApp\Controllers\Controller')
                ->withAction('actionIndex')
                ->withModel('JointApp\Models\Model')
                ->withView('Src\Views\View_Main');
        }else{
            //jointsite/about
            if(strtolower($routes_ns[2]) == 'about') {
                return (new JointSiteRoute())
                    ->withController('JointApp\Controllers\Controller')
                    ->withModel('JointApp\Models\Model')
                    ->withAction('actionIndex')
                    ->withView('Src\Views\JointSite\View_JointSite_About');
            }
            //jointsite/deploy
            elseif(strtolower($routes_ns[2]) == 'deploy') {
                return self::getRoute_JointsiteDeploy($routes_ns);
            }
            //jointsite/architecture
            elseif (strtolower($routes_ns[2]) == 'architecture'){
                return self::getRoute_JointsiteArchitecture($routes_ns);
            }
            //jointsite/components
            elseif (strtolower($routes_ns[2]) == 'components'){
                return self::getRoute_JointsiteComponents($routes_ns);
            }
        }
    }

    //jointsite/deploy
    static function getRoute_JointsiteDeploy($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Controller')
            ->withModel('JointApp\Models\Model')
            ->withAction('actionIndex');

        //jointsite/deploy
        if(!isset($routes_ns[3])){
            $route
                ->withView('Src\Views\JointSite\Deploy\View_JointSite_Deploy');
        }else {
            //jointsite/deploy/dockerhub
            if (strtolower($routes_ns[3]) == 'dockerhub') {
                $route
                    ->withView('Src\Views\JointSite\Deploy\View_JointSite_Deploy_Docker');
            }
            //jointsite/deploy/github
            elseif (strtolower($routes_ns[3]) == 'github') {
                $route
                    ->withView('Src\Views\JointSite\Deploy\View_JointSite_Deploy_Git');
            }
            //jointsite/deploy/openserver
            elseif (strtolower($routes_ns[3]) == 'openserver') {
                $route
                    ->withView('Src\Views\JointSite\Deploy\View_JointSite_Deploy_OpenServer');
            }
            //jointsite/deploy/portsforwarding
            elseif (strtolower($routes_ns[3]) == 'portsforwarding') {
                $route
                    ->withView('Src\Views\JointSite\Deploy\View_JointSite_Deploy_PortsF');
            }
        }
        return $route;
    }

    //jointsite/architecture
    static function getRoute_JointsiteArchitecture($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Controller')
            ->withModel('JointApp\Models\Model')
            ->withAction('actionIndex');

        //jointsite/architecture
        if(!isset($routes_ns[3])){
            $route
                ->withView('Src\Views\JointSite\Arch\View_JointSite_Arch');
        }else {
            //jointsite/architecture/lifecycle
            if (strtolower($routes_ns[3]) == 'lifecycle') {
                $route
                    ->withView("Src\Views\JointSite\Arch\View_JointSite_Arch_LifeCycle");
            }
            //jointsite/architecture/directories
            elseif (strtolower($routes_ns[3]) == 'directories') {
                $route
                    ->withView("Src\Views\JointSite\Arch\View_JointSite_Arch_Dirs");
                    //->withView("Src\Views\View_Main");
            }
            //jointsite/architecture/middleware
            elseif (strtolower($routes_ns[3]) == 'middleware') {
                $route
                    ->withView("Src\Views\JointSite\Arch\View_JointSite_Arch_Middleware");
                //->withView("Src\Views\View_Main");
            }
            //jointsite/architecture/routes
            elseif (strtolower($routes_ns[3]) == 'routes') {
                $route
                    ->withView("Src\Views\JointSite\Arch\View_JointSite_Arch_Routes");
                //->withView("Src\Views\View_Main");
            }
            //jointsite/architecture/mvc
            elseif (strtolower($routes_ns[3]) == 'mvc') {
                return self::getRoute_JointsiteArchitectureMvc($routes_ns);
            }
        }

        return $route;
    }

    //jointsite/architecture/mvc
    static function getRoute_JointsiteArchitectureMvc($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Controller')
            ->withModel('JointApp\Models\Model')
            ->withAction('actionIndex');

        //jointsite/architecture/mvc
        if(!isset($routes_ns[4])){
            $route->withView('Src\Views\JointSite\Arch\Mvc\View_JointSite_Arch_Mvc');
        }
        //jointsite/architecture/mvc/model
        elseif (strtolower($routes_ns[4]) == 'model'){
            $route->withView('Src\Views\JointSite\Arch\Mvc\View_JointSite_Arch_Mvc_Model');
        }
        //jointsite/architecture/mvc/view
        elseif (strtolower($routes_ns[4]) == 'view'){
            $route->withView('Src\Views\JointSite\Arch\Mvc\View_JointSite_Arch_Mvc_View');
        }
        //jointsite/architecture/mvc/controller
        elseif (strtolower($routes_ns[4]) == 'controller'){
            $route->withView('Src\Views\JointSite\Arch\Mvc\View_JointSite_Arch_Mvc_Controller');
        }
        //jointsite/architecture/mvc/action
        elseif (strtolower($routes_ns[4]) == 'action'){
            $route->withView('Src\Views\JointSite\Arch\Mvc\View_JointSite_Arch_Mvc_Action');
        }

        return $route;
    }

    static function getRoute_JointsiteComponents($routes_ns):JointSiteRoute
    {

    }

}