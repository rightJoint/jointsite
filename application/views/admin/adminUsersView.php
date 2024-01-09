<?php
class adminUsersView extends AdminView
{
    public $adminUsers = null;

    function __construct()
    {
        $this->lang_map["admin-users"] = array(
            "add_usr_h2" => array(
                "en" => "Add admin user",
                "rus" => "Добавить пользователя в админку",
            ),
            "add_usr_newUsrName" => array(
                "en" => "newUsrName",
                "rus" => "Добавить логин",
            ),
            "add_usr_newUsrPass" => array(
                "en" => "newUsrPass",
                "rus" => "Пароль",
            ),
            "add_usr_btn" => array(
                "en" => "addNewUsr",
                "rus" => "Добавить",
            ),
            "list_h2" => array(
                "en" => "Users list",
                "rus" => "Список пользователей",
            ),
            "list_usersName" => array(
                "en" => "usersName",
                "rus" => "Логин пользователя",
            ),
            "list_delUser" => array(
                "en" => "delUser",
                "rus" => "Удалить",
            ),

        );

        $this->styles[] = "/css/admin/form-option.css";
        $this->styles[] = "/css/admin/users.css";
        $this->styles[] = "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css";

        $this->scripts[] = "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js";
        $this->scripts[] = "/js/admin/users.js";

        parent::__construct();
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame admin'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
            "<div class='add-user'>".
            "<h2>".$this->lang_map["admin-users"]["add_usr_h2"][$_SESSION["lang"]]."</h2>".
            "<form class='form-option'>".
            "<div class='form-option-line'>".
            "<label for='newUsrName'>".$this->lang_map["admin-users"]["add_usr_newUsrName"][$_SESSION["lang"]].": </label>".
            "<input type='text' id='newUsrName' name='newUsrName'>".
            "</div>".
            "<div class='form-option-line'><label for='newUsrPass'>".$this->lang_map["admin-users"]["add_usr_newUsrPass"][$_SESSION["lang"]].": </label>".
            "<input type='password' id='newUsrPass' name='newUsrPass'>".
            "</div>".
            "<div class='form-option-cntrl'>".
            "<input type='button' value='".$this->lang_map["admin-users"]["add_usr_btn"][$_SESSION["lang"]]."' onclick='addNewUser()'></div>".
            "<div class='result-info'></div>".
            "</div>".
            "</form>".
            "</div>".
            "<div class='usersList'>";

        $this->print_users_list();

        echo "</div></div></div>";
    }

    function print_users_list()
    {
        echo "<h2>".$this->lang_map["admin-users"]["list_h2"][$_SESSION["lang"]]."</h2>".
            "<div class='usersList-line caption'>".
            "<div class='usersList-line-name'>".$this->lang_map["admin-users"]["list_usersName"][$_SESSION["lang"]]."</div>".
            "<div class='usersList-line-del'>".$this->lang_map["admin-users"]["list_delUser"][$_SESSION["lang"]]."</div>".
            "</div>";
        if(is_array($this->adminUsers["list"])){
            foreach ($this->adminUsers["list"] as $usr=>$pw){
                echo "<div class='usersList-line'>".
                    "<div class='usersList-line-name'>".$usr."</div>".
                    "<div class='usersList-line-del'>".
                    "<img src='/img/popimg/drop-icon.png' onclick='dropAdminUsr(".'"'.$usr.'"'.")'>".
                    "</div>".
                    "</div>";
            }
        }
    }
}