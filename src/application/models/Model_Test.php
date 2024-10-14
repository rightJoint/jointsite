<?php
class Model_Test
{
    public function get_data()
    {
        return array(
            "en" => "application test success, model passed data - this text",
            "ru" => "проверка приложения прошла успешно, модель передала данные - этот текст"
        )[JOINT_SITE_APP_LANG];
    }
}