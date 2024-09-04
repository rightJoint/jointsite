<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/core/RecordsController.php";
class Controller_User extends RecordsController
{
    public $user_modules = array(
        "moduleTable" => array(
            "tableName" => "",
            "aliases" => array(
                "en" => "Main about user",
                "rus" => "Основное о пользователе"
            ),
        ),
        "bindTables" => array(
            "groups" => array(
                "aliases" => array(
                    "en" => "users groups",
                    "rus" => "Группы пользователя",
                ),
            ),
            "password" => array(
                "aliases" => array(
                    "en" => "Change password",
                    "rus" => "Сменить пароль",
                ),
            ),
            "email" => array(
                "aliases" => array(
                    "en" => "Change email",
                    "rus" => "Сменить email",
                ),
            ),
            "notifications" => array(
                "aliases" => array(
                    "en" => "notification",
                    "rus" => "Уведомления",
                ),
            ),
        )
    );

    function __construct($loaded_model, $loaded_view, $action_name)
    {
        if(isset($_GET["cmd"]) and $_GET["cmd"] == "exit"){
            unset($_SESSION[JS_SAIK]["site_user"]);
            header("Location: ".$_SERVER["HTTP_REFERER"]);
        }

        parent::__construct($loaded_model, $loaded_view, $action_name);

        if (!isset($_SESSION[JS_SAIK]["site_user"]["user_id"]) and $action_name!="signUp"){
            $this->action_signIn();
        }
    }

    function LoadCntrlLang_custom()
    {
        parent::LoadCntrlLang_custom();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/controllers/lang_cntrl_user_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_cntrl_user_".$_SESSION[JS_SAIK]["lang"];
    }

    function LoadModel_custom($action_name = null)
    {
        if($action_name == "signUp"){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/models/user/model_signin.php";
            return "model_signin";
        }elseif ($action_name == "index" and isset($_SESSION[JS_SAIK]["site_user"]["user_id"])){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/core/ModuleModel.php";
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/models/user/simpleUserModel.php";
            return "simpleUserModel";
        }elseif ($action_name == "groups"){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/core/ModuleModel.php";
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/models/user/model_userGroups.php";
            return "model_userGroups";
        }elseif ($action_name == "notifications"){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/core/ModuleModel.php";
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/models/user/userNotificationsRead.php";
            return "userNotificationsRead";
        }
    }

    function LoadView_custom($action_name = null)
    {
        global $request;

        if ($action_name == "index" and isset($_SESSION[JS_SAIK]["site_user"]["user_id"])){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/templates/RecordView.php";
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/templates/RecordEditView.php";
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/templates/ModuleEditView.php";
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/user/userHomeView.php";
            return "userHomeView";
        }elseif ($action_name == "notifications"){
            if(isset($request["routes"][$request["exec_dir_cnt"]+2]) and $request["routes"][$request["exec_dir_cnt"]+2] == "detailview"){
                require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                    "/application/views/templates/RecordDetailView.php";
                require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                    "/application/views/templates/ModuleDetailView.php";
                require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                    "/application/views/user/userNotificationDetailView.php";
                return "userNotificationDetailView";
            }
        }
    }

    function action_notifications()
    {
        global $request;

        if(!isset($request["routes"][$request["exec_dir_cnt"] + 2])){
            $this->view->lang_map->head["description"] = $this->view->lang_map->head["title"] = $this->view->lang_map->head["h1"] =
                $this->user_modules["bindTables"]["notifications"]["aliases"][$_SESSION[JS_SAIK]["lang"]];
            $this->view->module_info = $this->user_modules;
            $this->view->m_process_url = $this->m_process_url = JOINT_SITE_EXEC_DIR."/user";
            if($this->model->access_rules["create_rule"] < 7){
                $this->view->hasAccessCreate = false;
            }
            $this->view->module_config = $this->user_modules;
            $this->view->m_process_url = JOINT_SITE_EXEC_DIR."/user";
            $this->view->process_url = JOINT_SITE_EXEC_DIR."/user/notifications";
            $this->process_list();
        }elseif($request["routes"][$request["exec_dir_cnt"] + 2] == "detailview"){

            $this->model->copyValFromRequest($_GET);

            if($this->model->copyRecord()){

                $this->view->module = $this->user_modules;

                if(!$this->model->recordStructureFields->record["read_date"]["curVal"]){
                    $this->model->recordStructureFields->record["read_date"]["curVal"] = date("Y-m-d H:i:s");
                    $this->model->updateRecord();
                }

                $this->process_detail(JOINT_SITE_EXEC_DIR."/user/notifications");
            }else{
                jointSite::throwErr("request", "copy record fail on detail in controller_user notification");
            }
        }elseif($request["routes"][$request["exec_dir_cnt"] + 2] == "deleteview"){
            $this->model->copyValFromRequest($_GET);

            if($this->model->copyRecord()){

                $this->model->recordStructureFields->record["del_flag"]["curVal"] = true;
                $this->model->updateRecord();

                header("Location: ".JOINT_SITE_EXEC_DIR."/user/notifications");
            }else{
                jointSite::throwErr("request", "copy record fail on delete in controller_user notification");
            }
        }else{
            jointSite::throwErr("notFound", "url not exits in controller_user notification");
        }
    }

    function action_email()
    {
        $this->view->lang_map->head["description"] = $this->view->lang_map->head["title"] = $this->view->lang_map->head["h1"] =
            $this->user_modules["bindTables"]["email"]["aliases"];
        $this->view->user_modules = $this->user_modules;
        $this->model->recordStructureFields->record["user_id"]["curVal"] = $_SESSION[JS_SAIK]["site_user"]["user_id"];
        if($this->model->copyRecord()){
            if($_POST){
                $log_res = false;
                $this->model->copyValFromRequest($_POST);

                if($this->model->recordStructureFields->record["eMail"]["curVal"] != $this->model->recordStructureFields->record['eMail']["fetchVal"]){
                    if($this->model->checkUserEmail($this->model->recordStructureFields->record["eMail"]["curVal"])){

                        $log_res = $this->model->updateRecord();
                        $log_message = "email ok";
                    }else{
                        $log_message = "wrong email";
                    }
                }else{
                    $log_res = true;
                    $log_message = "nothing update";
                }

                $this->view->action_log = array(
                    "result" => $log_res,
                    "log" => $log_message,
                );
            }
            $this->view->module_config = $this->user_modules;
            $this->view->m_process_url = JOINT_SITE_EXEC_DIR."/user";
            $this->view->record = $this->model->recordStructureFields->record;
            $this->view->editFields = $this->model->recordStructureFields->editFields;
            $this->view->generate();
        }else{
            echo "stab-69x";
            exit;
        }
    }

    function action_password()
    {
        $this->view->lang_map->head["description"] = $this->view->lang_map->head["title"] = $this->view->lang_map->head["h1"] =
            $this->user_modules["bindTables"]["password"]["aliases"][$_SESSION[JS_SAIK]["lang"]];

        $this->model->recordStructureFields->record["user_id"]["curVal"] = $_SESSION[JS_SAIK]["site_user"]["user_id"];
        $this->model->copyRecord();

        if($_POST){
            $log_date = date("Y-m-d H:i:s");

            $this->model->copyValFromRequest($_POST);


            if($this->model->checkUserPassword($_POST["password"])){
                if(password_verify($_POST['password'], $this->model->recordStructureFields->record["pw_hash"]["curVal"])){
                    if($this->model->checkUserPassword($_POST["new_password"])){
                        if($this->model->recordStructureFields->record["new_password"]["curVal"] ==
                            $this->model->recordStructureFields->record["password_repeat"]["curVal"]){
                            if(!password_verify($this->model->recordStructureFields->record["new_password"]["curVal"],
                                $this->model->recordStructureFields->record["pw_hash"]["curVal"])){
                                $this->model->recordStructureFields->record["pw_hash"]["curVal"] =
                                    password_hash($this->model->recordStructureFields->record["new_password"]["curVal"], PASSWORD_DEFAULT);

                                $this->model->updateRecord();
                                require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                                    "/application/core/ntSendModel.php";

                                $changePassUserNtf_model = new ntSendModel();
                                $changePassUserNtf_model->AddNtf("changePassForUser", "user",
                                    $_SESSION[JS_SAIK]["site_user"]["user_id"], json_encode(
                                        array(
                                            "user_id" => $_SESSION[JS_SAIK]["site_user"]["user_id"],
                                            "accLogin" => $_SESSION[JS_SAIK]["site_user"]["accLogin"],
                                            "accAlias" => $_SESSION[JS_SAIK]["site_user"]["accAlias"],
                                            "newPassword" => $this->model->recordStructureFields->record["new_password"]["curVal"],
                                        )
                                    ), true, "default");

                                $this->view->action_log = array(
                                    "result" => true,
                                    "log" => "change_pass_success".$log_date,
                                );
                            }else{
                                $this->view->action_log = array(
                                    "result" => false,
                                    "log" => "use the same pass".$log_date,
                                );
                            }
                        }else{
                            $this->view->action_log = array(
                                "result" => false,
                                "log" => $this->view->lang_map->sitesignUpform["errors"]["pass_dont_match"].$log_date,
                            );
                        }
                    }else{
                        $this->view->action_log = array(
                            "result" => false,
                            "log" => $this->view->lang_map->sitesignUpform["errors"]["pass_unacceptable"].$log_date,
                        );
                    }
                }else{
                    $this->view->action_log = array(
                        "result" => false,
                        "log" => $this->lang_map->signIn_err["wrong_login_or_pass"].$log_date,
                    );
                }
            }else{
                $this->view->action_log = array(
                    "result" => false,
                    "log" => $this->view->lang_map->sitesignUpform["errors"]["pass_unacceptable"].$log_date,
                );
            }
        }

        $this->view->record = $this->model->recordStructureFields->record;
        $this->view->editFields = $this->model->recordStructureFields->editFields;
        $this->view->module_config = $this->user_modules;
        $this->view->m_process_url = $this->m_process_url = JOINT_SITE_EXEC_DIR."/user";
        $this->view->generate();
    }

    function action_groups()
    {
        $this->view->lang_map->head["description"] = $this->view->lang_map->head["title"] = $this->view->lang_map->head["h1"] =
            $this->user_modules["bindTables"]["groups"]["aliases"][$_SESSION[JS_SAIK]["lang"]];

        $this->view->module_info = $this->user_modules;
        $this->view->m_process_url = $this->m_process_url = JOINT_SITE_EXEC_DIR."/user";

        $this->view->action_log["result"] = true;
        if($_POST){
            foreach ($_SESSION[JS_SAIK]["site_user"]["groups"] as $group => $group_info){
                $this->model->recordStructureFields->record["user_id"]["curVal"] = $_SESSION[JS_SAIK]["site_user"]["user_id"];
                $this->model->recordStructureFields->record["group_id"]["curVal"] = $group;
                $this->model->copyRecord();
                if(isset($_POST[$group])){
                    $this->model->recordStructureFields->record["send_ntf"]["curVal"] = true;
                }else{
                    $this->model->recordStructureFields->record["send_ntf"]["curVal"] = false;
                }
                if(!$this->model->updateRecord()){
                    $this->view->action_log["result"] = false;
                }
                $this->view->action_log["log"]=$this->model->log_message;
            }
        }

        $this->view->listFields = $this->model->recordStructureFields->listFields;
        $this->view->listRecords = $this->model->listRecords("where usersToGroups_dt.user_id='".$_SESSION[JS_SAIK]["site_user"]["user_id"]."'",
            null, null);
        $this->view->generate();
    }

    public function action_index()
    {
        $this->view->lang_map->head["description"] = $this->view->lang_map->head["title"] = $this->view->lang_map->head["h1"] =
            $this->user_modules["moduleTable"]["aliases"][$_SESSION[JS_SAIK]["lang"]];

        $this->view->module_info = $this->user_modules;
        $this->view->m_process_url = $this->m_process_url = JOINT_SITE_EXEC_DIR."/user";
        $this->model->recordStructureFields->record["user_id"]["curVal"] = $_SESSION[JS_SAIK]["site_user"]["user_id"];
        if($this->model->copyRecord()){
            $this->view->active_modal_menu = false;
            if($_POST or $_FILES){
                $this->model->copyValFromRequest($_POST);
                $this->view->action_log = array(
                    "result" => $this->model->updateRecord(),
                    "log" => $this->model->log_message,
                );
            }
        }

        $this->view->record = $this->model->recordStructureFields->record;
        $this->view->editFields = $this->model->recordStructureFields->editFields;
        $this->view->module_config = $this->user_modules;
        $this->view->m_process_url = JOINT_SITE_EXEC_DIR."/user";

        $this->view->generate();
    }

    public function action_validate()
    {
        if($_GET["code"]){
            $find_qry = "select vldCode, accLogin, accAlias, validDate from users_dt where vldCode='".$_GET["code"]."'";
            $find_res = $this->model->query($find_qry);
            if($find_res->rowCount() == 1){
                $find_row = $find_res->fetch(PDO::FETCH_ASSOC);

                $view_data = $find_row;

                if($find_row["validDate"]){
                    $view_data["status"] = false;
                }else{
                    $update_qry = "update users_dt set validDate = '".date("Y-m-d H:i:s")."' where vldCode='".$_GET["code"]."'";
                    $this->model->query($update_qry);
                    $view_data["status"] = true;
                }

                $this->view->view_data = $view_data;
                $this->view->generate();
            }else{
                jointSite::throwErr("request", "validate code doesnt not much any record");
            }
        }else{
            jointSite::throwErr("request", "null validate code");
        }
    }

    public function action_signIn()
    {
        $singIn_err = $this->lang_map->home_page_access_error." on action signIn";

        if (isset($_POST["auth_signIn"]) and $_POST["auth_signIn"] == $this->view->lang_map->sitesignInform["submit_btn"]){
            $this->model->recordStructureFields->record["accLogin"]["curVal"] = $_POST["login"];

            if($this->model->checkUserLogin() and $this->model->checkUserPassword($_POST["password"])){


                if($this->model->copy_by_login_or_email()){
                    $this->model->auth_site_user();
                    if($this->lang_map->signIn_err[$this->model->log_message]){
                        $singIn_err = $this->lang_map->signIn_err[$this->model->log_message];
                    }else{
                        $singIn_err = $this->model->log_message;
                    }
                }else{
                    $singIn_err = $this->lang_map->signIn_err["wrong_login_or_pass"];
                }
            }else{
                $singIn_err = $this->lang_map->signIn_err["wrong_login_or_pass"];
            }
        }

        if(isset($_SESSION[JS_SAIK]["site_user"]["user_id"])){
            $this->view->generate();
        }else{

            jointSite::throwErr("access", $singIn_err);
        }
    }

    public function action_signUp()
    {
        $signUp_message = $this->lang_map->signUn_message["use_menu"];
        $this->view->active_modal_menu = true;
        $this->view->signUp_err = array(
            "login_unacceptable" => false,
            "login_reserved" => false,
            "pass_unacceptable" => false,
            "pass_dont_match" => false,
            "email_unacceptable" => false,
        );

        if(isset($_POST["auth_signUp"]) and $_POST["auth_signUp"] == $this->view->lang_map->sitesignUpform["submit_btn"]){
            $occur_err = false;
            if(!$this->model->checkUserLogin()){
                $this->view->signUp_err["login_unacceptable"] = true;
                $occur_err = true;
            }else{
                if(!$this->model->checkDoubleLogin($_POST["login"])){
                    $this->view->signUp_err["login_reserved"] = true;
                    $occur_err = true;
                }
            }

            if(!$this->model->checkUserPassword($_POST["password"])){
                $this->view->signUp_err["pass_unacceptable"] = true;
                $occur_err = true;
            }

            if($_POST["password"] != $_POST["repeat_password"]){
                $this->view->signUp_err["pass_dont_match"] = true;
                $occur_err = true;
            }

            if(!$this->model->checkUserEmail($_POST["email"])){
                $this->view->signUp_err["email_unacceptable"] = true;
                $occur_err = true;
            }

            if(!$occur_err){
                $signUp_message = $this->lang_map->signUn_message["complete"];

                $this->model->create_site_user($_POST["login"], $_POST["password"], $_POST["email"]);

                require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                    "/application/core/ntSendModel.php";
                $UserNtf_model = new ntSendModel();

                $UserNtf_model->AddNtf("welcomeFromSiteForUser", "user",
                    $this->model->recordStructureFields->record["user_id"]["curVal"], json_encode(
                        array(
                            "accLogin" => $this->model->recordStructureFields->record["accLogin"]["curVal"],
                            "accAlias" => $this->model->recordStructureFields->record["accAlias"]["curVal"],
                            "accPass" => $_POST["password"],
                            "validCode" => $this->model->recordStructureFields->record["vldCode"]["curVal"],
                            "baseUrl" => JOINT_SITE_EXEC_DIR,
                            "userEmail" => $this->model->recordStructureFields->record["eMail"]["curVal"],
                        )
                    ), true, "default");
                $UserNtf_model->AddNtf("newUserOnSite-site", "group",
                    "67A5CC8E-5EBF-46FD-9A37-4BE80DA17681", json_encode(
                        array(
                            "accLogin" => $this->model->recordStructureFields->record["accLogin"]["curVal"],
                            "accAlias" => $this->model->recordStructureFields->record["accAlias"]["curVal"],
                        )
                    ), true, "default");


                $this->view->active_modal_menu = false;
            }else{
                $signUp_message = $this->lang_map->signUn_message["error"];
            }

        }
        $this->view->signUp_message = $signUp_message;


        $this->view->generate();
    }
}
