<?php
namespace Src\RoutesCollection\Modules;


use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Modules_UsersToGroups
{
    //GET: /siteman/userstogroups
    static function getRoute_ModuleUsersToGroups($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_UsersToGroups',
            //array('processUri' => '/test/migrations/migrationsList')
            )
            ->withModel('JointApp\Models\Components\Model_Components_UsersToGroups');

        //GET: /siteman/userstogroups.../listview
        if(!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview'){
            $route
                ->withAction('getListView')
                ->withView('JointApp\Views\Modules\ModuleListView');
        }
        //GET: /siteman/userstogroups/detailview
        elseif (strtolower($routes_ns[3]) == 'detailview'){
            $route
                ->withAction('getDetailView')
                ->withView('JointApp\Views\Modules\ModuleDetailView');
        }
        //GET: /siteman/userstogroups/editview
        elseif (strtolower($routes_ns[3]) == 'editview'){
            $route
                ->withAction('getEditView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //GET: /siteman/userstogroups/newview
        elseif (strtolower($routes_ns[3]) == 'newview'){
            $route->withAction('getNewView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //GET: /siteman/userstogroups/newview
        elseif (strtolower($routes_ns[3]) == 'deleteview'){
            $route->withAction('getDeleteView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //GET: /siteman/userstogroups/filluseraliases
        elseif (strtolower($routes_ns[3]) == 'filluseraliases'){
            $route->withAction('actionFillUserAliases')
                ->withView('JointApp\Views\View')
                ->responseFormat('json');
        }
        //GET: /siteman/userstogroups/fillgroupaliases
        elseif (strtolower($routes_ns[3]) == 'fillgroupaliases'){
            $route->withAction('actionFillGroupAliases')
                ->withView('JointApp\Views\View')
                ->responseFormat('json');
        }
        return  $route;
    }

    //POST: /siteman/userstogroups
    static function postRoute_ModuleUsersToGroups($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_UsersToGroups', )
            ->withModel('JointApp\Models\Components\Model_Components_UsersToGroups');

        //POST: /siteman/userstogroups..listview
        if (!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview') {
            $route
                ->withAction('applyFilterView')
                ->withView('JointApp\Views\Modules\ModuleListView')
                ->responseFormat('json');
        }
        //POST: /siteman/userstogroups/editview
        elseif (strtolower($routes_ns[3]) == 'editview') {
            $route
                ->withAction('postEditView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //POST: /siteman/groups/deleteview
        elseif (strtolower($routes_ns[3]) == 'deleteview') {
            $route
                ->withAction('postDeleteView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //POST: /siteman/userstogroups/newview
        elseif (strtolower($routes_ns[3]) == 'newview') {
            $route
                ->withAction('postNewView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        return $route;
    }
}