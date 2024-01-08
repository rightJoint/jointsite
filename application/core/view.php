<?php
class View
{
    public $shortcut_icon = "/img/siteLogo/favicon.png";
    public $logo = "/img/popimg/menu-icon.png";

    public $view_data = null; /*set in model get_data*/

    public $is_db_conn = false;

    public $styles = array(
        "/css/default.css",
        "/css/header.css",
    );

    public $scripts = array(
        "/lib/js/googleapis.js",
        "/js/header.js",
    );

    public $metrika = null;
    public $yandex_verification = null;
    public $metrik_block = true;
    public $robot_no_index = false;

    public $active_modal_menu = false;

    public $lang_map = array(
        "head" => array(
            "description" => array(
                "en" => "Web site by Right Joint (www.rightjoint.ru)",
                "rus" => "Web сайт от Right Joint (www.rightjoint.ru)",
            ),
            "title" => array(
                "en" => "Web site",
                "rus" => "Web сайт",
            ),
            "h1" => array(
                "en" => "Web site by Right Joint",
                "rus" => "Web сайт от Right Joint"
            ),
            "header_text" => array(
                "en" => "Web site",
                "rus" => "Web сайт",
            )

        ),
        "view_err" => array(
            "generate_cv" => array(
                "en" => "Path to content view not valid",
                "rus" => "Путь к content view неправильный",
            ),
            "generate_tv" => array(
                "en" => "Path to template view not valid",
                "rus" => "Путь к template view неправильный",
            ),
        ),
        "modal-menu" => array(
            "ref_home" => array(
                "en" => "Home",
                "rus" => "Главная"
            ),
            "ref_home_title" => array(
                "en" => "on Home",
                "rus" => "на главную"
            ),
            "ref_on_home_title" => array(
                "en" => "You are on main page",
                "rus" => "Вы уже на главной"
            ),
            "home_descr" => array(
                "en" => "Software product by Right Joint",
                "rus" => "Программы от Right Joint"
            )
        ),
        "lang_panel_text" => array(
            "en" => "view in english",
            "rus" => "смотреть на русском"
        ),
    );

    function __construct()
    {

    }

    function generate()
    {
        if($this->metrik_block){
            if(file_exists($_SERVER["DOCUMENT_ROOT"]."/".JOINT_CONF_DIR."/yandexmetrika.php")){
                require_once($_SERVER["DOCUMENT_ROOT"] . "/".JOINT_CONF_DIR."/yandexmetrika.php");
                $this->metrika = $yandex_metrika;
                $this->yandex_verification = $yandex_verification;
            }
        }

        echo "<!DOCTYPE html>".
            "<html lang='en-Us'>";
        $this->print_head();
        $this->print_body();
        $this->print_mkt();
        echo "</html>";
    }

    function print_head()
    {

        echo "<head>".
            "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
            "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        if($this->lang_map["head"]["description"][$_SESSION["lang"]]){
            echo "<meta name='description' content='".$this->lang_map["head"]["description"][$_SESSION["lang"]]."'/>";
        }
        if($this->metrik_block){
            echo $this->yandex_verification;
        }else{
            if($this->robot_no_index){
                echo "<meta name='robots' content='noindex'>";
            }
        }
        echo "<title>".$this->lang_map["head"]["title"][$_SESSION["lang"]]."</title>".
            "<link rel='SHORTCUT ICON' href='".$this->shortcut_icon."' type='image/png'>";
        foreach ($this->styles as $style => $stLink){
            echo "<link rel='stylesheet' href='".$stLink."' type='text/css' media='screen, projection'/>";
        }
        foreach ($this->scripts as $script => $scrSrc){
            echo "<script src='".$scrSrc."'></script>";
        }
        echo "</head>";
    }

    function print_mkt()
    {
        global $mct;
        $mct["end_time"] = microtime(true);
        echo "<script>$('body').after('<span style=".'"'.
            " color: silver; position: relative; bottom: 1.2em; left: 0,5em; ".
            " display: block; height:0; width:0; font-size:0.7em;".'"'.">".
            strval($mct['end_time']-$mct['start_time'])."</span>')</script>";
    }

    public function print_body()
    {
        echo "<body>".
            "<div class='page-wrap'>";
        $this->print_header();
        $this->print_page_content();
        $this->print_footer();
        echo "</div>";

        $this->print_modals();

        echo "</body>";
    }

    public function print_header()
    {
        echo "<header><div class='headerCenter'>";
        echo "<div class='lang-panel'>".
            "<a class='lang-cntrl ";
        if($_SESSION["lang"] == "rus"){
            echo "active ";
        }
        echo "rus' href='?lang=rus' title='".$this->lang_map["lang_panel_text"]["rus"]."'><span>Рус</span></a>".
            "<a class='lang-cntrl ";
        if($_SESSION["lang"] == "en"){
            echo "active ";
        }
        echo "en' href='?lang=en' title='".$this->lang_map["lang_panel_text"]["en"]."'><span>En</span></a>".
            "</div>";
        echo "<div class='menuBtn hi-icon-effect-1 hi-icon-effect-1a'>".
            "<span class='hi-icon hi-icon-mobile menu'><span class='hi-text'>МЕНЮ</span></span></div>".
            "<div class='h-caption'>".
            "<div class='textBlock ";
        global $server;
        if(!$server['reqUri_expl'][1]){
            echo "landing";
        }
        echo "'><span class='firmName'>".$this->lang_map["head"]["header_text"][$_SESSION["lang"]]."</span>".
            "<h1>".$this->lang_map["head"]["h1"][$_SESSION["lang"]]."</h1></div></div></div></header>".
            "<style>.hi-icon-mobile.menu:before {background-image: url(".$this->logo.");}</style>";
    }

    public function print_footer()
    {
        echo "<div class='contentBlock-frame dark ft'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<footer>".
            "<div class='ft-service'>";
        if($this->metrik_block) {
            echo $this->metrika;
        }
        echo "</div><div class='ft-center'><hr><span>by Right Joint</span></div>".
            "<div class='ft-right'>".
            "</div>".
            "</footer>".
            "</div></div></div>";
    }

    public function print_page_content()
    {
        echo $this->view_data;
    }

    public function print_modals()
    {
        $this->modalMenu();
    }

    function modalMenu()
    {
        global $routes;

        $active_modal_menu_style = null;

        if($this->active_modal_menu){
            $active_modal_menu_style = "style='opacity: 1; visibility: visible'";
        }

        echo "<div class='modal menu' ".$active_modal_menu_style.">".
            "<div class='overlay' ".$active_modal_menu_style."></div><div class='contentBlock-frame'>".
            "<div class='contentBlock-center'><div class='modal-right'><div class='modal-close'></div>".
            "</div><div class='modal-left'>".
            "<div class='modal-line' style='position: relative; min-height: 3.8em' >".
            "<div class='lang-panel mp'>".
            "<a class='lang-cntrl ";
        if($_SESSION["lang"] == "rus"){
            echo "active ";
        }
        echo "rus' href='?lang=rus' title='".$this->lang_map["lang_panel_text"]["rus"]."'><span>Рус</span></a>".
            "<a class='lang-cntrl ";
        if($_SESSION["lang"] == "en"){
            echo "active ";
        }
        echo "en' href='?lang=en' title='".$this->lang_map["lang_panel_text"]["en"]."'><span>En</span></a>".
            "</div>".
            "<div class='mm-htl'>".
            "<a href='/' title='";
        if($routes[1]){
            echo $this->lang_map["modal-menu"]["ref_home_title"][$_SESSION["lang"]];
        }else{
            echo $this->lang_map["modal-menu"]["ref_on_home_title"][$_SESSION["lang"]];
        }
        echo "'>".
            "<img src='/img/siteLogo/rightjoint-logo-150.png' alt='RJ-logo'>".
            $this->lang_map["modal-menu"]["ref_home"][$_SESSION["lang"]].
            "</a>".
            "<p>".$this->lang_map["modal-menu"]["home_descr"][$_SESSION["lang"]]."</p>".
            "</div>".
            "</div>";

        echo "</div></div></div></div>";
    }

    function generateJson($data)
    {
        echo json_encode($data, true);
    }
}