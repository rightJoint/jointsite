<?php


namespace Src\RoutesCollection\Blog;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Blog
{
    static function getRoute_Blog($routes_ns):JointSiteRoute
    {
        $route = new JointSiteRoute();
        if(isset($routes_ns[2]) and strtolower($routes_ns[2]) == 'article'){
            if(isset($routes_ns[3])){
                $route
                    ->withController('Src\Controllers\Blog\Controller_Blog_Arts', ['artRef' => $routes_ns[3]])
                    ->withModel('Src\Models\Blog\Model_Blog_Arts',)
                    ->withAction('actionIndex')
                    ->withView('Src\Views\Blog\View_Blog_Art');
            }
        }
        return $route;
    }
}