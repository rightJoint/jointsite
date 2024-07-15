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
        ),
    );

    public $menu_blocks = array(
        "branches" => array(
            "menu_items" => array(
                "record" => array(
                    "aliasMenu" => "Branch Record",
                    "altText" => "about branch Record",
                    "test_ref" => JOINT_SITE_EXEC_DIR . "/products/jointsite/record",
                    "test_ref_title" => "Do test",
                    "descr" => "Record structure gets from database or from structure-file. ".
                        "Embedded custom fields as list or file to upload data, and another",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/recnew' title='download from github'>link to github</a>",
                    "more" => "<a href='" . JOINT_SITE_EXEC_DIR . "/products/jointsite/recnew' title='learn more'>detail</a>",
                    "depend" => "no dependencies",
                    "use_in_mm" => true,
                ),
                "main" => array(
                    "aliasMenu" => "Branch Application (Main)",
                    "altText" => "learn more about Application",
                    "test_ref" => JOINT_SITE_EXEC_DIR."/products/jointsite/main",
                    "test_ref_title" => "Do test",
                    "descr" => "Application JointSite may use as web-site or run into another. ".
                        "Branch main contains all free branches of this site.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/main' title='download from github'>link to github</a>",
                    "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/main' title='learn more'>detail</a>",
                    "depend" => "no dependencies",
                ),
                "siteman" => array(
                    "aliasMenu" => "Site manager",
                    "altText" => "about branch Record Siteman",
                    "test_ref" => JOINT_SITE_EXEC_DIR."/products/jointsite/siteman",
                    "test_ref_title" => "Do test",
                    "descr" => "Branch Siteman meants for quick start new modules, ".
                        "allow adjust access by using auth and roles system, for users notifications ".
                        "has made model and templates.",
                    "version" => "v1.0",
                    "get" => "<a href='https://github.com/rightJoint/jointsite/tree/siteman' title='download from github'>link to github</a>",
                    "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/siteman' title='learn more'>detail</a>",
                    "depend" => "ветка module",
                    "use_in_mm" => true,
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
}