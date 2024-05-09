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
    public $view_err = array(
        "generate_cv" => "Путь к content view неправильный",
        "generate_tv" => "Путь к template view неправильный",
    );
    public $modalmenu = array(
        "ref_home" => "Главная",
        "ref_home_title" => "на главную",
        "ref_on_home_title" => "Вы уже на главной",
        "home_descr" => "Услуги программиста - портфолио",
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
