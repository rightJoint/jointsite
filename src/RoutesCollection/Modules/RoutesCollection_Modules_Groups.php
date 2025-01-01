<?php
namespace Src\RoutesCollection\Modules;


use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Modules_Groups
{
    //GET: /siteman/groups
    static function getRoute_ModuleGroups($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_Groups',
            //array('processUri' => '/test/migrations/migrationsList')
            )
            ->withModel('JointApp\Models\Components\Model_Components_Groups');
        /*
                if(!isset($routes_ns[3])){
                    $route
                        //->withAction('listTopPanel')
                        ->withAction('actionModuleStat')
                        ->withView('JointApp\Views\Module\ModuleStatView');
                }

                return $route;
        */

        //GET: /siteman/groups.../listview
        if(!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview'){
            $route
                ->withAction('getListView')
                ->withView('JointApp\Views\Modules\ModuleListView');
        }
        //GET: /siteman/groups/detailview
        elseif (strtolower($routes_ns[3]) == 'detailview'){
            $route
                //->withAction('detailTopPanel')
                ->withAction('getDetailView')
                ->withView('JointApp\Views\Records\RecordDetailView');
        }
        //GET: /siteman/groups/editview
        elseif (strtolower($routes_ns[3]) == 'editview'){
            $route
                //->withAction('detailTopPanel')
                ->withAction('getEditView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //GET: /siteman/groups/newview
        elseif (strtolower($routes_ns[3]) == 'newview'){
            $route->withAction('getNewView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //GET: /siteman/groups/newview
        elseif (strtolower($routes_ns[3]) == 'deleteview'){
            $route->withAction('getDeleteView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        return  $route;
    }

    //POST: /siteman/users
    static function postRoute_ModuleGroups($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_Groups',
            //array('processUri' => '/test/migrations/migrationsList')
            )
            ->withModel('JointApp\Models\Components\Model_Components_Groups');

        //POST: /siteman/groups..listview
        if (!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview') {
            $route
                ->withAction('applyFilterView')
                ->withView('JointApp\Views\Modules\ModuleListView')
                ->responseFormat('json');
        }
        //POST: /siteman/groups/editview
        elseif (strtolower($routes_ns[3]) == 'editview') {
            $route
                //->withAction('detailTopPanel')
                ->withAction('postEditView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //POST: /siteman/groups/deleteview
        elseif (strtolower($routes_ns[3]) == 'deleteview') {
            $route
                ->withAction('postDeleteView')
                //->withAction('getViewSelectTblPanel')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //POST: /siteman/groups/newview
        elseif (strtolower($routes_ns[3]) == 'newview') {
            $route
                ->withAction('postNewView')
                //->withAction('getViewSelectTblPanel')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        return $route;
    }
}