<?php


namespace Src\RoutesCollection;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Basket
{
    static function getRoute_Basket($routes_ns):JointSiteRoute
    {
        if(strtolower($routes_ns[2]) == 'add'){
            return (new JointSiteRoute())
                ->withController('Src\Controllers\Controller_Basket')
                ->withAction('actionAdd')
                ->withModel('Src\Models\Model_Landing')
                ->withView('Src\Views\View_Landing')
                ->responseFormat('json');
        }elseif (strtolower($routes_ns[2]) == 'drop'){
            return (new JointSiteRoute())
                ->withController('Src\Controllers\Controller_Basket')
                ->withAction('actionDrop')
                ->withModel('JointApp\Models\Model')
                ->withView('JointApp\Views\View')
                ->responseFormat('json');
        }
    }
}