<?php


namespace Src\RoutesCollection\Handbook;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Handbook
{
    static function getRoute_Handbook($routes_ns):JointSiteRoute
    {
        return (new JointSiteRoute())
            ->withController('Src\Controllers\Handbook\Controller_HandbookMain')
            ->withAction('actionIndex')
            ->withModel('Src\Models\Handbook\Model_Handbook_Main')
            ->withView('Src\Views\Handbook\View_Handbook_Main');
        //cv
        //default experience
        /*
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

        */

    }
}