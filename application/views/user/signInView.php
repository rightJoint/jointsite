<?php

class signInView extends View
{
    public $logo = "/img/popimg/user-logo.png";
    public $shortcut_icon = "/img/popimg/checkInNow.png";

    public $robot_no_index = true;
    public $metrik_block = false;

    public $signIn_err = array(
        "wrong_login_or_pass" => false,
    );

    public function __construct()
    {
        parent::__construct();

        $this->lang_map["head"]["description"] = array(
            "en" => "Get on site",
            "rus" => "Войти (зарегистрироваться на сайте)",
        );

        $this->lang_map["head"]["title"] = array(
            "en" => "Sign in",
            "rus" => "Вход на сайт",
        );

        $this->lang_map["head"]["h1"] = array(
            "en" => "Sign in now",
            "rus" => "Вход на сайт",
        );
    }

    function print_auth_forms()
    {
        $this->print_signIn_form(null, $this->signIn_err);
        $this->print_signUp_form("disp-none");
    }
}