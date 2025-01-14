<?php
class LangFiles_En_Controller_User_Account extends LangFiles_En_Controller_Records
{
    public function __construct()
    {
        $this->userSubMenuItems = array(
            'main' => array(
                'usage' => 0,
                'refTitle' => 'user main',
                'refText' => 'main info',
            ),
            'notifications' => array(
                'usage' => 1,
                'refTitle' => 'read notifications',
                'refText' => 'notifications',
            ),
            'changeEmail' => array(
                'usage' => 1,
                'refTitle' => 'change email',
                'refText' => 'email',
            ),
            'changePassword' => array(
                'usage' => 1,
                'refTitle' => 'change password',
                'refText' => 'password',
            ),
            'userGroups' => array(
                'usage' => 1,
                'refTitle' => 'groups settings',
                'refText' => 'groups',
            ),
        );
    }
}