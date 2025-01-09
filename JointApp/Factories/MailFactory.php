<?php


namespace JointApp\Factories;


class MailFactory
{
    public static function getMailer(string $configDir, string $mailerName = 'DefaultMailer')
    {
        require_once $configDir.'/mailer/'.$mailerName.'.php';
        return new $mailerName();
    }
}