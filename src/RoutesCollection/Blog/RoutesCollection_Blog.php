<?php


namespace Src\RoutesCollection\Blog;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Blog
{
    static function getRoute_Blog($routes_ns):JointSiteRoute
    {
        $route = new JointSiteRoute();
        if(!isset($routes_ns[2]) or empty($routes_ns[2])){
            $route
                ->withController('Src\Controllers\Blog\Controller_Blog')
                ->withModel('Src\Models\Blog\Model_Blog',)
                ->withAction('actionIndex')
                ->withView('Src\Views\Blog\View_Blog_Main');
        }elseif(isset($routes_ns[2]) and strtolower($routes_ns[2]) == 'article'){
            if(isset($routes_ns[3])){
                $route
                    ->withController('Src\Controllers\Blog\Controller_Blog_Arts', ['artRef' => $routes_ns[3]])
                    ->withModel('Src\Models\Blog\Model_Blog_Arts',)
                    ->withAction('actionIndex');
                if(strtolower($routes_ns[3]) == 'joint-pass'){
                    $route->withView('Src\Views\Blog\IT\View_Blog_IT_JointPass');
                }
                elseif(strtolower($routes_ns[3]) == 'right-joint-updated'){
                    $route->withView('Src\Views\Blog\IT\View_Blog_IT_RightJointUpdated');
                }
                elseif(strtolower($routes_ns[3]) == 'phpstorm-reset-trial'){
                    $route->withView('Src\Views\Blog\IT\View_Blog_IT_PhpStormResetTrial');
                }
                else{
                    $route->withView('Src\Views\Blog\View_Blog_Art');
                }
            }
        }
        return $route;
    }

    static function postRoute_Blog($routes_ns):JointSiteRoute
    {
        $route = new JointSiteRoute();
        if(isset($routes_ns[2]) and $routes_ns[2] == 'filter'){
            $route
                ->withController('Src\Controllers\Blog\Controller_Blog')
                ->withModel('Src\Models\Blog\Model_Blog',)
                ->withAction('actionFilter')
                ->withView('Src\Views\Blog\View_Blog_Main')
                ->responseFormat('json');
        }
        return $route;
    }
}