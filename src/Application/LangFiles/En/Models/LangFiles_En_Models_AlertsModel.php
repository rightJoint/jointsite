<?php

use jointSite\Psr\Log\LogLevel;

class LangFiles_En_Models_AlertsModel
{
    public $stack_err = array(
        LogLevel::ERROR => array(
            "title" => "Not found",
            "h1" => "Page not found",
            "description" => "Page not found",
        ),
        LogLevel::DEBUG => array(
            "title" => "Reconstruction",
            "h1" => "Page temporarily on reconstruction",
            "description" => "Page temporarily on reconstruction",
        ),
        LogLevel::WARNING => array(
            "title" => "Forbidden",
            "h1" => "Access denied",
            "description" => "Access denied",
        ),
        LogLevel::CRITICAL => array(
            "title" => "Connection",
            "h1" => "Connection problem",
            "description" => "Connection problem",
        ),
        LogLevel::ALERT => array(
            "title" => "Request",
            "h1" => "Wrong request",
            "description" => "Wrong request",
        ),
        LogLevel::EMERGENCY => array(
            "title" => "Configuration",
            "h1" => "Configuration error",
            "description" => "Configuration error",
        ),
        LogLevel::NOTICE => array(
            "title" => "Unknown error",
            "h1" => "Unknown error occurred",
            "description" => "Unknown error occurred",
        ),
        LogLevel::INFO => array(
            "title" => "Info",
            "h1" => "Info",
            "description" => "Info",
        )
    );
}