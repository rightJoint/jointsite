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
        "siteman" => array(
            "title" => "Управление сайтом",
            "text" => "Управление",
            "sup" => "сайтом",
            "ddm_text" => "меню",
        ),
    );
    public $auth_menu_text = array(
        "admin" => array(
            "adminUser" => "в Админке",
            "exit" => "выход",
        ),
        "site" => array(
            "siteUser" => "на Сайте",
            "exit" => "выход",
            "title" => "кабинет",
        ),
    );
    public $menu_blocks = array(
        "branches" => array(
            "menu_items" => array(
                "main" => array(
                    "aliasMenu" => "Ветка Приложение (Main)",
                    "altText" => "подробнее о ветке Приложение",
                    "test_ref" => JOINT_SITE_EXEC_DIR."/products/jointsite/main",
                    "test_ref_title" => "Перейти к тесту",
                    "descr" => "Приложение можно установить как сайт или запускать внутри сайта на отдельном url. ",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/main' title='скачать с гит хаба'>ссылка на github</a>",
                    "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/main' title='узнать подробнее про приложение'>подробнее</a>",
                    "depend" => "нет зависимостей",
                ),
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
                    "depend" => "ветка main",
                ),
                "siteman" => array(
                    "aliasMenu" => "Управление сайтом (Siteman)",
                    "altText" => "подробнее о ветке Siteman",
                    "test_ref" => JOINT_SITE_EXEC_DIR."/products/jointsite/siteman",
                    "test_ref_title" => "Перейти к тесту",
                    "descr" => "про управление сайтом.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/siteman' title='скачать с гит хаба'>ссылка на github</a>",
                    "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/siteman' title='узнать подробнее про Управление сайтом'>подробнее</a>",
                    "depend" => "ветка module",
                ),
                "module" => array(
                    "aliasMenu" => "Ветка Модуль (Module)",
                    "altText" => "подробнее о ветке Модуль",
                    "test_ref" => JOINT_SITE_EXEC_DIR."/products/jointsite/module",
                    "test_ref_title" => "Перейти к тесту",
                    "descr" => "Описание ветки модуль. ".
                        "Пользователи, группы, уведомления. Принцип работы модуля.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/module' title='скачать с гит хаба'>ссылка на github</a>",
                    "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/module' title='узнать подробнее про Модуль'>подробнее</a>",
                    "depend" => "ветка record",
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
                ),
            ),
        ),
        "admin" => array(
            "menu_items" => array(
                "server" => array(
                    "aliasMenu" => "SQL-Сервер",
                    "altText" => "Настройка подключения к SQL-серверу и БД",
                ),
                "users" => array(
                    "aliasMenu" => "Пользователи",
                    "altText" => "Список пользователей, добавить или удалить пользователя",
                ),
                "sql" => array(
                    "aliasMenu" => "SQL",
                    "altText" => "Выполнить SQL-запрос",
                ),
                "printquery" => array(
                    "aliasMenu" => "Печать запроса",
                    "altText" => "Вывод в таблицу результата select",
                ),
                "tables" => array(
                    "aliasMenu" => "Таблицы",
                    "altText" => "Действия с таблицами: создать, удалить, очистить, выгрузить, загрузить",
                ),
                "records" => array(
                    "aliasMenu" => "Редактирование записей",
                    "altText" => "Редактировать, добавить, удалить запись в таблице",
                ),
                "migrations" => array(
                    "aliasMenu" => "Миграции",
                    "altText" => "Обновление базы данных, записей и структуры",
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

    public $modalorder = array(
        "btn-hire" => "ЗАКАЗ",
        "hire-txt" => "Присматриваю варианты для взаимовыгодного сотрудничества. Готов приступить к работе по договоренности",
        "telega-t" => "связаться по телеграмм",
        "order-form" => array(
            "basket-txt" => "Ваш заказ",
            "leave-app" => "Оставить заявку",
            "cancel-order" => "Отменить заказ",
            "app-txt" => "Далее вы будете переадресованы на страницу, ".
                "на которой всегда сможете отследить статус вашей заявки, добавить описание и вложение",
            "name-ps" => "Ваше имя",
            "mail-ps" => "Ваш email",
            "phone-ps" => "Номер телефона",
            "message-ps" => "Сообщение",
            "submit" => "Отправить",
        ),
    );

}
