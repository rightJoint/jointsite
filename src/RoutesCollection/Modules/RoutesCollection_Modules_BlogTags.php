<?php
namespace Src\RoutesCollection\Modules;


use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Modules_BlogTags
{
    //GET: /siteman/blogtags
    static function getRoute_ModuleBlogTags($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_BlogTags',
            )
            ->withModel('JointApp\Models\Components\Model_Components_BlogTags');

        //GET: /siteman/blogtags.../listview
        if(!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview'){
            $route
                ->withAction('getListView')
                ->withView('JointApp\Views\Modules\ModuleListView');
        }
        //GET: /siteman/blogtags/detailview
        elseif (strtolower($routes_ns[3]) == 'detailview'){
            $route
                ->withAction('getDetailView')
                ->withView('JointApp\Views\Records\RecordDetailView');
        }
        //GET: /siteman/blogtags/editview
        elseif (strtolower($routes_ns[3]) == 'editview'){
            $route
                ->withAction('getEditView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //GET: /siteman/blogtags/newview
        elseif (strtolower($routes_ns[3]) == 'newview'){
            $route->withAction('getNewView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //GET: /siteman/blogtags/newview
        elseif (strtolower($routes_ns[3]) == 'deleteview'){
            $route->withAction('getDeleteView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        return  $route;
    }

    //POST: /siteman/users
    static function postRoute_ModuleBlogTags($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_BlogTags',
            )
            ->withModel('JointApp\Models\Components\Model_Components_BlogTags');

        //POST: /siteman/blogtags..listview
        if (!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview') {
            $route
                ->withAction('applyFilterView')
                ->withView('JointApp\Views\Modules\ModuleListView')
                ->responseFormat('json');
        }
        //POST: /siteman/blogtags/editview
        elseif (strtolower($routes_ns[3]) == 'editview') {
            $route
                ->withAction('postEditView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //POST: /siteman/blogtags/deleteview
        elseif (strtolower($routes_ns[3]) == 'deleteview') {
            $route
                ->withAction('postDeleteView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //POST: /siteman/blogtags/newview
        elseif (strtolower($routes_ns[3]) == 'newview') {
            $route
                ->withAction('postNewView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        return $route;
    }
}