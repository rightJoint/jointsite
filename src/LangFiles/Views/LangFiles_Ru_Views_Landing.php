<?php
class LangFiles_Ru_Views_Landing extends LangFiles_Ru_Views_SiteView
{
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
        $titleBlock->advantages_list_3 = 'Опыт работы в банке';
        $titleBlock->advantages_list_4 = 'Без посредников';
        $titleBlock->advantages_list_5 = 'Гибкие расценки и система скидок';
        $titleBlock->ask_q_1 = 'Задайте свои вопросы по';
        $titleBlock->ask_q_2 = 'Телеграм';
        $titleBlock->ask_q_3 = 'или';
        $titleBlock->ask_q_4 = 'оставьте заявку';
        $titleBlock->ask_q_5 = 'на сайте';

        $langPageContent->titleBlock = $titleBlock;

        $jointPass = new stdClass();

        $jointPass->title = 'Джойнт Пасс';
        $jointPass->p1 = 'Органайзер паролей. '.
                'Вам не придется помнить пароли от всех ваших учеток, достаточно помнить один МастерПасс от программы. ';
        $jointPass->p2 = 'Нажмите на учетку в таблице и кнопки копирования логина и пароля сразу доступны на панели. '.
                'Все данные шифруются и хранятся на вашем диске. Вы можете распределить ваши учетки на группы и категории.';
        $jointPass->p3 = 'Кроме двух предустановленных полей (логин и пароль) вы можете создать собственные, добавить к ним изображения и включить шифрование. '.
                'К учетке можно добавлять любое количество уникальных полей.';
        $jointPass->p4 = 'Следите за обновлением паролей просто отсортировав учетки в таблице по дате обновления. '.
                'Вы можете скопировать данные программы чтоб перенести на другой ПК. '.
                'Мастер Пас можно менять, программа перешифрует данные.';
        $jointPass->a_title = 'скачать приложение jointPass';
        $jointPass->a_text = 'Скачать';
        $jointPass->arrow = 'Узнать больше';
        $jointPass->h2 = 'Мои продукты - бесплатно';

        $langPageContent->jointPass = $jointPass;

        $contactsBlock = new stdClass();

        $contactsBlock->address_f = 'Адрес';
        $contactsBlock->address_v = 'г. Иваново, ул. 8 Марта, д. 32, ТРЦ «Серебряный город»';
        $contactsBlock->Schedule_f = 'Режим работы';
        $contactsBlock->Schedule_v = 'пнд. - птн. с 9.00 до 18.00, сбт., вск. - выходной';
        $contactsBlock->phone_f = 'Телефон';

        $langPageContent->contactsBlock = $contactsBlock;

        $popServ = new stdClass();

        $popServ->h2 = 'Популярные услуги';
        $popServ->btn_buy = 'Купить';
        $popServ->more_txt = 'ещё';

        $langPageContent->popServ = $popServ;

        return $langPageContent;
    }
    /*
    function __construct()
    {

        $this->head["h1"] = "Услуги разработчика";
        $this->head["title"] = "Наёмный программист";
        $this->head["description"] = "Наёмный программист RightJoint: программирование на php и c#. Создание нового и поддержка существующего софта. ".
            "Бесплатно продукт jointPass - органайзер паролей, скачать. ".
            "Популярные услуги: php, c#, js, html, git, ";

        $this->producth2 = "Мои продукты - бесплатно";
    );
    }
    */
}
