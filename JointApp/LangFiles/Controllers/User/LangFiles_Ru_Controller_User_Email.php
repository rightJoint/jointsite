<?php
class LangFiles_Ru_Controller_User_Email extends LangFiles_Ru_Controller_User_Account
{
    public function __construct()
    {
        parent::__construct();

        $this->h2 = 'Сменить email';
    }
}