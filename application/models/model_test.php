<?php
class Model_Test
{
    public function get_data()
    {
        return array(
            "en" => "application test success, model passed data - this text",
            "rus" => "проверка приложения прошла успешно, модель передала данные - этот текст"
        )[$_SESSION["lang"]];
    }
}