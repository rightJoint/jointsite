<?php
class lang_cntrl_user_en extends lang_RecordsController_en
{
    public $home_page_access_error = "auth required in";
    public $signIn_err = array(
        "wrong_login_or_pass" => "wrong login or password",
        "user_in_black_list" => "user in black list",
        "email_not_validated" => "email not validated",
    );
    public $signUn_message = array(
        "use_menu" => "use menu to register account on site",
        "complete" => "To complete registration, please, validate your email following link in letter ".
            "sent from this site",
        "error" => "some error through registration process",
    );
}