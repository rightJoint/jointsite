<?php
class LangFiles_Ru_Controller_Applications extends LangFiles_Ru_Controller_Records
{
    public function __construct()
    {
        $mkAppErr = new stdClass();
        $mkAppErr->err_f = 'ошибка';
        $mkAppErr->err_1 = 'недопустимое имя пользователя';
        $mkAppErr->err_2 = 'недопустимый email';
        $mkAppErr->err_3 = 'слишком мало текста';

        $this->mkAppErr = $mkAppErr;
    }

}