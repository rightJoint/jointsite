<?php
class LangFiles_Ru_Views_View
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
                "record" => array(
                    "aliasMenu" => "Ветка Запись (Record)",
                    "altText" => "подробнее о ветке Запись",
                    "descr" => "Структуру записи можно получить из базы данных или описать в файле в виде массива. ".
                        "Добавлены кастомные поля типа list и файл для загрузки данных, и другие.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/recnew' title='скачать с гит хаба'>ссылка на github</a>",
                    "more" => "<a href='".JOINT_SITE_APP_REF."/products/jointsite/record' title='узнать подробнее про Запись'>подробнее</a>",
                    "depend" => "нет звисимостей",
                    "use_in_mm" => true,
                ),
                "main" => array(
                    "aliasMenu" => "Ветка Приложение (Main)",
                    "altText" => "подробнее о ветке Приложение (Main)",
                    "descr" => "Приложение JointSite можно установить как web-сайт или запустить на отдельном адресе. ".
                        "В ветку main вливаются содержит все некоммерческие ветки сайта.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/main' title='скачать с гит хаба'>ссылка на github</a>",
                    "more" => "<a href='".JOINT_SITE_APP_REF."/products/jointsite/main' title='узнать подробнее про Запись'>подробнее</a>",
                    "depend" => "нет звисимостей",
                ),
            ),
        ),
    );
}
