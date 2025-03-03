<?php


namespace Src\RoutesCollection;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Cv
{
    static function getRoute_Cv($routes_ns):JointSiteRoute
    {
        //cv
        //default experience
        if(!isset($routes_ns[2])){
            return (new JointSiteRoute())
                ->withController('JointApp\Controllers\Controller')
                ->withAction('actionIndex')
                ->withModel('JointApp\Models\Model')
                ->withView('Src\Views\Cv\View_Cv_Experience');
        }
        //cv/skills
        elseif (isset($routes_ns[2]) and strtolower($routes_ns[2]) == 'skills'){
            return (new JointSiteRoute())
                ->withController('JointApp\Controllers\Controller')
                ->withAction('actionIndex')
                ->withModel('JointApp\Models\Model')
                ->withView('Src\Views\Cv\View_Cv_Skills');
        }
        //cv/faq
        elseif (isset($routes_ns[2]) and strtolower($routes_ns[2]) == 'faq'){
            return (new JointSiteRoute())
                ->withController('JointApp\Controllers\Controller')
                ->withAction('actionIndex')
                ->withModel('JointApp\Models\Model')
                ->withView('Src\Views\Cv\View_Cv_Faq');
        }


    }
}