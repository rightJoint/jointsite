<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/core/RecordsController.php";
class controller_admin extends RecordsController
{
    public $admin_process_url = JOINT_SITE_EXEC_DIR."/admin";

    function __construct($loaded_model, $loaded_view, $action_name)
    {
        parent::__construct($loaded_model, $loaded_view, $action_name);

        //load admin config
        require_once JOINT_SITE_CONF_DIR."/admin_conf.php";

        if(isset($_GET["cmd"]) and $_GET["cmd"] == "exit"){
            unset($_SESSION[JS_SAIK]["admin_user"]);
            header("Location: ".$_SERVER["HTTP_REFERER"]);
        }
        if(!$this->hasAccessAdmin()){
            if(!$this->auth_user()){
                jointSite::throwErr("access", $this->lang_map->auth_required_err);
            }
        }
        $this->view->admin_process_url = $this->admin_process_url;
    }

    function LoadView_custom($action_name = null)
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/views/view_admin.php";
        if($action_name == "index"){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/admin/view_admin_main.php";
            return "view_admin_main";
        }elseif($action_name == "migrations"){

            global $request;
            $apurl_cnt = count(explode("/", $this->admin_process_url));
            if(isset($request["routes"][$apurl_cnt+1]) and $request["routes"][$apurl_cnt+1] == "detailview"){
                require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                    "/application/views/admin/migrations/View_migrations_detailview.php";
                return "View_migrations_detailview";
            }elseif (isset($request["routes"][$apurl_cnt+1]) and $request["routes"][$apurl_cnt+1] == "editview"){
                require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                    "/application/views/admin/migrations/View_migrations_editview.php";
                return "View_migrations_editview";
            }elseif (!isset($request["routes"][$apurl_cnt+1])){
                require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                    "/application/views/admin/view_migrations.php";
                return "view_migrations";
            }elseif (isset($request["routes"][$apurl_cnt+1]) and $request["routes"][$apurl_cnt+1] == "log"){
                if(isset($request["routes"][$apurl_cnt+2]) and $request["routes"][$apurl_cnt+2] == "detailview"){
                    require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                        "/application/views/admin/migrations/log/view_log_detailview.php";
                    return "view_log_detailview";
                }elseif (!isset($request["routes"][$apurl_cnt+2])){
                    require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                        "/application/views/admin/migrations/view_migrations_log.php";
                    return "view_migrations_log";
                }
            }
        }elseif (method_exists($this, "action_".$action_name)){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/admin/view_admin_".$action_name.".php";
            return "view_admin_".$action_name;
        }
    }

    function LoadModel_custom($action_name = null)
    {
        parent::LoadModel_custom($action_name); // TODO: Change the autogenerated stub
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/models/model_admin.php";
        return "model_admin";
    }

    function LoadCntrlLang_custom()
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR . "/application/lang_files".
            "/controllers/lang_cntrl_admin_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_cntrl_admin_".$_SESSION[JS_SAIK]["lang"];
    }

    function hasAccessAdmin()
    {
        if(!isset($_SESSION[JS_SAIK]["admin_user"]["id"])){
            return false;
        }
        return true;
    }

    function auth_user()
    {
        if(isset($_POST["auth_admin"]) and
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
    function action_server()
    {
        if(isset($_POST['saveFlag']) and $_POST['saveFlag']=='y'){
            $this->model->save_conn_settings();
            $this->model = new Model_Admin();
        }

        if($this->model->sql_connection["connRes"]){
            $this->view->list_databases = @$this->model->query("SHOW DATABASES;");
        }

        $this->view->sql_connection = $this->model->sql_connection;

        parent::action_index();
    }

    function action_users()
    {
        if(isset($_POST['addAdmUsrFlag']) and $_POST['addAdmUsrFlag']==='y'){
            $addUsrRes['result']=false;
            $addUsrRes['log']=null;
            if($this->model->checkAdminLogin($_POST['newUsrName'])){
                if($this->model->checkAdminPassword($_POST['newUsrPass'])){
                    $adminUsers = $this->model->get_admin_users();
                    $findDoubleUsr=false;
                    foreach ($adminUsers as $usr=>$pw){
                        if($usr==$_POST['newUsrName'])
                        {
                            $findDoubleUsr=true;
                            break;
                        }
                    }
                    if($findDoubleUsr){
                        $addUsrRes['log'] = $this->lang_map->admin_users["login_reserved"]." - ".$_POST['newUsrName'];
                    }else{
                        $adminUsers[$_POST['newUsrName']] = password_hash($_POST['newUsrPass'], PASSWORD_DEFAULT);
                        if(file_put_contents(PATH_TO_USR_LIST,
                            json_encode($adminUsers, true))){
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
            unset($adminUsers[$_GET["dropUser"]]);
            if(file_put_contents(PATH_TO_USR_LIST,
                json_encode($adminUsers, true))){
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
        if(isset($_POST['queryText'])){
            $queryPosting_text = $_POST['queryText'];
            $queryPosting['result']=false;
            $queryPosting['log']=null;

            if($queryPosting_res = $this->model->pdo_query($queryPosting_text)){
                $queryPosting['result']=true;
                if($queryPosting_res->rowCount() > 0){
                    $queryPosting['log']= $this->lang_map->admin_sql["success"].": (".$queryPosting_res->rowCount().") ".
                        $this->lang_map->admin_sql["row"];
                }else{
                    $queryPosting['log']= $this->lang_map->admin_sql["success_no_rows"];
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
        if(isset($_POST['queryText'])){
            if($this->view->query_result = @$this->model->pdo_query($_POST['queryText']." LIMIT ".$_POST['qp-limit']))
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
        $data['log'] = null;
        if(isset($_GET['action']) and $_GET['action']==="refreshTables"){
            $this->model->glob_create_tables();
            $this->model->get_tables_from_db();
            $this->model->glob_load_tables();
            $this->view->tables = $this->model->tables["tables"];
            $this->view->tables_list();
        }
        elseif(isset($_GET['action']) and $_GET['action']==="upLoadAll"){
            $this->model->get_tables_from_db();
            $data = $this->model->uploadAllTables();
            $data['log'].=view_admin_tables::print_date_stamp();
            $this->view->generateJson($data);
        }elseif (isset($_GET['action']) and  in_array($_GET['action'],
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
            $this->model->glob_create_tables($_GET['tableName']);
            $this->model->get_tables_from_db($_GET['tableName']);
            $this->model->glob_load_tables($_GET['tableName']);
            $trimTableName = $_GET['tableName'];

            $access_table_cell = null;
            if(isset($this->model->tables["tables"][$trimTableName])){
                $access_table_cell = $this->model->tables["tables"][$trimTableName];
            }

            $data["row"] = $this->view->table_cell($_GET['tableName'], $access_table_cell);

            $data['log'].=$this->lang_map->table_actions["action"].": ".
                $this->lang_map->table_actions[$_GET["action"]]."<br>".
                "<ul>".$this->lang_map->table_actions["options"].":<li>".
                $this->lang_map->table_actions["tableName"]."--> ".$_GET['tableName']."</li></ul>".
                view_admin_tables::print_date_stamp();
            $this->view->generateJson($data);
        }
        else{
            $this->model->glob_create_tables();
            $this->model->get_tables_from_db();
            $this->model->glob_load_tables();
            $this->view->tables = $this->model->tables["tables"];
            parent::action_index();
        }
    }

    function action_records()
    {

        $view_data = $this->model->query("SHOW TABLES");

        $admin_url_expl = explode("/", $this->admin_process_url);
        $admin_url_cnt = count($admin_url_expl);
        global $request;
        if(isset($request["routes"][$admin_url_cnt+1]) and $request["routes"][$admin_url_cnt+1]!= null){
            $tableName = $request["routes"][$admin_url_cnt+1];
        }elseif ($table_row = $view_data->fetch()){
            $tableName =  $table_row[0];
            //one more query cause fetch
            $view_data = $this->model->query("SHOW TABLES");
        }else{
            jointSite::throwErr("request", "no table in database");
        }

        $this->view->admin_process_url = $this->admin_process_url;
        $this->view->view_data = $view_data;
        $this->view->tableName = $tableName;
        $select_tbl_pannel = $this->view->print_select_tbl_panel();

        $this->records_process($this->admin_process_url."/records/".$tableName, $tableName, $select_tbl_pannel);
    }

    function action_migrations()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/models/admin/model_migrations.php";
        $this->model = new model_migrations();
        if(isset($_POST["glob_migr_files"]) and $_POST["glob_migr_files"] == "glob-migr-files"){
            $this->model->glob_migration_files();
            $this->model = new model_migrations();
        }
        if(isset($_POST["exec_all_migrations"]) and $_POST["exec_all_migrations"] == "exec-new-migrations") {

            $list_where = "where status = 'new'";
            $list_migr = $this->model->listRecords($list_where, "order by migration_name");

            if($list_migr){
                foreach ($list_migr as $migr_num => $migr_data){

                    $this->model->recordStructureFields->record["migration_name"]["curVal"] = $migr_data["migration_name"];
                    if($this->model->copyRecord()){
                        $this->model->exec_migration($migr_data["migration_name"]);
                    }
                }
            }
        }
        if(isset($_POST["exec_migration"]) and $_POST["exec_migration"] == "exec-migration"){
            if($_POST["exec_migr_file"]){
                $this->model->recordStructureFields->record["migration_name"]["curVal"] = $_POST["exec_migr_file"];
                if($this->model->copyRecord()){
                    $this->model->exec_migration($_POST["exec_migr_file"]);
                }else{
                    echo "cant find migration in the migrations table";
                    exit;
                }

            }
        }
        $this->records_process($this->admin_process_url."/migrations");
    }

    function doAction_custom($action_name)
    {
        if($action_name == "log"){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/models/admin/model_migrations_log.php";
            $m_log_controller = new RecordsController("model_migrations_log", get_class($this->view), null);
            $m_log_controller->records_process($this->admin_process_url."/migrations/log");
        }
        return true;
    }
}