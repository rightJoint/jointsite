<?php
class LangFiles_Ru_Controller_User_Notifications extends LangFiles_Ru_Controller_User_Account
{
    public function __construct()
    {
        parent::__construct();

        $this->h2 = 'Пользователь - уведомления';

        $this->fieldAliases = array(
            'tHeader' => 'Заголовок',
            'subscriber_type' => 'Тип подп.',
            'read_date' => 'Дт. чтение',
            'put_date' => 'Дт. созд.',
            'send_flag' => 'Отправка',
        );

        $this->h2_read = 'Чтение уведомлений';
    }
}