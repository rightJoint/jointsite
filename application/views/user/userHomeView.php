<?php
class userHomeView extends ModuleEditView
{

    public $logo = JOINT_SITE_EXEC_DIR."/img/popimg/user-logo.png";
    public $shortcut_icon = JOINT_SITE_EXEC_DIR."/img/popimg/user-logo.png";

    public $robot_no_index = true;
    public $metrik_block = false;

    public $user_modules = null;

    public function __construct()
    {
        parent::__construct();

        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/module.css";

        $this->h2 = $this->lang_map->h2_users;
    }

    function LoadViewLang_custom()
    {
        parent::LoadViewLang_custom();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/views/user/lang_view_user_home_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_user_home_".$_SESSION[JS_SAIK]["lang"];
    }
}