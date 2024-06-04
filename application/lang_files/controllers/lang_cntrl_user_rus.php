<?php
class lang_cntrl_user_rus extends lang_RecordsController_rus
{
    public $home_page_access_error = "требуется авторизация в";
    public $signIn_err = array(
        "wrong_login_or_pass" => "неправильный логин или пароль",
        "user_in_black_list" => "Пользователь заблокирован",
        "email_not_validated" => "email не подтвержден",
    );
    public $signUn_message = array(
        "use_menu" => "используйте меню для регистрации аккаунта на сайте",
        "complete" => "Для завершения регистрации, пож, подтвердите ваш email переходом по ссылке в письме ".
            "отправленным с этого сайта",
        "error" => "Какие то ошибки в процессе регистрации",
    );
}