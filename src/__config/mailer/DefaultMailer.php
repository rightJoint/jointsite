<?php

class DefaultMailer extends \PHPMailer\PHPMailer\PHPMailer
{
    public $CharSet = 'UTF-8';
    public $Host = 'smtp.yandex.ru';
    public $SMTPAuth = true;
    public $Username = 'your_yandex_name@yandex.ru';
    public $Password = 'your_yandex_pass';
    public $From = 'your_yandex_name@yandex.ru';
    public $FromName = 'your_yandex_name@yandex.ru';
    public $SMTPSecure = 'TLS';
    public $Port = 587;
    public $SMTPDebug = 3;
}