<?php


namespace Src\RoutesCollection;


use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Music
{
    static function getRoute_Music($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('Src\Controllers\Controller_Music');
        if(!isset($routes_ns[2])){
            $route
                ->withModel('Src\Models\Music\Model_Music_Albums')
                ->withAction('actionIndex')
                ->withView('Src\Views\Music\View_Music_Main');
        }
        //GET: /music/albums
        elseif(strtolower($routes_ns[2]) == 'albums'){
            $route
                ->withController('Src\Controllers\Controller_Music_Alb')
                ->withModel('Src\Models\Music\Model_Music_Albums')
                ->withAction('getListView')
                ->withView('Src\Views\Music\View_Music_Albums');
        }
        //GET: /music/albums
        elseif(strtolower($routes_ns[2]) == 'tracks'){
            $route
                ->withController('Src\Controllers\Controller_Music_Tracks')
                ->withModel('Src\Models\Music\Model_Music_Tracks')
                ->withAction('getListView')
                ->withView('Src\Views\Music\View_Music_Tracks');
        }
        return $route;
    }

    static function postRoute_Music($routes_ns):JointSiteRoute
    {
        //POST: /music/tracks
        if(strtolower($routes_ns[2]) == 'tracks') {
            if (!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview') {
                $route = (new JointSiteRoute())
                    ->withController('Src\Controllers\Controller_Music_Tracks')
                    ->withAction('applyFilterView')
                    ->withModel('Src\Models\Music\Model_Music_Tracks')
                    ->withView('Src\Views\Music\View_Music_Tracks')
                    ->responseFormat('json');
            }
        }
        //POST: /music/albums
        if(strtolower($routes_ns[2]) == 'albums') {
            if (!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview') {

                $route = (new JointSiteRoute())
                    ->withController('Src\Controllers\Controller_Music_Alb')
                    ->withAction('applyFilterView')
                    ->withModel('Src\Models\Music\Model_Music_Albums')
                    ->withView('Src\Views\Music\View_Music_Albums')
                    ->responseFormat('json');

            }
        }
        return $route;

    }
}