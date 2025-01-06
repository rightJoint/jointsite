<?php

namespace Src\RoutesCollection;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Api
{
    /*
     * api routes
     * get:     /api/records/tableName              - list records      (getListRecords)
     * get:     /api/records/tableName/list         - list records      (getListRecords)
     * get:     /api/records/tableName/detail       - detail record     (getDetailRecord)
     * put:     /api/records/tableName              - create record     (putRecord)
     * put:     /api/records/tableName/new          - create record     (putRecord)
     * delete:  /api/records/tableName              - delete record     (deleteRecord)
     * delete:  /api/records/tableName/delete       - delete record     (deleteRecord)
     * post:    /api/records/tableName              - edit record       (editRecord)
     * post:    /api/records/tableName/edit         - edit record       (editRecord)
     */

    static function getRoute_Api($routes_ns)
    {
        $apiRoute = (new JointSiteRoute())
            ->responseFormat('json')
            ->withView('JointApp\Views\View');

        if(!empty($routes_ns[2]) and $routes_ns[2] == 'records') {
            if(!empty($routes_ns[3])){
                $apiRoute->withController('JointApp\Controllers\Records\RecordsApiController')
                    ->withModel('JointApp\Models\Records\RecordsModel', array('tableName' => $routes_ns[3]));
                if(empty($routes_ns[4]) or $routes_ns[4] == 'list'){
                    $apiRoute->withAction('getListRecords');
                }elseif ($routes_ns[4] == 'detail'){
                    $apiRoute->withAction('getDetailRecord');
                }
            }
        }
        return $apiRoute;
    }

    static function putRoute_Api($routes_ns)
    {
        $apiRoute = (new JointSiteRoute())
            ->responseFormat('json')
            ->withView('JointApp\Views\View');

        if(!empty($routes_ns[2]) and $routes_ns[2] == 'records') {
            $apiRoute->withController('JointApp\Controllers\Records\RecordsApiController')
                ->withModel('JointApp\Models\Records\RecordsModel', array('tableName' => $routes_ns[3]));
            if(!empty($routes_ns[3])){
                if(empty($routes_ns[4]) or $routes_ns[4] == 'new'){
                    $apiRoute->withAction('putRecord');
                }
            }
        }
        return $apiRoute;
    }

    static function deleteRoute_Api($routes_ns)
    {
        $apiRoute = (new JointSiteRoute())
            ->responseFormat('json')
            ->withView('JointApp\Views\View');

        if(!empty($routes_ns[2]) and $routes_ns[2] == 'records') {
            $apiRoute->withController('JointApp\Controllers\Records\RecordsApiController')
                ->withModel('JointApp\Models\Records\RecordsModel', array('tableName' => $routes_ns[3]));
            if(!empty($routes_ns[3])){
                if(empty($routes_ns[4]) or $routes_ns[4] == 'delete'){
                    $apiRoute->withAction('deleteRecord');
                }
            }
        }
        return $apiRoute;
    }

    static function postRoute_Api($routes_ns)
    {
        $apiRoute = (new JointSiteRoute())
            ->responseFormat('json')
            ->withView('JointApp\Views\View');
        if(!empty($routes_ns[2]) and $routes_ns[2] == 'records') {

            $apiRoute->withController('JointApp\Controllers\Records\RecordsApiController')
                ->withModel('JointApp\Models\Records\RecordsModel', array('tableName' => $routes_ns[3]));
            if(!empty($routes_ns[3])){
                if(empty($routes_ns[4]) or $routes_ns[4] == 'edit'){
                    $apiRoute->withAction('editRecord');
                }
            }
        }
        return $apiRoute;
    }
}