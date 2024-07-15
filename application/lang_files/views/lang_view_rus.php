<?php
class lang_view_rus
{
    public $head = array(
        "description" => "Web сайт от Right Joint (www.rightjoint.ru)",
        "title" => "Web сайт",
        "h1" => "Web сайт от Right Joint",
        "header_text" => "РАЙТ ДЖОЙНt",
        "menu-btn-text" => "МЕНЮ",
    );
    public $modalmenu = array(
        "ref_home" => "Главная",
        "ref_home_title" => "на главную",
        "ref_on_home_title" => "Вы уже на главной",
        "home_descr" => "Услуги программиста - портфолио",
    );
    public $langpaneltextrus = "смотреть на русском";
    public $langpaneltexten = "view in english";

    public $prod_titles_in_menu = array(
        "jointSite" => array(
            "title" => "Подробнее о web-приложении joint site",
            "text" => "Web-Сайт",
            "sup" => "php, js, mvc",
            "ddm_text" => "продукт",
        ),
        "siteman" => array(
            "title" => "Управление сайтом",
            "text" => "Управление",
            "sup" => "сайтом",
            "ddm_text" => "меню",
        ),
    );
    public $auth_menu_text = array(
        "site" => array(
            "siteUser" => "на Сайте",
            "exit" => "выход",
            "title" => "кабинет",
        ),
    );
    public $menu_blocks = array(
        "branches" => array(
            "menu_items" => array(
                "record" => array(
                    "aliasMenu" => "Ветка Запись (Record)",
                    "altText" => "подробнее о ветке Запись",
                    "descr" => "Структуру записи можно получить из базы данных или описать в файле в виде массива. ".
                        "Добавлены кастомные поля типа list и файл для загрузки данных, и другие.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/recnew' title='скачать с гит хаба'>ссылка на github</a>",
                    "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/record' title='узнать подробнее про Запись'>подробнее</a>",
                    "depend" => "нет звисимостей",
                    "use_in_mm" => true,
                ),
                "siteman" => array(
                    "aliasMenu" => "Управление сайтом (Siteman)",
                    "altText" => "подробнее о ветке Siteman",
                    "test_ref" => JOINT_SITE_EXEC_DIR."/products/jointsite/siteman",
                    "test_ref_title" => "Перейти к тесту",
                    "descr" => "Ветка Sitema предназначена для быстрого старта новых модулей, ".
                        "позволяет настроить доступ к сайту используя авторизацию и систему ролей, для оповещения пользователей ".
                        "разработана модель и шаблоны уведомлений.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/siteman' title='скачать с гит хаба'>ссылка на github</a>",
                    "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/siteman' title='узнать подробнее про Управление сайтом'>подробнее</a>",
                    "depend" => "ветка record",
                    "use_in_mm" => true,
                ),
                "music" => array(
                    "aliasMenu" => "Ветка Myзыка",
                    "altText" => "подробнее о ветке Myзыка",
                    "test_ref" => JOINT_SITE_EXEC_DIR."/products/jointsite/music",
                    "test_ref_title" => "Перейти к тесту",
                    "descr" => "Описание ветки музыка. ".
                        "Создание альбомов, добавление мелодий.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/music' title='скачать с гит хаба'>ссылка на github</a>",
                    "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/music' title='узнать подробнее про Myзыка'>подробнее</a>",
                    "depend" => "ветка siteman",
                    "use_in_mm" => true,
                ),
                "main" => array(
                    "aliasMenu" => "Ветка Приложение (Main)",
                    "altText" => "подробнее о ветке Приложение (Main)",
                    "descr" => "Приложение JointSite можно установить как web-сайт или запустить на отдельном адресе. ".
                        "В ветку main вливаются содержит все некоммерческие ветки сайта.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/main' title='скачать с гит хаба'>ссылка на github</a>",
                    "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/main' title='узнать подробнее про Запись'>подробнее</a>",
                    "depend" => "нет звисимостей",
                ),
            ),
        ),
    );

    public $sitesignInform = array(
        "form_title" => "Вход на сайт",
        "placeholder_login" => "Ваш логин...",
        "placeholder_password" => "введите пароль...",
        "submit_btn" => "Войти",
    );
    public $sitesignUpform = array(
        "form_title" => "Регистрация на сайте",
        "placeholder_login" => "Придумайте логин...",
        "placeholder_password" => "пароль...",
        "placeholder_repeat" => "повторите пароль...",
        "placeholder_mail" => "Ваш email...",
        "submit_btn" => "Зарегистрировать",
        "errors" => array(
            "login_unacceptable" => "недопустимый логин",
            "login_reserved" => "логин зарезервирован",
            "pass_unacceptable" => "недопустимый пароль",
            "pass_dont_match" => "пароли не совпадают",
            "email_unacceptable" => "недопустимый email",
        ),
    );

    public $musicmenu = array(
        "link_text" => "Избранные трэки",
        "link_title" => "Работать приятней под хорошую музыку",
    );
}
