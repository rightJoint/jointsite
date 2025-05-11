<?php
class LangFiles_Ru_Views_Landing extends LangFiles_Ru_Views_SiteView
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->description = 'Разработка и поддрежка сайтов: создание сайтов, интеграция по api с внешними сервисами, '.
            'автоматизация бизнесс-процессов, оптимизация скриптов, врестка по макетам, настройка git-репозиториев и ci/cd. '.
            'Программирование на php и c#. Популярные услуги: php, c#, js, html, git, docker, crm.';
        $langHead->title = 'IT-услуги';

        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Наёмный программист';

        return $langHeader;
    }

    static public function getLangPageContent():\stdClass
    {
        $langPageContent = parent::getLangPageContent();

        $titleBlock = new stdClass();
        $titleBlock->invoke = 'Программирование на php и c#';
        $titleBlock->invoke_cm = 'Создание нового и поддержка существующего софта, автоматизация бизнесс-процессов';
        $titleBlock->st_txt1 = 'Аналитический подход';
        $titleBlock->st_txt2 = 'Отвественный выполнение';
        $titleBlock->st_txt3 = 'Решение сложных проблем';
        $titleBlock->thought = 'Доверив свои задачи специалисту, вам не придется волноваться, что все будет сделано '.
        'правильно и вовремя.';
        $titleBlock->cb_txt = 'Позвонить';
        $titleBlock->advantages_list_1 = 'Более 10 опыта в it-сфере';
        $titleBlock->advantages_list_2 = 'Хорошая репутация';
        $titleBlock->advantages_list_3 = 'Командный игрок';
        $titleBlock->advantages_list_4 = 'Без посредников';
        $titleBlock->advantages_list_5 = 'Гибкие расценки и система скидок';
        $titleBlock->ask_q_1 = 'Задайте свои вопросы по';
        $titleBlock->ask_q_2 = 'Телеграм';
        $titleBlock->ask_q_3 = 'или';
        $titleBlock->ask_q_4 = 'оставьте заявку';
        $titleBlock->ask_q_5 = 'на сайте';

        $langPageContent->titleBlock = $titleBlock;


        $langPageContent->artLang = self::getLangLandingArt();

        $contactsBlock = new stdClass();

        $contactsBlock->address_f = 'Адрес';
        $contactsBlock->address_v = 'г. Иваново, ул. 8 Марта, д. 32, ТРЦ «Серебряный город»';
        $contactsBlock->Schedule_f = 'Режим работы';
        $contactsBlock->Schedule_v = 'Будни с 9.00 до 18.00';
        $contactsBlock->phone_f = 'Телефон';

        $langPageContent->contactsBlock = $contactsBlock;

        $popServ = new stdClass();

        $popServ->h2 = 'Популярные услуги';
        $popServ->btn_buy = 'Купить';
        $popServ->more_txt = 'ещё';

        $langPageContent->popServ = $popServ;

        return $langPageContent;
    }

    static public function getLangLandingArt():\stdClass
    {
        $artLang = new stdClass();
        $artLang->h2 = 'IT-Блог';
        $artLang->article = 'Статья';
        $artLang->from = 'от';
        $artLang->written = 'Написано';
        $artLang->arts = 'статей';
        $artLang->tags = 'тэги';
        return $artLang;
    }

}
