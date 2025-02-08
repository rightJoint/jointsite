<?php
namespace Src\RoutesCollection\Modules;


use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Modules_RobotsUpdate
{
    //GET: /siteman/robots
    static function getRoute_ModuleRobotsUpdate($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_Robots')
            ->withModel('JointApp\Models\Components\Model_Components_Robots')
            ->withAction('siteRobotsUpdate')
            ->withView('JointApp\Views\SiteMapUpdate\View_RobotsUpdate');
        return  $route;
    }
}