<?php
class Alerts_model
{
    public $stack_err = array(
        "notFound" => array(
            "title" => array(
                "en" => "Not found",
                "rus" => "Не найдено",
            ),
            "h1" => array(
                'en' => "Page not found",
                "rus" => "Страница не найдена",
            ),
            "description" => array(
                "en" => "Page not found",
                "rus" => "Страница не найдена",
            ),
            "response_code" => 404,
        ),
        "stab" => array(
            "title" => array(
                "en" => "Reconstruction",
                "rus" => "Реконструкция",
            ),
            "h1" => array(
                "en" => "Page temporarily on reconstruction",
                "rus" => "Страница временно на реконструкции",
            ),
            "description" => array(
                "en" => "Page temporarily on reconstruction",
                "rus" => "Страница временно на реконструкции",
            ),
            "response_code" => 200,
        ),
        "access" => array(
            "title" => array(
                "en" => "Forbidden",
                "rus" => "Запрещен",
            ),
            "h1" => array(
                "en" => "Access denied",
                "rus" => "Доступ запрещен",
            ),
            "description" => array(
                "en" => "Access denied",
                "rus" => "Доступ запрещен",
            ),
            "response_code" => 403,
        ),
        "connection" => array(
            "title" => array(
                "en" => "Connection",
                "rus" => "Подключение",
            ),
            "h1" => array(
                "en" => "Connection problem",
                "rus" => "Проблема с подключением",
            ),
            "description" => array(
                "en" => "Connection problem",
                "rus" => "Проблема с подключением",
            ),
            "response_code" => 200,
        ),
        "request" => array(
            "title" => array(
                "en" => "Request",
                "rus" => "Запрос",
            ),
            "h1" => array(
                "en" => "Wrong request",
                "rus" => "Неправильные параметры запроса",
            ),
            "description" => array(
                "en" => "Wrong request",
                "rus" => "Неправильные параметры запроса",
            ),
            "response_code" => 400,
        ),
        "config" => array(
            "title" => array(
                "en" => "Configuration",
                "rus" => "Конфигурация",
            ),
            "h1" => array(
                "en" => "Configuration error",
                "rus" => "Ошибка в конфигурации",
            ),
            "description" => array(
                "en" => "Configuration error",
                "rus" => "Ошибка в конфигурации",
            ),
            "response_code" => 200,
        ),
        "XXX" => array(
            "title" => array(
                "en" => "Unknown error",
                "rus" => "Неизвестная ошибка",
            ),
            "h1" => array(
                "en" => "Unknown error occurred",
                "rus" => "Произошка неизвестная ошибка",
            ),
            "description" => array(
                "en" => "Unknown error occurred",
                "rus" => "Произошка неизвестная ошибка",
            ),
            "response_code" => 200,
        )
    );
}