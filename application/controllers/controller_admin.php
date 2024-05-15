<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/core/RecordsController.php";
class controller_admin extends RecordsController
{
    function __construct($loaded_model, $loaded_view)
    {
        parent::__construct($loaded_model, $loaded_view);

        //load admin config
        require_once JOINT_SITE_CONF_DIR."/admin_conf.php";

        if($_GET["cmd"] == "exit"){
            unset($_SESSION[JS_SAIK]["admin_user"]);
            header("Location: ".$_SERVER["HTTP_REFERER"]);
        }
        //$this->model = new Model_Admin();
        //$this->view = new View();
        if(!$this->hasAccessAdmin()){
            if(!$this->auth_user()){
                jointSite::throwErr("access", $this->lang_map->auth_required_err);
            }
        }

        //include "application/views/admin/adminView.php";
    }

    function LoadCntrlLang_custom()
    {
        parent::LoadModel_custom();
        require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR . "/application/lang_files".
            "/controllers/lang_cntrl_admin_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_cntrl_admin_".$_SESSION[JS_SAIK]["lang"];
    }

    function hasAccessAdmin()
    {
        if(!$_SESSION[JS_SAIK]["admin_user"]["id"]){
            return false;
        }
        return true;
    }

    function auth_user()
    {
        if($_POST["auth_admin"] and
            ($_POST["auth_admin"] == $this->view->lang_map->adminblock["submit_btn"])){

            $adminUsers = $this->model->get_admin_users();

            foreach ($adminUsers as $usr=>$pw){
                if($_POST['login']==$usr and hash_equals($pw, crypt($_POST['password'], $pw)))
                {
                    $_SESSION[JS_SAIK]['admin_user']['id']=$_POST['login'];
                    return true;
                }
            }
            jointSite::throwErr("access", $this->lang_map->auth_err_login);

        }
        return false;
    }

    function action_index()
    {
        include "application/views/admin/adminMainView.php";
        $this->view = new adminMainView();
        parent::action_index();
    }

}


/*
require_once JOINT_CONF_DIR."/admin/admin_conf.php";
require_once "application/core/Records/RecordsController.php";
require_once "application/lang_files/controllers/lang_cntrl_admin_".$_SESSION["lang"].".php";
class Controller_Admin extends RecordsController
{
    function __construct()
    {
        $lang_name = "lang_cntrl_admin_".$_SESSION["lang"];
        $this->lang_map = new $lang_name;

        if($_GET["cmd"] == "exit"){
            unset($_SESSION["admin_user"]);
            header("Location: ".$_SERVER["HTTP_REFERER"]);
        }
        $this->model = new Model_Admin();
        $this->view = new View();
        if(!$this->controllerAccess()){
            if(!$this->auth_user()){
                throwErr("access", $this->lang_map->auth_required_err);
            }
        }

        include "application/views/admin/adminView.php";
    }

    function controllerAccess()
    {
        if(!$_SESSION["admin_user"]["id"]){
            return false;
        }
        return true;
    }

    function auth_user()
    {
        $_SESSION["admin_user"]["auth_err"] = null;

        if($_POST["auth_admin"] == $this->view->lang_map->adminblock["submit_btn"]){
            $adminUsers = $this->model->get_admin_users();

            if($adminUsers["status"]){
                foreach ($adminUsers["list"] as $usr=>$pw){
                    if($_POST['login']==$usr and hash_equals($pw, crypt($_POST['password'], $pw)))
                    {
                        $_SESSION['admin_user']['id']=$_POST['login'];
                        $_SESSION["admin_user"]["auth_err"] = null;
                        return true;
                    }
                }
                $_SESSION["admin_user"]["auth_err"] = $this->lang_map->auth_err_login;
            }else{
                $_SESSION["admin_user"]["auth_err"] = $adminUsers["err"];
            }
        }

        return false;
    }

    function action_index()
    {
        include "application/views/admin/adminMainView.php";
        $this->view = new adminMainView();
        parent::action_index();
    }

    function action_server()
    {

        if($_POST['saveFlag']=='y'){
            $this->model->save_conn_settings();
            $this->model = new Model_Admin();
        }

        include "application/views/admin/adminServerView.php";

        $this->view = new AdminServerView();

        $this->view->sql_connection = $this->model->sql_connection;
        $this->view->list_databases = @$this->model->query("SHOW DATABASES;");
        parent::action_index();
    }

    function action_users()
    {
        include "application/views/admin/adminUsersView.php";

        $this->view = new adminUsersView();

        if($_POST['addAdmUsrFlag']==='y'){
            $addUsrRes['result']=false;
            $addUsrRes['log']=null;
            if($this->model->checkAdminLogin($_POST['newUsrName'])){
                if($this->model->checkAdminPassword($_POST['newUsrPass'])){
                    $adminUsers = $this->model->get_admin_users();
                    $findDoubleUsr=false;

                    if($adminUsers["status"]){
                        foreach ($adminUsers["list"] as $usr=>$pw){
                            if($usr==$_POST['newUsrName'])
                            {
                                $findDoubleUsr=true;
                                break;
                            }
                        }
                    }
                    if($findDoubleUsr){
                        $addUsrRes['log'] = $this->lang_map->admin_users["login_reserved"]." - ".$_POST['newUsrName'];
                    }else{
                        $adminUsers["list"][$_POST['newUsrName']] = crypt($_POST['newUsrPass']);
                        if(file_put_contents($_SERVER["DOCUMENT_ROOT"].PATH_TO_USR_LIST,
                            json_encode($adminUsers["list"], true))){
                            $addUsrRes['result']=true;
                            $addUsrRes['log'] = $this->lang_map->admin_users["Success"];
                        }else{
                            $addUsrRes['log'] = $this->lang_map->admin_users["unknown"];
                        }
                    }
                }else{
                    $addUsrRes['log'].=$this->lang_map->admin_users["password_unacceptable"];
                }
            }else{
                $addUsrRes['log'] = $this->lang_map->admin_users["login_unacceptable"];
            }
            $this->view->generateJson($addUsrRes);
        }elseif (isset($_GET['action']) and $_GET['action']=='refreshUsers'){
            $this->view->adminUsers = $this->model->get_admin_users();
            $this->view->print_users_list();
        }elseif (isset($_GET["dropUser"]) and $_GET["dropUser"]!=null){
            $adminUsers = $this->model->get_admin_users();
            unset($adminUsers["list"][$_GET["dropUser"]]);
            if(file_put_contents($_SERVER["DOCUMENT_ROOT"].PATH_TO_USR_LIST,
                json_encode($adminUsers["list"], true))){
            }
            $this->view->adminUsers = $this->model->get_admin_users();
            $this->view->print_users_list();
        }else{
            $this->view->adminUsers = $this->model->get_admin_users();
            parent::action_index();
        }
    }

    function action_sql()
    {
        include "application/views/admin/adminSqlView.php";
        $this->view = new adminSqlView();

        if(isset($_POST['queryText'])){
            $queryPosting_text = $_POST['queryText'];
            $queryPosting['result']=false;
            $queryPosting['log']=null;

            if($queryPosting_res = @$this->model->query($queryPosting_text)){
                $queryPosting['result']=true;
                if($queryPosting_res->rowCount() > 0){
                    $queryPosting['log']= $this->lang_map->admin_sql["susses"].": (".$queryPosting_res->rowCount().") ".
                        $this->lang_map->admin_sql["row"];
                }else{
                    $queryPosting['log']= $this->lang_map->admin_sql["susses_no_rows"];
                }
            }else{
                $queryPosting['log'] = $this->lang_map->admin_sql["fail"];
            }
            $this->view->generateJson($queryPosting);
        }else{
            parent::action_index();
        }
    }

    function action_printquery()
    {
        include "application/views/admin/adminPrintqueryView.php";
        $this->view = new adminPrintqueryView();

        if(isset($_POST['queryText'])){
            if($this->view->query_result = @$this->model->query($_POST['queryText']." LIMIT ".$_POST['qp-limit']))
            {
                $log = $this->view->print_sql_results();
            }else{
                $log["result"] = false;
                $log["log"] = $this->lang_map->admin_printquery["fail"];
            }
            $this->view->generateJson($log);
        }else{
            parent::action_index();
        }
    }

    function action_tables()
    {
        include "application/views/admin/adminTablesView.php";
        $this->view = new AdminTablesView();

        if($_GET['action']==="refreshTables"){
            $this->model->glob_create_tables();
            $this->model->dbCompare();
            $this->model->glob_load_tables();
            $this->view->tables = $this->model->tables["tables"];
            $this->view->tables_list();
        }
        elseif($_GET['action']==="upLoadAll"){
            $this->model->dbCompare();
            $data = $this->model->uploadAllTables();
            $data['log'].=AdminTables_View::print_date_stamp();
            $this->view->generateJson($data);
        }elseif ( in_array($_GET['action'],
            array("clear", "download", "drop", "create", "upLoad"))){

            $action = $_GET['action']."Table";

            if($_GET["action"] == "download"){
                $argum = $_GET['dwlTable'];
            }else{
                $argum = $_GET['tableName'];
            }

            if($_GET['action'] != "upLoad") {
                if ($this->model->$action($argum)) {
                    $data["err"] = 0;
                } else {
                    $data["err"] = $this->lang_map->table_actions[$_GET["action"]] . " " .
                        $this->lang_map->table_actions["table"] . " " .
                        $this->lang_map->table_actions["fail"];
                }
            }else{
                $data = $this->model->uploadTable($_GET['tableName'], $_GET['prefixTag'], $_GET["dateTag"], TABLE_EXT_FILE);
            }

            $this->model->glob_create_tables();
            $this->model->dbCompare($_GET['tableName']);
            $this->model->glob_load_tables();

            $data["row"] = AdminTablesView::table_cell($_GET['tableName'], $this->model->tables["tables"][$_GET['tableName']]);

            $data['log'].=$this->lang_map->table_actions["action"].": ".
                $this->lang_map->table_actions[$_GET["action"]]."<br>".
                "<ul>".$this->lang_map->table_actions["options"].":<li>".
                $this->lang_map->table_actions["tableName"]."--> ".$_GET['tableName']."</li></ul>".
                AdminTablesView::print_date_stamp();
            $this->view->generateJson($data);
        }
        else{
            $this->model->glob_create_tables();
            $this->model->dbCompare();
            $this->model->glob_load_tables();
            $this->view->tables = $this->model->tables["tables"];

            parent::action_index();
        }
    }

    function action_records()
    {
        include "application/core/Records/RecordsModel.php";

        $this->model = new Model();

        $view_data = $this->model->query("SHOW TABLES");

        $tableName = null;

        global $routes;
        if($routes[3]){
            $tableName = $routes[3];
        }elseif($_GET["table"]){
            $tableName = $_GET["table"];
        }elseif ($view_data){
            $table_row = $this->model->query("SHOW TABLES")->fetch();
            $tableName =  $table_row[0];
        }

        $this->records_process("admin/records", $tableName, $view_data);
    }

}*/