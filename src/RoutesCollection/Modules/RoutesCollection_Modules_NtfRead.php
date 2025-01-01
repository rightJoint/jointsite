<?php
namespace Src\RoutesCollection\Modules;


use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Modules_NtfRead
{
    //GET: /siteman/ntfread
    static function getRoute_ModuleNtfRead($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_NtfRead',
            //array('processUri' => '/test/migrations/migrationsList')
            )
            ->withModel('JointApp\Models\Components\Model_Components_NtfRead');
        /*
                if(!isset($routes_ns[3])){
                    $route
                        //->withAction('listTopPanel')
                        ->withAction('actionModuleStat')
                        ->withView('JointApp\Views\Module\ModuleStatView');
                }

                return $route;
        */

        //GET: /siteman/ntfread.../listview
        if(!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview'){
            $route
                ->withAction('getListView')
                ->withView('JointApp\Views\Modules\ModuleListView');
        }
        //GET: /siteman/ntfread/detailview
        elseif (strtolower($routes_ns[3]) == 'detailview'){
            $route
                //->withAction('detailTopPanel')
                ->withAction('getDetailView')
                ->withView('JointApp\Views\Records\RecordDetailView');
        }
        //GET: /siteman/ntfread/editview
        elseif (strtolower($routes_ns[3]) == 'editview'){
            $route
                //->withAction('detailTopPanel')
                ->withAction('getEditView')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        //GET: /siteman/ntfread/newview
        elseif (strtolower($routes_ns[3]) == 'newview'){
            $route->withAction('getNewView')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        //GET: /siteman/ntfread/newview
        elseif (strtolower($routes_ns[3]) == 'deleteview'){
            $route->withAction('getDeleteView')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        return  $route;
    }

    //POST: /siteman/users
    static function postRoute_ModuleNtfRead($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_NtfRead',
            //array('processUri' => '/test/migrations/migrationsList')
            )
            ->withModel('JointApp\Models\Components\Model_Components_NtfRead');

        //POST: /siteman/ntfread..listview
        if (!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview') {
            $route
                ->withAction('applyFilterView')
                ->withView('JointApp\Views\Modules\ModuleListView')
                ->responseFormat('json');
        }
        //POST: /siteman/ntfread/editview
        elseif (strtolower($routes_ns[3]) == 'editview') {
            $route
                //->withAction('detailTopPanel')
                ->withAction('postEditView')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        //POST: /siteman/ntfread/deleteview
        elseif (strtolower($routes_ns[3]) == 'deleteview') {
            $route
                ->withAction('postDeleteView')
                //->withAction('getViewSelectTblPanel')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        //POST: /siteman/ntfread/newview
        elseif (strtolower($routes_ns[3]) == 'newview') {
            $route
                ->withAction('postNewView')
                //->withAction('getViewSelectTblPanel')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        return $route;
    }
}