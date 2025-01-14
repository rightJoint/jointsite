<?php
class LangFiles_En_Controller_User_Main extends LangFiles_En_Controller_User_Account
{
    public string $h2 = 'User - main info';
    public function __construct()
    {
        parent::__construct();
        $this->fieldAliases = array(
            'user_id' => 'user_id',
            'accLogin' => 'accLogin',
            'accAlias' => 'accAlias',
            'regDate' => 'regDate',
            'netWork' => 'netWork',
            'validDate' => 'validDate',
            'photoLink' => 'photoLink',
            'eMail' => 'eMail',
            'birthDay' => 'birthDay',
            'socProf' => 'socProf',
            'blackList' => 'blackList',
            'created_by' => 'created_by',
            'is_admin' => 'is_admin',
            'send_ntf' => 'send_ntf',
            'pref_lang' => 'pref_lang',
        );
    }
}