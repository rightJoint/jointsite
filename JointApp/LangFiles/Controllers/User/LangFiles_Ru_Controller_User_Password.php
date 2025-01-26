<?php
class LangFiles_Ru_Controller_User_Password extends LangFiles_Ru_Controller_User_Account
{
    public function __construct()
    {
        parent::__construct();

        $this->h2 = 'Сменить пароль';

        $this->fieldAliases = array(
            'password' => 'пароль',
            'password_new' => 'новый пароль',
        );
    }
}