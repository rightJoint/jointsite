<?php

class view_signIn extends SiteView
{
    public $logo = JOINT_SITE_EXEC_DIR."/img/popimg/user-logo.png";
    public $shortcut_icon = JOINT_SITE_EXEC_DIR."/img/popimg/checkInNow.png";

    public $robot_no_index = true;
    public $metrik_block = false;

    public $signIn_err = array(
        "wrong_login_or_pass" => false,
    );

    function load_lang_files()
    {
        parent::load_lang_files(); // TODO: Change the autogenerated stub
        require_once "application/lang_files/views/user/lang_view_signIn_".$_SESSION["lang"].".php";
        return "lang_view_signIn_".$_SESSION["lang"];
    }

    function print_auth_forms()
    {
        $this->print_signIn_form(null, $this->signIn_err);
        $this->print_signUp_form("disp-none");
    }
}