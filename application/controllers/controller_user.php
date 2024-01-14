<?php
include "application/core/Records/RecordsController.php";
class Controller_User extends RecordsController
{
    public $user_modules = array(
        "mUrl" => "user",
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

    function __construct()
    {
        $this->lang_map["home_page_access_error"] = array(
            "en" => "auth required in",
            "rus" => "требуется авторизация в",
        );

        if($_GET["cmd"] == "exit"){
            unset($_SESSION["site_user"]);
            header("Location: ".$_SERVER["HTTP_REFERER"]);
        }

        global $routes;

        if (!$_SESSION["site_user"]["user_id"] and !in_array($routes[2], array("signUp", "signIn"))){
            throwErr("access", $this->lang_map["home_page_access_error"][$_SESSION["lang"]]." Controller User construct");
        }


    }

    function action_groups()
    {
        include "application/core/Module/ModuleRecordsModel.php";
        include "application/models/user/model_userGroups.php";
        $this->model = new model_userGroups();
        include "application/views/user/userGroups_view.php";
        $this->view = new userGroups_view();

        $this->view->lang_map["head"]["description"] = $this->view->lang_map["head"]["title"] = $this->view->lang_map["head"]["h1"] =
            $this->user_modules["bindTables"]["groups"]["aliases"];

        $this->view->module = $this->user_modules;

        $this->model->getRecordStructure();

        $this->view->action_log["result"] = true;
        if($_POST){
            foreach ($_SESSION["site_user"]["groups"] as $group => $group_info){
                $this->model->record["user_id"]["curVal"] = $_SESSION["site_user"]["user_id"];
                $this->model->record["group_id"]["curVal"] = $group;
                $this->model->copyRecord();
                if($_POST[$group]){
                    $this->model->record["send_ntf"]["curVal"] = true;
                }else{
                    $this->model->record["send_ntf"]["curVal"] = false;
                }
                if(!$this->model->updateRecord()){
                    $this->view->action_log["result"] = false;
                }
                $this->view->action_log["log"]=$this->model->log_message;
            }
        }
        $sup_cond = null;

        $this->view->listFields = $this->model->listFields;
        $this->view->listRecords = $this->model->listRecords("where usersToGroups_dt.user_id='".$_SESSION["site_user"]["user_id"]."'", $sup_cond["order"], $sup_cond["limit"]);
        $this->view->searchFields = $this->model->searchFields;
        $this->view->generate();
    }

    function action_password()
    {
        include "application/models/user/changePasswordModel.php";
        $this->model = new changePasswordModel();
        include "application/views/user/changePasswordView.php";
        $this->view = new changePasswordView();
        $this->view->lang_map["head"]["description"] = $this->view->lang_map["head"]["title"] = $this->view->lang_map["head"]["h1"] =
            $this->user_modules["bindTables"]["password"]["aliases"];

        $this->model->getRecordStructure();
        $this->model->copyRecord();

        if($_POST){
            $log_date = date("Y-m-d H:i:s");

            $this->model->copyPost();
            if($this->model->checkUserPassword($_POST["password"])){
                if(password_verify($_POST['password'], $this->model->record["pw_hash"]["curVal"])){
                    if($this->model->checkUserPassword($_POST["new_password"])){
                        if($this->model->record["new_password"]["curVal"] == $this->model->record["password_repeat"]["curVal"]){
                            if(!password_verify($this->model->record["new_password"]["curVal"], $this->model->record["pw_hash"]["curVal"])){
                                $this->model->record["pw_hash"]["curVal"] =
                                    password_hash($this->model->record["new_password"]["curVal"], PASSWORD_DEFAULT);

                                $this->model->updateRecord();

                                require_once "application/core/Module/ntSendModel.php";
                                $changePassUserNtf_model = new ntSendModel();
                                $changePassUserNtf_model->AddNtf("changePassForUser", "user",
                                    $_SESSION["site_user"]["user_id"], json_encode(
                                        array(
                                            "user_id" => $_SESSION["site_user"]["user_id"],
                                            "accLogin" => $_SESSION["site_user"]["accLogin"],
                                            "accAlias" => $_SESSION["site_user"]["accAlias"],
                                            "newPassword" => $this->model->record["new_password"]["curVal"],
                                        )
                                    ), true);

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
                                "log" => $this->view->lang_map["site-signUp-form"]["errors"]["pass_dont_match"][$_SESSION["lang"]].
                                    $this->model->record["new_password"]["curVal"]." = ".$this->model->record["repeat_password"]["curVal"].$log_date,
                            );
                        }
                    }else{
                        $this->view->action_log = array(
                            "result" => false,
                            "log" => $this->view->lang_map["site-signUp-form"]["errors"]["pass_unacceptable"][$_SESSION["lang"]].$log_date,
                        );
                    }
                }else{
                    $this->view->action_log = array(
                        "result" => false,
                        "log" => $this->view->lang_map["site-signIn-form"]["errors"]["wrong_login_or_pass"][$_SESSION["lang"]].$log_date,
                    );
                }
            }else{
                $this->view->action_log = array(
                    "result" => false,
                    "log" => $this->view->lang_map["site-signUp-form"]["errors"]["pass_unacceptable"][$_SESSION["lang"]].$log_date,
                );
            }
        }

        $this->view->record = $this->model->record;
        $this->view->editFields = $this->model->editFields;
        $this->view->user_modules = $this->user_modules;
        $this->view->generate();
    }

    function action_email()
    {
        include "application/models/user/changeMailModel.php";
        $this->model = new changeMailModel();
        include "application/views/user/changeEmailView.php";
        $this->view = new changeEmailView();
        $this->view->lang_map["head"]["description"] = $this->view->lang_map["head"]["title"] = $this->view->lang_map["head"]["h1"] =
            $this->user_modules["bindTables"]["email"]["aliases"];
        $this->view->user_modules = $this->user_modules;

        $this->model->getRecordStructure();

        if($this->model->copyRecord()){
            if($_POST){
                $log_res = false;
                $log_message = null;
                $this->model->copyPost();

                if($this->model->record["eMail"]["curVal"] != $this->model->record['eMail']["fetchVal"]){
                    if($this->model->checkUserEmail($this->model->record["eMail"]["curVal"])){
                        $log_res = true;
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
            $this->view->record = $this->model->record;
            $this->view->editFields = $this->model->editFields;
            $this->view->generate();
        }else{
            echo "stab-69x";
            exit;
        }
    }

    function action_notifications()
    {
        global $routes;

        include "application/core/Module/ModuleRecordsModel.php";
        include "application/models/user/userNotificationsRead.php";
        $this->model = new userNotificationsRead();
        $this->model->getRecordStructure();
        $this->model->checkAccessModel();

        if(!$routes[3]){

            include "application/views/user/userNotificationsListView.php";
            $this->view = new userNotificationsListView();

            $this->view->lang_map["head"]["description"] = $this->view->lang_map["head"]["title"] = $this->view->lang_map["head"]["h1"] =
                $this->user_modules["bindTables"]["notifications"]["aliases"];
            $this->view->module = $this->user_modules;
            if($this->model->access_rules["create_rule"] < 7){
                $this->view->hasAccessCreate = false;
            }
            $this->view->process_url = "user/notifications";
            $this->process_list();

        }elseif($routes[3] == "detail"){

            $this->model->copyGetId();
            $this->model->record["user_id"]["curVal"] = $_SESSION["site_user"]["user_id"];

            if($this->model->copyRecord()){

                include "application/views/user/userNotificationDetailView.php";

                $this->view = new userNotificationDetailView();

                $this->view->module = $this->user_modules;

                if(!$this->model->record["read_date"]["curVal"]){


                    $this->model->record["read_date"]["curVal"] = date("Y-m-d H:i:s");
                    $this->model->updateRecord();
                }

                $this->process_detail();
            }else{
                throwErr("request", "copy record fail on detail in controller_user notification");
            }
        }elseif($routes[3] == "delete"){
            $this->model->copyGetId();
            $this->model->record["user_id"]["curVal"] = $_SESSION["site_user"]["user_id"];

            if($this->model->copyRecord()){

                $this->model->record["del_flag"]["curVal"] = true;
                $this->model->updateRecord();

                header("Location: /user/notifications");
            }else{
                throwErr("request", "copy record fail on delete in controller_user notification");
            }
        }else{
            throwErr("notFound", "url not exits in controller_user notification");
        }
    }

    public function action_index()
    {
        include "application/models/user/simpleUserModel.php";
        $this->model = new simpleUserModel();
        $this->model->getRecordStructure();
        $this->model->checkAccessModel();

        include "application/views/user/userHomeView.php";

        $this->view = new userHomeView();

        $this->view->lang_map["head"]["description"] = $this->view->lang_map["head"]["title"] = $this->view->lang_map["head"]["h1"] =
            $this->user_modules["moduleTable"]["aliases"];

        $this->view->user_modules = $this->user_modules;
        $this->model->record["user_id"]["curVal"] = $_SESSION["site_user"]["user_id"];
        if($this->model->copyRecord()){
            if($_POST or $_FILES){
                $this->model->copyPost();
                if($_FILES["photoLink"]){
                    $mvf_result = $this->model->uploadRecordFile("photoLink", false, true);
                }

                $update_result = $this->model->updateRecord();
                $log_res = false;

                if($update_result and $mvf_result){
                    $log_res = true;
                }
                $this->view->action_log = array(
                    "result" => $log_res,
                    "log" => $this->model->log_message,
                );
            }
        }

        $this->view->record = $this->model->record;
        $this->view->editFields = $this->model->editFields;
        $this->view->generate();
    }


    public function action_signUp()
    {
        include "application/models/user/model_auth.php";
        $this->model = new Model_Auth();
        include "application/views/user/signUpView.php";

        $this->view = new signUpView();

        if($_POST["auth_signUp"] == $this->view->lang_map["site-signUp-form"]["submit_btn"][$_SESSION["lang"]]){
            $occur_err = false;
            if(!$this->model->checkUserLogin($_POST["login"])){
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
                $this->model->create_site_user($_POST["login"], $_POST["password"], $_POST["email"]);
            }

        }

        $this->view->active_modal_menu = true;

        $this->view->generate();
    }

    public function action_signIn()
    {
        include "application/models/user/model_auth.php";
        $this->model = new Model_Auth();
        include "application/views/user/signInView.php";

        $this->view = new signInView();

        if($_POST["auth_signIn"] == $this->view->lang_map["site-signIn-form"]["submit_btn"][$_SESSION["lang"]]){
            if($this->model->checkUserLogin($_POST["login"]) and $this->model->checkUserPassword($_POST["password"])){
                $this->model->login = $_POST["login"];
                $this->view->signIn_err = array($this->model->auth_site_user($_POST["password"]) =>  true);
            }else{
                $this->view->signIn_err=array(
                    "wrong_login_or_pass" => true,
                );
            }

            $this->view->active_modal_menu = true;

        }
        $this->view->generate();
    }

    public function action_validate()
    {
        $this->model = new Model();
        if($_GET["code"]){
            $find_qry = "select vldCode, accLogin, accAlias, validDate from users_dt where vldCode='".$_GET["code"]."'";
            $find_res = $this->model->query($find_qry);
            if($find_res->rowCount() == 1){
                //$find_row = $find_res->fetch(PDO::FETCH_ASSOC);
                //echo "<pre>";
                //print_r($find_row);
            }else{
                echo "xxx=".$find_res->rowCount();
            }
        }
    }
}
