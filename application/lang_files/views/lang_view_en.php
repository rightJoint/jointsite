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
    public $view_err = array(
        "generate_cv" => "Path to content view not valid",
        "generate_tv" => "Path to template view not valid",
    );
    public $modalmenu = array(
        "ref_home" => "Home",
        "ref_home_title" => "on Home",
        "ref_on_home_title" => "You are on main page",
        "home_descr" => "Geek services - portfolio",
    );
    public $langpaneltextrus = "смотреть на русском";
    public $langpaneltexten = "view in english";

    public $branchesList = array(
        "main" => array(
            "title" => "Branch Application (Main)",
            "test_ref" => JOINT_SITE_EXEC_DIR."/products/jointsite/main",
            "test_ref_title" => "Do test",
            "descr" => "Set up application as website or use into site at specified url.",
            "version" => "v1.0",
            "get" => "<a href='https://github.com/rightJoint/jointsite/tree/main' title='скачать с гит хаба'>link to github</a>",
            "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/main' title='see detail info about app'>see details</a>",
            "depend" => "no dependencies",
        ),
    );
}