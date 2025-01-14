<?php


namespace Src\RoutesCollection;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Applications
{
    static function getRoute_Applications($routes_ns):JointSiteRoute
    {
        $route = new JointSiteRoute();
        if(isset($routes_ns[2]) and strtolower($routes_ns[2]) == 'details'){
            if(isset($routes_ns[3])){
                $route
                    ->withController('Src\Controllers\Controller_Applications', ['application_id' => $routes_ns[3]])
                    ->withModel('Src\Models\Applications\Model_Applications',)
                    ->withAction('actionIndex')
                    ->withView('Src\Views\Applications\View_Applications');
            }
        }
        return $route;
    }

    static function postRoute_Applications($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('Src\Controllers\Controller_Applications')
            ->withModel('Src\Models\Applications\Model_Applications');
        $route
             ->withAction('mkApplicationModal')
            ->withView('JointApp\Views\View')
        ->responseFormat('json');
        return $route;
    }
}