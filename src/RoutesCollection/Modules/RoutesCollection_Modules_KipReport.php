<?php
namespace Src\RoutesCollection\Modules;


use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Modules_KipReport
{
    //GET: /siteman/kipreport
    static function getRoute_ModuleKipReport($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_KipReport',
            )
            ->withModel('JointApp\Models\Components\Model_Components_KipReport');
        //GET: /siteman/kipreport.../listview
        if(!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview'){
            $route
                ->withAction('getListView')
                ->withView('Src\Views\Kip\View_Kip_Report_List');
        }
        //GET: /siteman/kipreport/detailview
        elseif (strtolower($routes_ns[3]) == 'detailview'){
            $route
                ->withAction('getDetailView')
                ->withView('JointApp\Views\Modules\ModuleDetailView');
        }
        //GET: /siteman/kipreport/editview
        elseif (strtolower($routes_ns[3]) == 'editview'){
            $route
                ->withAction('getEditView')
                ->withView('Src\Views\Kip\View_Kip_Tasks_Edit');
        }
        //GET: /siteman/kipreport/newview
        elseif (strtolower($routes_ns[3]) == 'newview'){
            $route->withAction('getNewView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //GET: /siteman/kipreport/newview
        elseif (strtolower($routes_ns[3]) == 'deleteview'){
            $route->withAction('getDeleteView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        return  $route;
    }

    //POST: /siteman/kipreport
    static function postRoute_ModuleKipReport($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_KipReport', )
            ->withModel('JointApp\Models\Components\Model_Components_KipReport');
        //POST: /siteman/kipreport..listview
        if (!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview') {
            $route
                ->withAction('applyFilterView')
                ->withView('JointApp\Views\Modules\ModuleListView')
                ->responseFormat('json');
        }
        //POST: /siteman/kipreport/editview
        elseif (strtolower($routes_ns[3]) == 'editview') {
            $route
                ->withAction('postEditView')
                ->withView('Src\Views\Kip\View_Kip_Tasks_Edit');
        }
        //POST: /siteman/kipreport/deleteview
        elseif (strtolower($routes_ns[3]) == 'deleteview') {
            $route
                ->withAction('postDeleteView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //POST: /siteman/kipreport/newview
        elseif (strtolower($routes_ns[3]) == 'newview') {
            $route
                ->withAction('postNewView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        return $route;
    }
}