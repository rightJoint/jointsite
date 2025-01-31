<?php


namespace JointApp\Router\RoutesCollection;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_User
{
    static function getRoute_User($routes_ns):JointSiteRoute
    {
        global $currentUser;

        $route = new JointSiteRoute();

        if(isset($routes_ns[2]) and strtolower($routes_ns[2]) == 'cmd'){
            $route
                ->withController('JointApp\Controllers\Controller_Auth')
                ->withModel('JointApp\Models\Model')
                ->withAction('actionCmd')
                ->withView('JointApp\Views\View');

            return $route;
        }
        if(empty($currentUser->user_id)){
                if (!(isset($routes_ns[2])) or
                    (isset($routes_ns[2]) and empty($routes_ns[2]))) {
                    $route
                        ->withController('JointApp\Controllers\Controller_Auth')
                        ->withModel('JointApp\Models\Model')
                        ->withAction('actionGetSignIn')
                        ->withView('JointApp\Views\User\View_User_SignIn');
                }elseif (isset($routes_ns[2]) and strtolower($routes_ns[2]) == 'signin') {
                    $route
                        ->withController('JointApp\Controllers\Controller_Auth')
                        ->withModel('JointApp\Models\User\Model_User')
                        ->withAction('actionGetSignIn')
                        ->withView('JointApp\Views\User\View_User_SignIn');
                }elseif (isset($routes_ns[2]) and strtolower($routes_ns[2]) == 'signup') {
                    $route
                        ->withController('JointApp\Controllers\Controller_Auth')
                        ->withModel('JointApp\Models\Model')
                        ->withAction('actionGetSignUp')
                        ->withView('JointApp\Views\User\View_User_SignUp');
                }
                elseif (isset($routes_ns[2]) and strtolower($routes_ns[2]) == 'validate') {
                    $route
                        ->withController('JointApp\Controllers\User\Controller_User_Validate')
                        ->withModel('JointApp\Models\User\Model_User_Validate')
                        ->withAction('actionIndex')
                        ->withView('JointApp\Views\User\View_User_Validate');
                }
        }
        //auth user
        else {
            if (!(isset($routes_ns[2])) or
                (isset($routes_ns[2]) and empty($routes_ns[2]))) {
                $route
                    ->withController('JointApp\Controllers\User\Controller_User_Main')
                    ->withModel('JointApp\Models\User\Model_User_Main')
                    ->withAction('actionUserSubMenu')
                    ->withAction('actionGetUserMain')
                    ->withView('JointApp\Views\User\View_User_Main');
            }
            elseif (strtolower($routes_ns[2]) == 'notifications') {
                if(!isset($routes_ns[3]) or empty($routes_ns[3])){
                    $route
                        ->withController('JointApp\Controllers\User\Controller_User_Notifications')
                        ->withModel('JointApp\Models\User\Model_User_Notifications')
                        ->withAction('actionUserSubMenu')
                        ->withAction('actionGetUserNtfList')
                        ->withView('JointApp\Views\User\View_User_NtfList');
                }elseif($routes_ns[3] == 'detailview'){
                    $route
                        ->withController('JointApp\Controllers\User\Controller_User_Notifications')
                        ->withModel('JointApp\Models\User\Model_User_Notifications')
                        ->withAction('actionUserSubMenu')
                        ->withAction('actionGetUserNtfDetail')
                        ->withView('JointApp\Views\User\View_User_NtfDetail');
                }

            }
            elseif (strtolower($routes_ns[2]) == 'changeemail') {
                $route
                    ->withController('JointApp\Controllers\User\Controller_User_Email')
                    ->withModel('JointApp\Models\User\Model_User_Email')
                    ->withAction('actionUserSubMenu')
                    ->withAction('actionGetChangeEmail')
                    ->withView('JointApp\Views\User\View_User_Email');
            }
            elseif (strtolower($routes_ns[2]) == 'changepassword') {
                $route
                    ->withController('JointApp\Controllers\User\Controller_User_Password')
                    ->withModel('JointApp\Models\User\Model_User_Password')
                    ->withAction('actionUserSubMenu')
                    ->withAction('actionGetUserPassword')
                    ->withView('JointApp\Views\User\View_User_Password');
            }
            elseif (strtolower($routes_ns[2]) == 'usergroups') {
                $route
                    ->withController('JointApp\Controllers\User\Controller_User_Groups')
                    ->withModel('JointApp\Models\User\Model_User_Groups')
                    ->withAction('actionUserSubMenu')
                    ->withAction('actionGetUserGroups')
                    ->withView('JointApp\Views\User\View_User_Groups');
            }
            elseif (strtolower($routes_ns[2]) == 'signin') {
                $route
                    ->withModel('JointApp\Models\Model')
                    ->withController('JointApp\Controllers\Controller_Auth')
                    ->withView('JointApp\Views\User\View_User_SignIn');
            } elseif (strtolower($routes_ns[2]) == 'signup') {
                $route
                    ->withController('JointApp\Controllers\Controller_Auth')
                    ->withModel('JointApp\Models\Model')
                    ->withAction('actionGetSignUp')
                    ->withView('JointApp\Views\User\View_User_SignUp');
            }
            elseif (isset($routes_ns[2]) and strtolower($routes_ns[2]) == 'validate') {
                $route
                    ->withController('JointApp\Controllers\User\Controller_User_Validate')
                    ->withModel('JointApp\Models\User\Model_User_Validate')
                    ->withAction('actionIndex')
                    ->withView('JointApp\Views\User\View_User_Validate');
            }
        }

        return $route;
    }

    static function postRoute_User($routes_ns):JointSiteRoute
    {
        global $currentUser;
        $route = new JointSiteRoute();

        if(empty($currentUser->user_id)){
            $route->withController('JointApp\Controllers\Controller_Auth')
                ->withModel('JointApp\Models\User\Model_User');
            if(isset($routes_ns[2]) and (strtolower($routes_ns[2]) == 'signin')){

                $route
                    ->withAction('actionPostSignIn')
                    ->withView('JointApp\Views\User\View_User_SignIn');

            }elseif(isset($routes_ns[2]) and strtolower($routes_ns[2]) == 'signup'){
                $route
                    ->withAction('actionPostSignUp')
                    ->withView('JointApp\Views\User\View_User_SignUp');
            }
        }
        //auth user
        else {
            if (!(isset($routes_ns[2])) or
                (isset($routes_ns[2]) and empty($routes_ns[2]))) {
                $route
                    ->withController('JointApp\Controllers\User\Controller_User_Main')
                    ->withModel('JointApp\Models\User\Model_User_Main')
                    ->withAction('actionUserSubMenu')
                    ->withAction('actionPostUserMain')
                    ->withView('JointApp\Views\User\View_User_Main');
            }elseif (isset($routes_ns[2])){
                if($routes_ns[2] == 'notifications'){
                    $route
                        ->withController('JointApp\Controllers\User\Controller_User_Notifications')
                        ->withModel('JointApp\Models\User\Model_User_Notifications')
                        ->withAction('applyFilterView')
                        ->withView('JointApp\Views\User\View_User_NtfList')
                        ->responseFormat('json');
                }elseif (strtolower($routes_ns[2]) == 'changeemail') {
                    $route
                        ->withController('JointApp\Controllers\User\Controller_User_Email')
                        ->withModel('JointApp\Models\User\Model_User_Email')
                        ->withAction('actionUserSubMenu')
                        ->withAction('actionPostChangeEmail')
                        ->withView('JointApp\Views\User\View_User_Email');
                }elseif (strtolower($routes_ns[2]) == 'changepassword') {
                    $route
                        ->withController('JointApp\Controllers\User\Controller_User_Password')
                        ->withModel('JointApp\Models\User\Model_User_Password')
                        ->withAction('actionUserSubMenu')
                        ->withAction('actionPostChangePassword')
                        ->withView('JointApp\Views\User\View_User_Password');
                }
            }
        }



        return $route;
    }
}