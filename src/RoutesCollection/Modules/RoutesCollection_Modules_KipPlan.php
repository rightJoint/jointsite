<?php
namespace Src\RoutesCollection\Modules;


use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Modules_KipPlan
{
    //GET: /siteman/kipplan
    static function getRoute_ModuleKipPlan($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_KipPlan',
            )
            ->withModel('JointApp\Models\Components\Model_Components_KipPlan');
        //GET: /siteman/kipplan.../listview
        if(!isset($routes_ns[3])){
            $route
                ->withAction('getListView')
                ->withView('Src\Views\Kip\View_Kip_Plan_List');
        }
        return  $route;
    }
}