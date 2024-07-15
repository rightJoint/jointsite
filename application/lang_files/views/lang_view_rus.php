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
        "admin" => array(
            "title" => "Админка для mysql на php",
            "text" => "Админка БД",
            "sup" => "для mysql",
            "ddm_text" => "меню",
        ),
    );
    public $auth_menu_text = array(
        "admin" => array(
            "adminUser" => "в Админке",
            "exit" => "выход",
        ),
    );
    public $menu_blocks = array(
        "branches" => array(
            "menu_items" => array(
                "record" => array(
                    "aliasMenu" => "Ветка Запись (Record)",
                    "altText" => "подробнее о ветке Запись",
                    "test_ref" => JOINT_SITE_EXEC_DIR."/products/jointsite/record",
                    "test_ref_title" => "Перейти к тесту",
                    "descr" => "Структуру записи можно получить из базы данных или описать в файле в виде массива. ".
                        "Добавлены кастомные поля типа list и файл для загрузки данных, и другие.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/recnew' title='скачать с гит хаба'>ссылка на github</a>",
                    "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/record' title='узнать подробнее про Запись'>подробнее</a>",
                    "depend" => "нет звисимостей",
                    "use_in_mm" => true,
                ),
                "admin" => array(
                    "aliasMenu" => "Админка на php для mysql",
                    "altText" => "подробнее о ветке Admin",
                    "test_ref" => JOINT_SITE_EXEC_DIR."/products/jointsite/admin",
                    "test_ref_title" => "Перейти к тесту Admin",
                    "descr" => "Админка позволяет настроить подключение к mysql-серверу и базе данных, работать с таблицами и записями в них. ".
                        "Добавлена возможность контролировать миграции.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/admin' title='скачать с гит хаба'>ссылка на github</a>",
                    "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/admin' title='узнать подробнее про Админку'>подробнее</a>",
                    "depend" => "ветка record",
                    "use_in_mm" => true,
                    ),
                "main" => array(
                    "aliasMenu" => "Ветка Приложение (Main)",
                    "altText" => "подробнее о ветке Приложение",
                    "test_ref" => JOINT_SITE_EXEC_DIR."/products/jointsite/main",
                    "test_ref_title" => "Перейти к тесту",
                    "descr" => "Приложение JointSite можно установить как web-сайт или запустить на отдельном адресе. ".
                        "В ветку main вливаются содержит все некоммерческие ветки сайта.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/main' title='скачать с гит хаба'>ссылка на github</a>",
                    "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/main' title='узнать подробнее про Запись'>подробнее</a>",
                    "depend" => "нет звисимостей",
                ),
            ),
        ),
        "admin" => array(
            "menu_items" => array(
                "server" => array(
                    "aliasMenu" => "SQL-Сервер",
                    "altText" => "Настройка подключения к SQL-серверу и БД",
                    "use_in_mm" => true,
                ),
                "users" => array(
                    "aliasMenu" => "Пользователи",
                    "altText" => "Список пользователей, добавить или удалить пользователя",
                    "use_in_mm" => true,
                ),
                "sql" => array(
                    "aliasMenu" => "SQL",
                    "altText" => "Выполнить SQL-запрос",
                    "use_in_mm" => true,
                ),
                "printquery" => array(
                    "aliasMenu" => "Печать запроса",
                    "altText" => "Вывод в таблицу результата select",
                    "use_in_mm" => true,
                ),
                "tables" => array(
                    "aliasMenu" => "Таблицы",
                    "altText" => "Действия с таблицами: создать, удалить, очистить, выгрузить, загрузить",
                    "use_in_mm" => true,
                ),
                "records" => array(
                    "aliasMenu" => "Редактирование записей",
                    "altText" => "Редактировать, добавить, удалить запись в таблице",
                    "use_in_mm" => true,
                ),
                "migrations" => array(
                    "aliasMenu" => "Миграции",
                    "altText" => "Обновление базы данных, записей и структуры",
                    "use_in_mm" => true,
                ),
            ),
        ),
    );
    public $adminblock = array(
        "form_title" => "Вход в Админ",
        "placeholder_login" => "Ваш логин...",
        "placeholder_password" => "введите пароль...",
        "submit_btn" => "Войти",
    );

}
