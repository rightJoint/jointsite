<?php

class LangFiles_Ru_Controller_Components_Users extends LangFiles_Ru_Controller_Records
{
    public function __construct()
    {
        $this->moduleAlias = 'Пользователи';
        $this->fieldAliases = array(
            'user_id' => 'ид',
            'accLogin' => 'логин',
            'accAlias' => 'Алиас',
            'pw_hash' => 'Хэш',
            'vldCode' => 'код подтв.',
            'regDate' => 'дт.рег',
            'netWork' => 'сц.сеть',
            'validDate' => 'дт. валид.',
            'photoLink' => 'аватар',
            'eMail' => 'почта',
            'birthDay' => 'д.р.',
            'socProf' => 'проф.ссылка',
            'blackList' => 'ч.сп',
            'created_by' => 'создал',
            'is_admin' => 'админ',
            'send_ntf' => 'уведомл',
            'pref_lang' => 'язык',
        );
    }
}