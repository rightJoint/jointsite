<?php


namespace Src\Views\JointSite\About;


use JointApp\Interfaces\LangWebViewInterface;

class View_JointSite_About_Notifications extends View_JointSite_About
{
    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_JointSite_About_Notifications';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/JointSite/About/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    //content after menu
    protected static function pageContentJointSite(\stdClass $contentBlock, string $langSl = ''):string
    {
        return '<section>'.
            '<h3>Модель уведомлений</h3>'.
            '<p>'.
            'Функции отправки уведомлений обычно реализуются в контроллере. '.
            'JointAppMailer.php принимает phpMailer для отправки уведомлений и модель для '.
            'поиска шаблона и формирования тела письма для phpMailer. '.
            'Настройки для yandex, пока по другому не придумано, берутся из файла /src/__config/mail/DefaultMailer.php. '.
            '</p>'.
            '<p>'.
            '<ul>'.
            '<li>Оповещение добавляется метододом класса JointAppMailer addNotification.</li>'.
            '<li>$templateName имя или id шалона уведомлений.</li>'.
            '<li>$subscriber_type для группы, пользователя или на eMail.</li>'.
            '<li>$type_id подписчика, значение группы, пользователя или eMail</li>'.
            '<li>$template_params переменные из окружения для подстановки в тело шаблона.</li>'.
            '<li>$send_now устанавливает контроллер. Отправить сразу или поставить в очередь.</li>'.
            '<li>$method (не используется).</li>'.
            '</ul>'.
            '</p>'.
            '</section>'.
            '<section>'.
            '<h3>Очередь уведомлений</h3>'.
            '<p>'.
            'Для обхода очереди предназначен метод JointAppMailer SendNtf. Отправлять новые уведомления можно сразу всем, '.
            'по рассписанию, например поставить скрип в cron и запускать раз в 5 минут. '.
            '</p>'.
            '<p>'.
            'Для обхода очереди предназначен метод JointAppMailer SendNtf. Отправлять новые уведомления можно сразу всем, '.
            'по рассписанию, например поставить скрип в cron и запускать раз в 5 минут. '.
            'Запис'.
            '</p>'.
            '</section>'.
            '<section>'.
            '<h3>Чтение уведомлений и логи</h3>'.
            '<p>'.
            'материал подготавливается к публикации'.
            '</p>'.
            '</section>'.
            '<section>'.
            '<h3>Проблемы с отправкой уведомлений</h3>'.
            '<p>'.
            'материал подготавливается к публикации'.
            '</p>'.
            '</section>';
    }
}