<?php


namespace Src\RoutesCollection\Modules;


use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Modules_MusicTracksToAlb
{
    //GET: /siteman/musictrackstoalb
    static function getRoute_ModuleMusicTracksToAlb($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_MusicTracksToAlb',
            //array('processUri' => '/test/migrations/migrationsList')
            )
            ->withModel('JointApp\Models\Components\Model_Components_MusicTracksToAlb');

        //GET: /siteman/musictrackstoalb.../listview
        if(!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview'){
            $route
                ->withAction('getListView')
                ->withView('JointApp\Views\Modules\ModuleListView');
        }
        //GET: /siteman/musictrackstoalb/detailview
        elseif (strtolower($routes_ns[3]) == 'detailview'){
            $route
                //->withAction('detailTopPanel')
                ->withAction('getDetailView')
                ->withView('JointApp\Views\Modules\ModuleDetailView');
        }
        //GET: /siteman/musictrackstoalb/editview
        elseif (strtolower($routes_ns[3]) == 'editview'){
            $route
                //->withAction('detailTopPanel')
                ->withAction('getEditView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //GET: /siteman/musictrackstoalb/newview
        elseif (strtolower($routes_ns[3]) == 'newview'){
            $route->withAction('getNewView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //GET: /siteman/musictrackstoalb/newview
        elseif (strtolower($routes_ns[3]) == 'deleteview'){
            $route->withAction('getDeleteView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //GET: /siteman/musictrackstoalb/filltrackname
        elseif (strtolower($routes_ns[3]) == 'filltrackname'){
            $route->withAction('actionFillTrackName')
                ->withView('JointApp\Views\View')
                ->responseFormat('json');
        }
        //GET: /siteman/musictrackstoalb/fillalbname
        elseif (strtolower($routes_ns[3]) == 'fillalbname'){
            $route->withAction('actionFillAlbName')
                ->withView('JointApp\Views\View')
                ->responseFormat('json');
        }
        return  $route;
    }

    //POST: /siteman/musictrackstoalb
    static function postRoute_ModuleMusicTracksToAlb($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Components\Controller_Components_MusicTracksToAlb',
                //array('processUri' => '/test/migrations/migrationsList')
            )
            ->withModel('JointApp\Models\Components\Model_Components_MusicTracksToAlb');

        //POST: /siteman/musictrackstoalb..listview
        if (!isset($routes_ns[3]) or strtolower($routes_ns[3]) == 'listview') {
            $route
                ->withAction('applyFilterView')
                ->withView('JointApp\Views\Modules\ModuleListView')
                ->responseFormat('json');
        }
        //POST: /siteman/musictrackstoalb/editview
        elseif (strtolower($routes_ns[3]) == 'editview') {
            $route
                ->withAction('postEditView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //POST: /siteman/musictrackstoalb/deleteview
        elseif (strtolower($routes_ns[3]) == 'deleteview') {
            $route
                ->withAction('postDeleteView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        //POST: /siteman/musictrackstoalb/newview
        elseif (strtolower($routes_ns[3]) == 'newview') {
            $route
                ->withAction('postNewView')
                ->withView('JointApp\Views\Modules\ModuleEditView');
        }
        return $route;
    }
}