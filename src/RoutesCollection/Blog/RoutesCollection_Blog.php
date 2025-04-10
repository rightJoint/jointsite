<?php


namespace Src\RoutesCollection\Blog;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Blog
{
    static function getRoute_Blog($routes_ns):JointSiteRoute
    {
        $route = new JointSiteRoute();
        //blog
        if(!isset($routes_ns[2]) or empty($routes_ns[2])){
            $route
                ->withController('Src\Controllers\Blog\Controller_Blog')
                ->withModel('Src\Models\Blog\Model_Blog',)
                ->withAction('actionIndex')
                ->withView('Src\Views\Blog\View_Blog_Main');
        }
        //blog/article
        elseif(isset($routes_ns[2]) and strtolower($routes_ns[2]) == 'article'){
            if(isset($routes_ns[3])){
                $route
                    ->withController('Src\Controllers\Blog\Controller_Blog_Arts', ['artRef' => $routes_ns[3]])
                    ->withModel('Src\Models\Blog\Model_Blog_Arts',)
                    ->withAction('actionIndex');
                if(strtolower($routes_ns[3]) == 'joint-pass'){
                    $route->withView('Src\Views\Blog\IT\View_Blog_IT_JointPass');
                }
                elseif(strtolower($routes_ns[3]) == 'right-joint-updated'){
                    $route->withView('Src\Views\Blog\IT\View_Blog_IT_RightJointUpdated');
                }
                elseif(strtolower($routes_ns[3]) == 'phpstorm-reset-trial'){
                    $route->withView('Src\Views\Blog\IT\View_Blog_IT_PhpStormResetTrial');
                }
                elseif(strtolower($routes_ns[3]) == 'polygraph-exam'){
                    $route->withView('Src\Views\Blog\Job\View_Blog_Job_Polygrath');
                }
                elseif(strtolower($routes_ns[3]) == 'looking-for-php-fullstack-job-in-2025'){
                    $route->withView('Src\Views\Blog\IT\View_Blog_IT_PhpJob2025');
                }
                elseif(strtolower($routes_ns[3]) == 'test-task-alvasar'){
                    $route->withView('Src\Views\Blog\IT\View_Blog_IT_TestTaskAlvasar');
                }
                elseif(strtolower($routes_ns[3]) == 'test-task-parse-brackets'){
                    $route->withView('Src\Views\Blog\IT\View_Blog_IT_TestTaskParseBrackets');
                }
                elseif(strtolower($routes_ns[3]) == 'censored'){
                    $route->withView('Src\Views\Blog\Other\View_Blog_Other_Censored');
                }
                elseif(strtolower($routes_ns[3]) == 'sql-cheat-sheet'){
                    $route->withView('Src\Views\Blog\IT\View_Blog_IT_FiftySqlQuestions');
                }
                elseif(strtolower($routes_ns[3]) == 'test-task-php-job'){
                    $route->withView('Src\Views\Blog\IT\View_Blog_IT_TestTaskPhpJob');
                }
                else{
                    $route->withView('Src\Views\Blog\View_Blog_Art');
                }
            }
        }
        //blog/testTask
        elseif(isset($routes_ns[2]) and strtolower($routes_ns[2]) == 'testtask'){
            //blog/testTask/
            if(isset($routes_ns[3])){
                //blog/testTask/parse-brackets
                if(strtolower($routes_ns[3]) == 'parse-brackets'){
                    $route
                        ->withController('Src\Controllers\Blog\Controller_Blog_Test')
                        ->withModel('Src\Models\Blog\Model_Blog_Test',)
                        ->withAction('parseBrackets')
                        ->withView('Src\Views\Blog\IT\View_Blog_IT_TestTaskParseBrackets')
                        ->responseFormat('json');
                }
                //blog/testTask/alvasarcode
                elseif(strtolower($routes_ns[3]) == 'alvasarcode'){
                    $route
                        ->withController('Src\Controllers\Blog\Controller_Blog_Test')
                        ->withModel('Src\Models\Blog\Model_Blog_Test',)
                        ->withAction('alvasarCode')
                        ->withView('Src\Views\Blog\IT\View_Blog_IT_TestTaskParseBrackets')
                        ->responseFormat('json');
                }
            }
        }
        return $route;
    }

    static function postRoute_Blog($routes_ns):JointSiteRoute
    {
        $route = new JointSiteRoute();
        if (isset($routes_ns[2]) and $routes_ns[2] == 'filter') {
            $route
                ->withController('Src\Controllers\Blog\Controller_Blog')
                ->withModel('Src\Models\Blog\Model_Blog',)
                ->withAction('actionFilter')
                ->withView('Src\Views\Blog\View_Blog_Main')
                ->responseFormat('json');
        }
        elseif($routes_ns[2] == 'filter-comments'){
            $route
                ->withController('Src\Controllers\Blog\Controller_Blog_Arts')
                ->withModel('Src\Models\Blog\Model_Blog_Arts',)
                ->withAction('filterComments')
                ->withView('Src\Views\Blog\View_Blog_Art')
                ->responseFormat('json');
        }
        elseif (isset($routes_ns[2]) and strtolower($routes_ns[2]) == 'article') {
            if (isset($routes_ns[3])) {
                $route
                    ->withController('Src\Controllers\Blog\Controller_Blog_Arts', ['artRef' => $routes_ns[3]])
                    ->withModel('Src\Models\Blog\Model_Blog_Arts',)
                    ->withAction('postComment')
                    ->withAction('actionIndex');
                if (strtolower($routes_ns[3]) == 'joint-pass') {
                    $route->withView('Src\Views\Blog\IT\View_Blog_IT_JointPass');
                } elseif (strtolower($routes_ns[3]) == 'right-joint-updated') {
                    $route->withView('Src\Views\Blog\IT\View_Blog_IT_RightJointUpdated');
                } elseif (strtolower($routes_ns[3]) == 'phpstorm-reset-trial') {
                    $route->withView('Src\Views\Blog\IT\View_Blog_IT_PhpStormResetTrial');
                } elseif (strtolower($routes_ns[3]) == 'polygraph-exam') {
                    $route->withView('Src\Views\Blog\Job\View_Blog_Job_Polygrath');
                } else {
                    $route->withView('Src\Views\Blog\View_Blog_Art');
                }
            }
        }
        return $route;
    }
}