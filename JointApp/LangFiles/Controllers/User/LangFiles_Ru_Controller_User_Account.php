<?php
class LangFiles_Ru_Controller_User_Account extends LangFiles_Ru_Controller_Records
{
    public function __construct()
    {
        $this->userSubMenuItems = array(
            'main' => array(
                'usage' => 0,
                'refTitle' => 'Основная информация',
                'refText' => 'Основное',
            ),
            'notifications' => array(
                'usage' => 1,
                'refTitle' => 'Чтение уведомлений',
                'refText' => 'Уведомления',
            ),
            'changeEmail' => array(
                'usage' => 1,
                'refTitle' => 'сменить email',
                'refText' => 'Email',
            ),
            'changePassword' => array(
                'usage' => 1,
                'refTitle' => 'сменить password',
                'refText' => 'Пароль',
            ),
            'userGroups' => array(
                'usage' => 1,
                'refTitle' => 'настройки групп',
                'refText' => 'Группы',
            ),
        );
    }
}