<?php
namespace Src\RoutesCollection\Modules;


use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Modules_Robots
{
    //GET: /siteman/robots
    static function getRoute_ModuleRobots($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_Robots')
            ->withModel('JointApp\Models\Components\Model_Components_Robots');

        //GET: /siteman/robots.../listview
        if(!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview'){
            $route
                ->withAction('getListView')
                ->withView('JointApp\Views\Modules\ModuleListView');
        }
        //GET: /siteman/robots/detailview
        elseif (strtolower($routes_ns[3]) == 'detailview'){
            $route
                ->withAction('getDetailView')
                ->withView('JointApp\Views\Modules\ModuleDetailView');
        }
        //GET: /siteman/robots/editview
        elseif (strtolower($routes_ns[3]) == 'editview'){
            $route
                //->withAction('detailTopPanel')
                ->withAction('getEditView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //GET: /siteman/robots/newview
        elseif (strtolower($routes_ns[3]) == 'newview'){
            $route->withAction('getNewView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //GET: /siteman/robots/newview
        elseif (strtolower($routes_ns[3]) == 'deleteview'){
            $route->withAction('getDeleteView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        return  $route;
    }

    //POST: /siteman/robots
    static function postRoute_ModuleRobots($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_Robots',
            //array('processUri' => '/test/migrations/migrationsList')
            )
            ->withModel('JointApp\Models\Components\Model_Components_Robots');

        //POST: /siteman/robots..listview
        if (!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview') {
            $route
                ->withAction('applyFilterView')
                ->withView('JointApp\Views\Modules\ModuleListView')
                ->responseFormat('json');
        }
        //POST: /siteman/robots/editview
        elseif (strtolower($routes_ns[3]) == 'editview') {
            $route
                //->withAction('detailTopPanel')
                ->withAction('postEditView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //POST: /siteman/robots/deleteview
        elseif (strtolower($routes_ns[3]) == 'deleteview') {
            $route
                ->withAction('postDeleteView')
                //->withAction('getViewSelectTblPanel')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //POST: /siteman/robots/newview
        elseif (strtolower($routes_ns[3]) == 'newview') {
            $route
                ->withAction('postNewView')
                //->withAction('getViewSelectTblPanel')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        return $route;
    }
}