<?php
class lang_view_landing_rus extends lang_view_rus
{
    function __construct()
    {
        $this->head["h1"] = "Услуги разработчика";
        $this->head["title"] = "Наёмный программист";
        $this->head["description"] = "Наёмный программист RightJoint: программирование на php и c#. Создание нового и поддержка существующего софта. ".
            "Бесплатно продукт jointPass - органайзер паролей, скачать. ".
            "Популярные услуги: php, c#, js, html, git, ";
        $this->titleblock = array(
            "invoke" => "Программирование на php и c#",
            "invoke-cm" => "Создание нового и поддержка существующего софта, автоматизация бизнесс-процессов",
            "st-txt1" => "Аналитический подход",
            "st-txt2" => "Отвественный выполнение",
            "st-txt3" => "Решение сложных проблем",
            "thought" => "Доверив свои задачи специалисту, вам не придется волноваться, что все будет сделано ".
                "правильно и вовремя.",
            "cb-txt" => "Позвонить",
            "advantages-list-1" => "Более 10 опыта в it-сфере",
            "advantages-list-2" => "Хорошая репутация",
            "advantages-list-3" => "Опыт работы в банке",
            "advantages-list-4" => "Без посредников",
            "advantages-list-5" => "Flexible pricing and discount system",
            "ask-q-1" => "Задайте свои вопросы по",
            "ask-q-2" => "Телеграм",
            "ask-q-3" => "или",
            "ask-q-4" => "оставьте заявку",
            "ask-q-5" => "на сайте",
        );
        $this->producth2 = "Мои продукты - бесплатно";
        $this->pops = array(
            "h2" => "Популярные услуги",
            "btn-buy" => "Купить",
            "more-txt" => "ещё",
        );
        $this->contactsblock = array(
            "address-f" => "Адрес",
            "address-v" => "г. Иваново, ул. 8 Марта, д. 32, ТРЦ «Серебряный город»",
            "Schedule-f" => "Режим работы",
            "Schedule-v" => "пнд. - птн. с 9.00 до 18.00, сбт., вск. - выходной",
            "phone-f" => "Телефон",
        );

        $this->jointpass = array(
        "title" => "Джойнт Пасс",
        "p1" => "Органайзер паролей. ".
            "Вам не придется помнить пароли от всех ваших учеток, достаточно помнить один МастерПасс от программы. ",
        "p2" => "Нажмите на учетку в таблице и кнопки копирования логина и пароля сразу доступны на панели. ".
            "Все данные шифруются и хранятся на вашем диске. Вы можете распределить ваши учетки на группы и категории.",
        "p3" => "Кроме двух предустановленных полей (логин и пароль) вы можете создать собственные, добавить к ним изображения и включить шифрование. ".
            "К учетке можно добавлять любое количество уникальных полей.",
        "p4" => "Следите за обновлением паролей просто отсортировав учетки в таблице по дате обновления. ".
            "Вы можете скопировать данные программы чтоб перенести на другой ПК. ".
            "Мастер Пас можно менять, программа перешифрует данные.",
        "a_title" => "скачать приложение jointPass",
        "a_text" => "Скачать",
        "arrow" => "Узнать больше",
        "h2" => "Мои продукты - бесплатно",
    );
    }
}
