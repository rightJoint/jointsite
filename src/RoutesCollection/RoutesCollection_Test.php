<?php

namespace Src\RoutesCollection;

use JointApp\Router\JointSiteRoute;

trait RoutesCollection_Test
{
    //GET: test
    static function getRoute_Test($routes_ns):JointSiteRoute
    {
        $route = new JointSiteRoute();
        //GET: test
        if(empty($routes_ns[2])) {
            $route
                ->withController('Src\Controllers\Controller_Test')
                ->withAction('actionIndex')
                ->withModel('Src\Models\Test\Model_Test')
                ->withView('Src\Views\Test\View_Test');
        }
        //GET: test/migrations
        elseif (strtolower($routes_ns[2]) == 'migrations') {
            $route = self::getRoute_TestMigrations($routes_ns);
        }
        //GET: test/records
        elseif (strtolower($routes_ns[2]) == 'records') {
            $route = self::getRoute_Records($routes_ns);
        }
        /*
        elseif ($routes_ns[2] == 'musicAlb') {
            $route
                ->withController('Controllers\Test\Controller_Test_MusicAlb')
                ->withAction('action_index')
                ->withModel('Models\Test\Records\Model_Test_Records_MusicAlb')
                ->withView('Views\SiteView');
        }
        */
        //GET: /test/tables
        elseif (strtolower($routes_ns[2]) == 'tables') {
            return self::getRoute_TestTables($routes_ns);
        }
        //GET: /test/email
        elseif (strtolower($routes_ns[2]) == 'email') {
            return self::getRoute_TestEmail($routes_ns);
        }
        //GET: /test/files
        elseif (strtolower($routes_ns[2]) == 'files') {
            $route = new JointSiteRoute();
            $route
                ->withController('Src\Controllers\Controller_Test')
                ->withAction('actionFiles')
                ->withModel('Src\Models\Test\Model_Test')
                ->withView('Src\Views\Test\View_Test_Files');
            return $route;
            //return self::getRoute_TestEmail($routes_ns);
        }
        return $route;
    }

    //POST: test
    static function postRoute_Test($routes_ns):JointSiteRoute
    {
        if (strtolower($routes_ns[2]) == 'migrations') {
            return self::postRoute_TestMigrations($routes_ns);
        }
        //POST: test/records
        elseif (strtolower($routes_ns[2]) == 'records') {
            return self::postRoute_Records($routes_ns);
        }
        /*
        elseif (strtolower($routes_ns[2]) == 'musictracks'){
            return self::postRoute_TestMusicTracks($routes_ns);
        }
        */
        //POST: test/tables
        elseif (strtolower($routes_ns[2]) == 'tables') {
            return self::postRoute_TestTables($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'email') {
            return self::postRoute_TestEmail($routes_ns);
        }
        //POST: /test/files
        elseif (strtolower($routes_ns[2]) == 'files') {
            $route = new JointSiteRoute();
            $route
                ->withController('Src\Controllers\Controller_Test')
                ->withAction('actionFiles')
                ->withModel('Src\Models\Test\Model_Test')
                ->withView('Src\Views\Test\View_Test_Files');
            return $route;
            //return self::getRoute_TestEmail($routes_ns);
        }
    }

    //GET: test/migrations
    static function getRoute_TestMigrations($routes_ns):JointSiteRoute
    {
        $route = new JointSiteRoute();
        //GET: test/migrations
        if (empty($routes_ns[3])) {
            $route
                ->withController('Src\Controllers\Test\Controller_Test_MigrationsTest')
                ->withAction('action_index')
                ->withModel('Src\Models\Test\Model_Test')
                ->withView('Src\Views\Test\Migrations\View_Test_Migrations');
        }
        //GET: test/migrations/checkconnectserverstatus
        elseif (strtolower($routes_ns[3]) == 'checkconnectserverstatus') {
            $route
                ->withController('Src\Controllers\Test\Controller_Test_MigrationsTest')
                ->withAction('checkConnectServerStatus')
                ->withModel('JointApp\Models\Migrations\Model_Migrations')
                ->withView('Src\Views\Test\Migrations\View_Test_Migrations_Connect');
        }
        //GET: test/migrations/createmigrationstables
        elseif (strtolower($routes_ns[3]) == 'createmigrationstables') {
            $route
                ->withController('Src\Controllers\Test\Controller_Test_MigrationsTest')
                ->withAction('createMigrationsTables')
                ->withModel('JointApp\Models\Migrations\Model_Migrations')
                ->withView('Src\Views\Test\Migrations\View_Test_Migrations_CreateTables');
        }
        //GET: test/migrations/execnewmigrations
        elseif (strtolower($routes_ns[3]) == 'execnewmigrations') {
            $route
                ->withController('Src\Controllers\Test\Controller_Test_MigrationsTest')
                ->withAction('execNewMigrations')
                ->withModel('JointApp\Models\Migrations\Model_Migrations')
                ->withView('Src\Views\Test\Migrations\View_Test_Migrations_ExecNew');
        }
        //GET: test/migrations/migrationslist
        elseif (strtolower($routes_ns[3]) == 'migrationslist') {
            $route = self::getRoute_TestMigrationsList($routes_ns);
        }
        //GET: test/migrations/migrationsLog
        elseif (strtolower($routes_ns[3]) == 'migrationslog') {
            $route = self::getRoute_TestMigrationsLog($routes_ns);
        }

        return $route;
    }

    //POST: test/migrations
    static function postRoute_TestMigrations($routes_ns):JointSiteRoute
    {
        $route = new JointSiteRoute();
        //POST: test/migrations/migrationslist
        if (strtolower($routes_ns[3]) == 'migrationslist') {
            if (strtolower($routes_ns[4]) == 'toppanelactions') {
                $route = (new JointSiteRoute())
                    ->withController('JointApp\Controllers\Migrations\Controller_MigrationsList',
                        array('processUri' => '/test/migrations/migrationsList'))
                    ->withModel('JointApp\Models\Migrations\Model_Migrations')
                    ->withAction('topPanelActions')
                    ->withView('JointApp\Views\View');
                return $route;
            }
            $route = self::postRoute_TestMigrationsList($routes_ns);
        }
        //POST: test/migrations/migrationslist/topPanelActions
        elseif (strtolower($routes_ns[3]) == 'toppanelactions') {
            $route = (new JointSiteRoute())
                ->withController('JointApp\Controllers\Migrations\Controller_MigrationsList',
                    array('processUri' => '/test/migrations/migrationsList'))
                ->withModel('JointApp\Models\Migrations\Model_Migrations')
                ->withAction('topPanelActions')
                ->withView('JointApp\Views\View');
        }
        //POST: test/migrations/migrationslist/migrationslog
        elseif (strtolower($routes_ns[3]) == 'migrationslog') {
            $route = self::postRoute_TestMigrationsLog($routes_ns);
        }
        return $route;
    }

    //GET: test/migrations/migrationslist
    static function getRoute_TestMigrationsList($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Migrations\Controller_MigrationsList',
                array('processUri' => '/test/migrations/migrationsList'))
            ->withModel('JointApp\Models\Migrations\Model_Migrations');

        //GET: test/migrations/migrationslist.../listview
        if(!isset($routes_ns[4]) or strtolower($routes_ns[4]) == 'listview'){
            $route
                ->withAction('listTopPanel')
                ->withAction('getListView')
                ->withView('JointApp\Views\Records\RecordListView');
        }
        //GET: test/migrations/migrationslist/detailview
        elseif (strtolower($routes_ns[4]) == 'detailview'){
            $route->withAction('detailTopPanel')
                ->withAction('getDetailView')
                ->withView('JointApp\Views\Records\RecordDetailView');
        }
        //GET: test/migrations/migrationslist/editview
        elseif (strtolower($routes_ns[4]) == 'editview'){
            $route->withAction('detailTopPanel')
                ->withAction('getEditView')
                //->withView('JointApp\Views\Records\RecordEditView');
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        //GET: test/migrations/migrationslist/newview
        elseif (strtolower($routes_ns[4]) == 'newview'){
            $route->withAction('getNewView')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        //GET: test/migrations/migrationslist/newview
        elseif (strtolower($routes_ns[4]) == 'deleteview'){
            $route->withAction('getDeleteView')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        return  $route;
    }

    //POST: test/migrations/migrationslist
    static function postRoute_TestMigrationsList($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Migrations\Controller_MigrationsList',
                array('processUri' => '/test/migrations/migrationsList'))
            ->withModel('JointApp\Models\Migrations\Model_Migrations');

        //POST: test/migrations/migrationslist..listview
        if (!isset($routes_ns[4]) or strtolower($routes_ns[4]) == 'listview') {
            $route
                ->withAction('applyFilterView')
                ->withView('JointApp\Views\Records\RecordListView')
                ->responseFormat('json');
        }
        //POST: test/migrations/migrationslist/editview
        elseif (strtolower($routes_ns[4]) == 'editview') {
            $route->withAction('detailTopPanel')
                ->withAction('postEditView')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        //POST: test/migrations/migrationslist/deleteview
        elseif (strtolower($routes_ns[4]) == 'deleteview') {
            $route
                ->withAction('postDeleteView')
                //->withAction('getViewSelectTblPanel')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        //POST: test/migrations/migrationslist/newview
        elseif (strtolower($routes_ns[4]) == 'newview') {
            $route
                ->withAction('postNewView')
                //->withAction('getViewSelectTblPanel')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        return $route;
    }

    //GET: test/migrations/migrationslog
    static function getRoute_TestMigrationsLog($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Migrations\Controller_MigrationsLog',
                array('processUri' => '/test/migrations/migrationslog'))
            ->withModel('JointApp\Models\Migrations\Model_MigrationsLog');

        //GET: test/migrations/migrationslog.../listview
        if(!isset($routes_ns[4]) or strtolower($routes_ns[4]) == 'listview'){
            $route
                //->withAction('listTopPanel')
                ->withAction('getListView')
                ->withView('JointApp\Views\Records\RecordListView');
        }
        //GET: test/migrations/migrationslog/detailview
        elseif (strtolower($routes_ns[4]) == 'detailview'){
            $route
                //->withAction('detailTopPanel')
                ->withAction('getDetailView')
                ->withView('JointApp\Views\Records\RecordDetailView');
        }
        //GET: test/migrations/migrationslog/editview
        elseif (strtolower($routes_ns[4]) == 'editview'){
            $route
                //->withAction('detailTopPanel')
                ->withAction('getEditView')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        //GET: test/migrations/migrationslog/newview
        elseif (strtolower($routes_ns[4]) == 'newview'){
            $route
                ->withAction('getNewView')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        //GET: test/migrations/migrationslog/newview
        elseif (strtolower($routes_ns[4]) == 'deleteview'){
            $route
                ->withAction('getDeleteView')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        return  $route;
    }

    //POST: test/migrations/migrationslog
    static function postRoute_TestMigrationsLog($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('JointApp\Controllers\Migrations\Controller_MigrationsLog',
                array('processUri' => '/test/migrations/migrationslog'))
            ->withModel('JointApp\Models\Migrations\Model_MigrationsLog');

        //POST: test/migrations/migrationslog..listview
        if (!isset($routes_ns[4]) or strtolower($routes_ns[4]) == 'listview') {
            $route
                ->withAction('applyFilterView')
                ->withView('JointApp\Views\Records\RecordListView')
                ->responseFormat('json');
        }
        //POST: test/migrations/migrationslog/editview
        elseif (strtolower($routes_ns[4]) == 'editview') {
            $route
                //->withAction('detailTopPanel')
                ->withAction('postEditView')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        //POST: test/migrations/migrationslog/deleteview
        elseif (strtolower($routes_ns[4]) == 'deleteview') {
            $route
                ->withAction('postDeleteView')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        //POST: test/migrations/migrationslog/newview
        elseif (strtolower($routes_ns[4]) == 'newview') {
            $route
                ->withAction('postNewView')
                ->withView('JointApp\Views\Records\RecordEditView');
        }
        return $route;
    }

    //GET: test/records
    static function getRoute_Records($routes_ns):JointSiteRoute
    {
        $route = new JointSiteRoute();
        //test/records
        if(!isset($routes_ns[3])){
            $route
                ->withController("Src\Controllers\Controller_Test")
                ->withAction("action_records")
                ->withModel("JointApp\Models\Model_Pdo")
                ->withView("Src\Views\Test\View_Test_Records");
        }elseif (!empty($routes_ns[3])){
            $route
                ->withController('Src\Controllers\Controller_Test',
                    array('processUri' => '/test/records/'.$routes_ns[3]))
                ->withModel('JointApp\Models\Records\RecordsModel', array('tableName' => $routes_ns[3]));

            if(!isset($routes_ns[4]) or $routes_ns[4] == 'listview'){
                $route
                    ->withAction('getListView')
                    ->withAction('getViewSelectTblPanel')
                    ->withView('JointApp\Views\Records\RecordListView');

            }elseif ($routes_ns[4] == 'detailview'){
                $route->withAction('getDetailView')
                    ->withAction('getViewSelectTblPanel')
                    ->withView('JointApp\Views\Records\RecordDetailView');
            }elseif ($routes_ns[4] == 'editview'){
                $route->withAction('getEditView')
                    ->withAction('getViewSelectTblPanel')
                    ->withView('JointApp\Views\Records\RecordEditView');
            }elseif ($routes_ns[4] == 'newview'){
                $route->withAction('getNewView')
                    ->withAction('getViewSelectTblPanel')
                    ->withView('JointApp\Views\Records\RecordEditView');
            }elseif ($routes_ns[4] == 'deleteview'){
                $route->withAction('getDeleteView')
                    ->withAction('getViewSelectTblPanel')
                    ->withView('JointApp\Views\Records\RecordEditView');
            }
        }

        return $route;
    }

    //POST: test/records
    static function postRoute_Records($routes_ns):JointSiteRoute
    {
        //POST: test/records
        if (isset($routes_ns[3]) and !empty($routes_ns[3])) {
            $route = (new JointSiteRoute())
                ->withController("Src\Controllers\Controller_Test", array('processUri' => '/test/records/'.$routes_ns[3]))
                ->withModel("JointApp\Models\Records\RecordsModel", array('tableName' => $routes_ns[3]));

            //POST: test/records/...tableName.../listview
            if (!isset($routes_ns[4]) or $routes_ns[4] == 'listview') {
                $route
                    ->withAction('applyFilterView')
                    //->withAction('getViewSelectTblPanel')
                    ->withView('JointApp\Views\Records\RecordListView')
                    ->responseFormat('json');
            }
            //POST: test/records/...tableName.../editview
            elseif ($routes_ns[4] == 'editview') {
                $route
                    ->withAction('postEditView')
                    ->withAction('getViewSelectTblPanel')
                    ->withView('JointApp\Views\Records\RecordEditView');
            }
            //POST: test/records/...tableName.../deleteview
            elseif ($routes_ns[4] == 'deleteview') {
                $route
                    ->withAction('postDeleteView')
                    ->withAction('getViewSelectTblPanel')
                    ->withView('JointApp\Views\Records\RecordEditView');
            }
            //POST: test/records/...tableName.../newview
            elseif ($routes_ns[4] == 'newview') {
                $route
                    ->withAction('postNewView')
                    ->withAction('getViewSelectTblPanel')
                    ->withView('JointApp\Views\Records\RecordEditView');
            }
        }
        return $route;
    }

    static function getRoute_TestEmail($routes_ns):JointSiteRoute
    {
        $route = new JointSiteRoute();
        if(!isset($routes_ns[3])){
            $route
                ->withController("Src\Controllers\Test\Controller_Test_Email")
                //->withModel("JointApp\JointAppMailer");
                ->withModel('JointApp\Models\Model');
            $route->withAction('actionMain')
                ->withView('Src\Views\Test\View_Test_Email');
        }elseif (strtolower($routes_ns[3]) == 'test-for-user'){
            $route
                ->withController("Src\Controllers\Test\Controller_Test_Email")
                //->withModel("JointApp\JointAppMailer");
                ->withModel("JointApp\Models\Model_Pdo");
            $route->withAction('actionTestMailUser')
                ->withView('JointApp\Views\View');
           // exit;
        }

        return  $route;
    }

    static function postRoute_TestEmail($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('Src\Controllers\Test\Controller_Test_Email')
            ->withModel('JointApp\Models\Model');
        $route->withAction('actionMain')
            ->withView('Src\Views\Test\View_Test_Email');
        return  $route;
    }

    public static function getRoute_TestTables($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('Src\Controllers\Test\Controller_Test_Tables')
            ->withModel('Src\Models\Test\Model_Test_Tables')
            ->withView('Src\Views\Test\View_Test_Tables');

        if(!isset($routes_ns[3])){
            $route
                ->withAction('actionMain');
        }
        elseif (strtolower($routes_ns[3]) == 'clear'){
            $route
                ->withAction('actionClearTable')
                ->responseFormat('json');
        }
        elseif (strtolower($routes_ns[3]) == 'download'){
            $route
                ->withAction('actionDownloadTable')
                ->responseFormat('json');
        }
        elseif (strtolower($routes_ns[3]) == 'drop'){
            $route
                ->withAction('actionDropTable')
                ->responseFormat('json');
        }
        elseif (strtolower($routes_ns[3]) == 'create'){
            $route
                ->withAction('actionCreateTable')
                ->responseFormat('json');
        }
        elseif (strtolower($routes_ns[3]) == 'upload'){
            $route
                ->withAction('actionUploadTable')
                ->responseFormat('json');
        }
        elseif (strtolower($routes_ns[3]) == 'uploadall'){
            $route
                ->withAction('actionUploadAll')
                ->responseFormat('json');
        }

        elseif (strtolower($routes_ns[3]) == 'refreshtables'){
            $route
                ->withAction('actionRefreshTables')
                ->responseFormat('json');
        }


        return $route;
    }

    public static function postRoute_TestTables($routes_ns):JointSiteRoute
    {
        $route = (new JointSiteRoute())
            ->withController('Src\Controllers\Test\Controller_Test_Tables')
            ->withModel('Src\Models\Test\Model_Test_Tables');
        $route
            ->withAction('actionMain')
            ->withView('Src\Views\Test\View_Test_Tables');

        return $route;
    }
}