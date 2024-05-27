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
        "jointSite" => "About web-application joint site",
    );
    public $menu_blocks = array(
        "branches" => array(
            "menu_items" => array(
                "main" => array(
                    "aliasMenu" => "Branch Application (Main)",
                    "altText" => "about branch main",
                    "test_ref" => JOINT_SITE_EXEC_DIR . "/products/jointsite/main",
                    "test_ref_title" => "Do test",
                    "descr" => "Its possible to run this app inside some another app or deploy as site.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/main' title='get from github'>link to github</a>",
                    "more" => "<a href='" . JOINT_SITE_EXEC_DIR . "/products/jointsite/main' title='learn more'>detail</a>",
                    "depend" => "no dependencies",
                ),
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
                    "depend" => "branch main",
                ),
                "admin" => array(
                    "aliasMenu" => "Simple php admin for mysql",
                    "altText" => "detail about Admin",
                    "test_ref" => JOINT_SITE_EXEC_DIR."/products/jointsite/admin",
                    "test_ref_title" => "Do test Admin",
                    "descr" => "Simple php admin provide web-interface to set up connection to mysql-серверу adn database, ".
                        "work with tables and records. ".
                        "Implemented facility to control migrations.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/admin' title='downlowd from github'>link to github</a>",
                    "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/admin' title='learn more about Admin'>detail</a>",
                    "depend" => "branch record",
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
    public $adminblock = array(
        "form_title" => "Get in Admin",
        "placeholder_login" => "You login...",
        "placeholder_password" => "enter password...",
        "submit_btn" => "Submit",
    );
}