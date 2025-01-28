<?php
namespace Src\RoutesCollection\Modules;


use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Modules_SitemapUpdate
{
    //GET: /siteman/sitemap
    static function getRoute_ModuleSitemapUpdate($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_Sitemap')
            ->withModel('JointApp\Models\Components\Model_Components_Sitemap')
            ->withAction('siteMapUpdate')
            ->withView('JointApp\Views\SiteMapUpdate\View_SiteMapUpdate');
        return  $route;
    }
}