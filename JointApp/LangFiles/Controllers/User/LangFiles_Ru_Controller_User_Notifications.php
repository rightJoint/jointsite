<?php
class LangFiles_Ru_Controller_User_Notifications extends LangFiles_Ru_Controller_User_Account
{
    public string $h2 = 'Чтение уведомлений';
    public string $h2_read = 'Просмотр уведомления';
    public function __construct()
    {
        parent::__construct();

        $this->fieldAliases = array(
            'tHeader' => 'Заголовок',
            'subscriber_type' => 'Тип подп.',
            'read_date' => 'Дт. чтение',
            'put_date' => 'Дт. созд.',
            'send_flag' => 'Отправка',
        );

    }
}