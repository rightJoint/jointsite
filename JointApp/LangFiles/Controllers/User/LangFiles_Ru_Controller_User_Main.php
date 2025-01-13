<?php
class LangFiles_Ru_Controller_User_Main extends LangFiles_Ru_Controller_User_Account
{
    public function __construct()
    {
        parent::__construct();

        $this->h2 = 'Пользователь - основное';

        $this->fieldAliases = array(
            'user_id' => 'ид',
            'accLogin' => 'Логин',
            'accAlias' => 'Псевдоним',
            'regDate' => 'Рег.дт.',
            'netWork' => 'Способ рег.',
            'validDate' => 'Подтв.акк.',
            'photoLink' => 'Аватар',
            'eMail' => 'email',
            'birthDay' => 'Д.р.',
            'socProf' => 'Аккант инфо',
            'blackList' => 'Ч.сп.',
            'created_by' => 'Создал',
            'is_admin' => 'Админ',
            'send_ntf' => 'Отправлять на почту',
            'pref_lang' => 'Язык',
        );
    }
}