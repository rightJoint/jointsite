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
            ),
        ),
    );
}
