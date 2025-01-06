<?php


namespace Src\RoutesCollection;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Main
{
    static function getRoute_Main($routes_ns):JointSiteRoute
    {
        return (new JointSiteRoute())
            ->withController("JointApp\Controllers\Controller")
            ->withAction("actionIndex")
            ->withModel("JointApp\Models\Model")
            ->withView("Src\Views\View_Main");
    }
}