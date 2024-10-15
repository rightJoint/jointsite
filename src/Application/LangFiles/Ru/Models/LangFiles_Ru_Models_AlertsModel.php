<?php

use jointSite\Psr\Log\LogLevel;

class LangFiles_Ru_Models_AlertsModel
{
    public $stack_err = array(
        LogLevel::ERROR => array(
            "title" => "Не найдено",
            "h1" => "Страница не найдена",
            "description" => "Страница не найдена",
        ),
        LogLevel::DEBUG => array(
            "title" => "Реконструкция",
            "h1" => "Страница временно на реконструкции",
            "description" => "Страница временно на реконструкции",
        ),
        LogLevel::WARNING => array(
            "title" => "Запрещен",
            "h1" => "Доступ запрещен",
            "description" => "Доступ запрещен",
        ),
        LogLevel::CRITICAL => array(
            "title" => "Подключение",
            "h1" => "Проблема с подключением",
            "description" => "Проблема с подключением",
        ),
        LogLevel::ALERT => array(
            "title" => "Запрос",
            "h1" => "Неправильные параметры запроса",
            "description" => "Неправильные параметры запроса",
        ),
        LogLevel::EMERGENCY => array(
            "title" => "Конфигурация",
            "h1" => "Ошибка в конфигурации",
            "description" => "Ошибка в конфигурации",
        ),
        LogLevel::NOTICE => array(
            "title" => "Неизвестная ошибка",
            "h1" => "Произошка неизвестная ошибка",
            "description" =>"Произошка неизвестная ошибка",
        ),
        LogLevel::INFO => array(
            "title" => "Info",
            "h1" => "Info",
            "description" => "Info",
        )
    );
}