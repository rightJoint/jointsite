<?php
class view_admin_users extends view_admin
{
    public $adminUsers = null;

    function __construct()
    {
        parent::__construct();

        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/admin/form-option.css";
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/admin/users.css";
        $this->styles[] = JOINT_SITE_EXEC_DIR."/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css";

        $this->scripts[] = JOINT_SITE_EXEC_DIR."/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js";
        $this->scripts[] = JOINT_SITE_EXEC_DIR."/js/admin/users.js";
    }

    function LoadViewLang_custom()
    {
        parent::LoadViewLang_custom();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/views/lang_view_admin_users_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_admin_users_".$_SESSION[JS_SAIK]["lang"];
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame admin'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
            "<div class='add-user'>".
            "<h2>".$this->lang_map->admin_users["add_usr_h2"]."</h2>".
            "<form class='form-option'>".
            "<div class='form-option-line'>".
            "<label for='newUsrName'>".$this->lang_map->admin_users["add_usr_newUsrName"].": </label>".
            "<input type='text' id='newUsrName' name='newUsrName'>".
            "</div>".
            "<div class='form-option-line'><label for='newUsrPass'>".$this->lang_map->admin_users["add_usr_newUsrPass"].": </label>".
            "<input type='password' id='newUsrPass' name='newUsrPass'>".
            "</div>".
            "<div class='form-option-cntrl'>".
            "<input type='button' value='".$this->lang_map->admin_users["add_usr_btn"]."' onclick='addNewUser()'></div>".
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
        echo "<h2>".$this->lang_map->admin_users["list_h2"]."</h2>".
            "<div class='usersList-line caption'>".
            "<div class='usersList-line-name'>".$this->lang_map->admin_users["list_usersName"]."</div>".
            "<div class='usersList-line-del'>".$this->lang_map->admin_users["list_delUser"]."</div>".
            "</div>";
        if(is_array($this->adminUsers)){
            foreach ($this->adminUsers as $usr=>$pw){
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