<?php


namespace Src\RoutesCollection;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_FullStackJobInterview
{
    static function getRoute_FullStackJobInterview($routes_ns)
    {
        if(!isset($routes_ns[2])){
            return (new JointSiteRoute())
                ->withController('Src\Controllers\JobInterview\Controller_JobInterview')
                ->withAction('action_index')
                ->withModel('JointApp\Models\Model')
                ->withView('Src\Views\JobInterview\View_JobInterview');
        }elseif($routes_ns[2] == 'database'){
            return (new JointSiteRoute())
                ->withController('Src\Controllers\JobInterview\Controller_JobInterview')
                ->withAction('action_database')
                ->withModel('JointApp\Models\Model')
                ->withView('Src\Views\JobInterview\View_JobInterview_Database');
        }elseif($routes_ns[2] == 'php'){
            return (new JointSiteRoute())
                ->withController('Src\Controllers\JobInterview\Controller_JobInterview')
                ->withAction('action_php')
                ->withModel('JointApp\Models\Model')
                ->withView('Src\Views\JobInterview\View_JobInterview_Php');
        }
    }
}