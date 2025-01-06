<?php


namespace Src\RoutesCollection;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Main
{
    static function getRoute_Main($routes_ns):JointSiteRoute
    {
        return (new JointSiteRoute())
            ->withController('Src\Controllers\Controller_Landing')
            ->withAction('actionIndex')
            ->withModel('Src\Models\Model_Landing')
            ->withView('Src\Views\View_Landing');
    }
}