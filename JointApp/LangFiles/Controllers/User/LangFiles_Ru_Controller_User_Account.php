<?php
class LangFiles_Ru_Controller_User_Account extends LangFiles_Ru_Controller_Records
{
    public function __construct()
    {
        $this->userSubMenuItems = array(
            '' => array(
                'usage' => 1,
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