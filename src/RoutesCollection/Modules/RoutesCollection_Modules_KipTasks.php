<?php
namespace Src\RoutesCollection\Modules;


use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Modules_KipTasks
{
    //GET: /siteman/kiptasks
    static function getRoute_ModuleKipTasks($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_KipTasks',
            //array('processUri' => '/test/migrations/migrationsList')
            )
            ->withModel('JointApp\Models\Components\Model_Components_KipTasks');
        //GET: /siteman/kiptasks.../listview
        if(!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview'){
            $route
                ->withAction('getListView')
                ->withView('JointApp\Views\Modules\ModuleListView');
        }
        //GET: /siteman/kiptasks/detailview
        elseif (strtolower($routes_ns[3]) == 'detailview'){
            $route
                ->withAction('getDetailView')
                ->withView('JointApp\Views\Modules\ModuleDetailView');
        }
        //GET: /siteman/kiptasks/editview
        elseif (strtolower($routes_ns[3]) == 'editview'){
            $route
                ->withAction('getEditView')
                ->withView('Src\Views\Kip\View_Kip_Tasks_Edit');
        }
        //GET: /siteman/kiptasks/newview
        elseif (strtolower($routes_ns[3]) == 'newview'){
            $route->withAction('getNewView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //GET: /siteman/kiptasks/newview
        elseif (strtolower($routes_ns[3]) == 'deleteview'){
            $route->withAction('getDeleteView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        return  $route;
    }

    //POST: /siteman/kiptasks
    static function postRoute_ModuleKipTasks($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_KipTasks', )
            ->withModel('JointApp\Models\Components\Model_Components_KipTasks');
        //POST: /siteman/kiptasks..listview
        if (!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview') {
            $route
                ->withAction('applyFilterView')
                ->withView('JointApp\Views\Modules\ModuleListView')
                ->responseFormat('json');
        }
        //POST: /siteman/kiptasks/editview
        elseif (strtolower($routes_ns[3]) == 'editview') {
            $route
                ->withAction('postEditView')
                ->withView('Src\Views\Kip\View_Kip_Tasks_Edit');
        }
        //POST: /siteman/kiptasks/deleteview
        elseif (strtolower($routes_ns[3]) == 'deleteview') {
            $route
                ->withAction('postDeleteView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //POST: /siteman/kiptasks/newview
        elseif (strtolower($routes_ns[3]) == 'newview') {
            $route
                ->withAction('postNewView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        return $route;
    }
}