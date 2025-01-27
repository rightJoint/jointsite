<?php

namespace Src\RoutesCollection;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Products
{
    static function getRoute_Products($routes_ns)
    {
        return (new JointSiteRoute())
            ->withModel('\JointApp\Models\Model')
            ->withView('\JointApp\Views\View')
            ->withController('\Src\Controllers\Controller_Redirect')
            ->withAction('actionIndex');
    }
}