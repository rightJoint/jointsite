<?php

class LangFiles_En_Controller_Components_Users extends LangFiles_En_Controller_Records
{
    public string $moduleAlias = 'Users';

    public function __construct()
    {
        $this->fieldAliases = array(
            'user_id' => 'user id',
            'accLogin' => 'login',
            'accAlias' => 'alias',
            'pw_hash' => 'hash',
            'vldCode' => 'vld code',
            'regDate' => 'reg dt',
            'netWork' => 'network',
            'validDate' => 'valid dt',
            'photoLink' => 'avatar',
            'eMail' => 'eMail',
            'birthDay' => 'birthday',
            'socProf' => 'home ref',
            'blackList' => 'black list',
            'created_by' => 'created by',
            'is_admin' => 'admin',
            'send_ntf' => 'notifications',
            'pref_lang' => 'lang',
        );

    }


}