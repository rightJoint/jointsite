<?php
class LangFiles_En_Controller_User_Notifications extends LangFiles_En_Controller_User_Account
{
    public string $h2 = 'User - notifications';
    public function __construct()
    {
        parent::__construct();

        $this->fieldAliases = array(
            'tHeader' => 'tHeader',
            'subscriber_type' => 'subscriber_type',
            'read_date' => 'read_date',
            'put_date' => 'put_date',
            'send_flag' => 'send_flag',
        );
    }
}