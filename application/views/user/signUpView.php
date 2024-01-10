<?php
class signUpView extends View
{
    public $logo = "/img/popimg/checkInNow.png";
    public $shortcut_icon = "/img/popimg/checkInNow.png";

    public $signUp_err = array(
        "login_unacceptable" => false,
        "login_reserved" => false,
        "pass_unacceptable" => false,
        "pass_dont_match" => false,
        "email_unacceptable" => false,
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
        $this->print_signIn_form("disp-none");
        $this->print_signUp_form(null, $this->signUp_err);
    }
}