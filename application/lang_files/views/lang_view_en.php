<?php
class lang_view_en
{
    public $head = array(
        "description" => "Web site by Right Joint (www.rightjoint.ru)",
        "title" => "Web site",
        "h1" => "Web site by Right Joint",
        "header_text" => "RIGHT JOINt",
        "menu-btn-text" => "MENU",
    );
    public $modalmenu = array(
        "ref_home" => "Home",
        "ref_home_title" => "on Home",
        "ref_on_home_title" => "You are on main page",
        "home_descr" => "Geek services - portfolio",
    );
    public $langpaneltextrus = "смотреть на русском";
    public $langpaneltexten = "view in english";

    public $prod_titles_in_menu = array(
        "jointSite" => array(
            "title" => "About web-application joint site",
            "text" => "Web-site",
            "sup" => "php, js, mvc",
            "ddm_text" => "product",
        ),
        "siteman" => array(
            "title" => "Mange site",
            "text" => "Mange",
            "sup" => "site",
            "ddm_text" => "menu",
        ),
    );

    public $auth_menu_text = array(
        "site" => array(
            "siteUser" => "on Site",
            "exit" => "exit",
            "title" => "personal page",
            "ddm_text" => "menu",
        ),
        "admin" => array(
            "title" => "php admin for mysql",
            "text" => "Admin DB",
            "sup" => "for mysql",
            "ddm_text" => "menu",
        ),
    );

    public $menu_blocks = array(
        "branches" => array(
            "menu_items" => array(
                "record" => array(
                    "aliasMenu" => "Branch Record",
                    "altText" => "about branch Record",
                    "test_ref" => JOINT_SITE_EXEC_DIR . "/products/jointsite/recnew",
                    "test_ref_title" => "Do test",
                    "descr" => "Record structure gets from database or file described that. " .
                        "Embedded custom fields as list or file to upload data, and another.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/recnew' title='download from github'>link to github</a>",
                    "more" => "<a href='" . JOINT_SITE_EXEC_DIR . "/products/jointsite/recnew' title='learn more'>detail</a>",
                    "depend" => "no dependencies",
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

                "admin" => array(
                    "aliasMenu" => "Simple php admin for mysql",
                    "altText" => "detail about Admin",
                    "test_ref" => JOINT_SITE_EXEC_DIR."/products/jointsite/admin",
                    "test_ref_title" => "Do test Admin",
                    "descr" => "Simple php admin provide web-interface to set up connection to mysql-server and database, ".
                        "work with tables and records. ".
                        "Implemented facility to control migrations.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/admin' title='downlowd from github'>link to github</a>",
                    "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/admin' title='learn more about Admin'>detail</a>",
                    "depend" => "branch record",
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
                    "depend" => "ветка record",
                ),
            ),
        ),
        "admin" => array(
            "menu_items" => array(
                "server" => array(
                    "aliasMenu" => "SQL-server",
                    "altText" => "Set up connection to SQL-server and DB",
                ),
                "users" => array(
                    "aliasMenu" => "Users",
                    "altText" => "List of users, add or remove admin user",
                ),
                "sql" => array(
                    "aliasMenu" => "SQL",
                    "altText" => "Exec SQL-query",
                ),
                "printquery" => array(
                    "aliasMenu" => "Print query",
                    "altText" => "Display tables rows select output",
                ),
                "tables" => array(
                    "aliasMenu" => "Tables",
                    "altText" => "Actions with tables: create, delete, clear, upload, download",
                ),
                "records" => array(
                    "aliasMenu" => "Edit record",
                    "altText" => "Edit, create, delete record in a table",
                ),
                "migrations" => array(
                    "aliasMenu" => "Migrations",
                    "altText" => "Update database, records and structure",
                ),
            ),
        ),
    );

    public $sitesignInform = array(
        "form_title" => "Sign in",
        "placeholder_login" => "Your login...",
        "placeholder_password" => "Enter Your password...",
        "submit_btn" => "Submit",
    );
    public $sitesignUpform = array(
        "form_title" => "Sign up",
        "placeholder_login" => "Make up login...",
        "placeholder_password" => "password...",
        "placeholder_repeat" => "repeat password...",
        "placeholder_mail" => "your email...",
        "submit_btn" => "Register now",
        "errors" => array(
            "login_unacceptable" => "login unacceptable",
            "login_reserved" => "login reserved",
            "pass_unacceptable" => "password unacceptable",
            "pass_dont_match" => "passwords dont match",
            "email_unacceptable" => "email unacceptable",
        ),
    );

    public $adminblock = array(
        "form_title" => "Get in Admin",
        "placeholder_login" => "You login...",
        "placeholder_password" => "enter password...",
        "submit_btn" => "Submit",
    );

    public $musicmenu = array(
        "link_text" => "My favorite music",
        "link_title" => "Work a little fun with good music",
    );
}