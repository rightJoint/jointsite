<?php

class signInView extends View
{
    public $logo = "/img/popimg/user-logo.png";
    public $shortcut_icon = "/img/popimg/checkInNow.png";

    public $signIn_err = array(
        "wrong_login_or_pass" => false,
    );

    public function __construct()
    {
        parent::__construct();

        $this->lang_map["head"]["description"] = array(
            "en" => "Register new user on site",
            "rus" => "Регистрация на сайте",
        );

        $this->lang_map["head"]["title"] = array(
            "en" => "Register",
            "rus" => "Регистрация",
        );

        $this->lang_map["head"]["h1"] = array(
            "en" => "Register now",
            "rus" => "Регистрация",
        );
    }

    function print_auth_forms()
    {
        $this->print_signIn_form(null, $this->signIn_err);
        $this->print_signUp_form("disp-none");
    }
}