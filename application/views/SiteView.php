<?php
class SiteView extends View
{
    public $shortcut_icon = JOINT_SITE_EXEC_DIR."/img/siteLogo/favicon.png";
    public $logo = JOINT_SITE_EXEC_DIR."/img/popimg/menu-icon.png";

    public $view_data = null;

    public $styles = array(
        JOINT_SITE_EXEC_DIR."/css/default.css",
        JOINT_SITE_EXEC_DIR."/css/header.css",
    );

    public $scripts = array(
        JOINT_SITE_EXEC_DIR."/lib/js/googleapis.js",
        JOINT_SITE_EXEC_DIR."/js/header.js",
    );

    public $metrika = null;
    public $yandex_verification = null;
    public $metrik_block = true;
    public $robot_no_index = false;

    public $active_modal_menu = false;

    public $lang_map;

    public $branches = array(
        "main" => array(
            "href" => "#",
            "img" => JOINT_SITE_EXEC_DIR."/img/siteLogo/rightjoint-logo-400.png",
        ),
    );

    function __construct()
    {
        $lang_class = $this->LoadViewLang();
        $this->lang_map = new $lang_class;
    }

    function LoadViewLang()
    {
        require_once ($_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/views/lang_view_".$_SESSION["lang"].".php");
        $return_lang = "lang_view_".$_SESSION["lang"];

        global $request;


        if($custom_lang = $this->LoadViewLang_custom($request)){
            $return_lang = $custom_lang;
        }

        return $return_lang;
    }

    function LoadViewLang_custom($ll_request)
    {
        $lang_name = null;
        if (!empty($ll_request["routes"][$ll_request["exec_dir_cnt"]])){
            $try_name = "lang_view_".$ll_request["routes"][$ll_request["exec_dir_cnt"]]."_".$_SESSION["lang"];
            $try_path = $_SERVER["DOCUMENT_ROOT"].$ll_request["exec_path"]."/application/lang_files/views/".strtolower($try_name).'.php';
            if(file_exists($try_path)){
                require_once ($try_path);
                $lang_name = $try_name;
            }
            if (!empty($ll_request["routes"][$ll_request["exec_dir_cnt"]+1])){
                $try_name = "lang_view_".$ll_request["routes"][$ll_request["exec_dir_cnt"]]."_".
                    $ll_request["routes"][$ll_request["exec_dir_cnt"]+1]."_".$_SESSION["lang"];
                $try_path = $_SERVER["DOCUMENT_ROOT"].$ll_request["exec_path"]."/application/lang_files/views/".strtolower($try_name).'.php';

                if(file_exists($try_path)){
                    require_once ($try_path);
                    $lang_name = $try_name;
                }
            }
        }else{
            $try_name = "lang_view_main_".$_SESSION["lang"];

            $try_path = $_SERVER["DOCUMENT_ROOT"].$ll_request["exec_path"]."/application/lang_files/views/".strtolower($try_name).'.php';
            if(file_exists($try_path)){
                require_once ($try_path);
                $lang_name = $try_name;
            }
        }
        return $lang_name;
    }


    function generate()
    {
        $this->set_head_array();
        if($this->metrik_block){
            if(file_exists(JOINT_SITE_CONF_DIR."/yandexmetrika.php")){
                require_once JOINT_SITE_CONF_DIR."/yandexmetrika.php";
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

    function set_head_array()
    {

    }

    function print_head()
    {
        echo "<head>".
            "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>".
            "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        if($this->lang_map->head["description"]){
            echo "<meta name='description' content='".$this->lang_map->head["description"]."'/>";
        }
        if($this->metrik_block){
            echo $this->yandex_verification;
        }else{
            if($this->robot_no_index){
                echo "<meta name='robots' content='noindex'>";
            }
        }
        echo "<title>".$this->lang_map->head["title"]."</title>".
            "<link rel='SHORTCUT ICON' href='".$this->shortcut_icon."' type='image/png'>";
        foreach ($this->styles as $style => $stLink){
            echo "<link rel='stylesheet' href='".$stLink."' type='text/css' media='screen, projection'/>";
        }
        foreach ($this->scripts as $script => $scrSrc){
            echo "<script src='".$scrSrc."'></script>";
        }
        echo "<script>var exec_dir='".JOINT_SITE_EXEC_DIR."';</script>";
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
        echo "rus' href='?lang=rus' title='".$this->lang_map->langpaneltextrus."'><span>Рус</span></a>".
            "<a class='lang-cntrl ";
        if($_SESSION["lang"] == "en"){
            echo "active ";
        }
        echo "en' href='?lang=en' title='".$this->lang_map->lang_panel_text_en."'><span>En</span></a>".
            "</div>";
        echo "<div class='menuBtn hi-icon-effect-1 hi-icon-effect-1a'>".
            "<span class='hi-icon hi-icon-mobile menu'><span class='hi-text'>".
            $this->lang_map->head["menu-btn-text"].
            "</span></span></div>".
            "<div class='h-caption'>".
            "<div class='textBlock ";
        global $routes;
        if(!$routes[1]){
            echo "landing";
        }
        echo "'><span class='firmName'>".$this->lang_map->head["header_text"]."</span>".
            "<h1>".$this->lang_map->head["h1"]."</h1></div></div>".
            "</div></header>";

        $header_add_styles ="<style>
        .hi-icon-mobile.menu:before {background-image: url(".$this->logo.");}
        .modal-right .modal-close{
                background-image: url('".JOINT_SITE_EXEC_DIR."/img/popimg/closeModal.png');
            }
            @media only screen and (max-width : 1024px) and (orientation : portrait){
            .modal-right:not(.signIn) .modal-close:not(.signIn){
                    background-image: url('".JOINT_SITE_EXEC_DIR."/img/popimg/closeModal-white.png');
            }
            }                      
            </style>";
        echo $header_add_styles;
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
        echo "rus' href='?lang=rus' title='".$this->lang_map->langpaneltextrus."'><span>Рус</span></a>".
            "<a class='lang-cntrl ";
        if($_SESSION["lang"] == "en"){
            echo "active ";
        }
        echo "en' href='?lang=en' title='".$this->lang_map->langpaneltexten."'><span>En</span></a>".
            "</div>".
            "<div class='mm-htl'>".
            "<a href='".JOINT_SITE_EXEC_DIR."' title='";
        if($routes[1]){
            echo $this->lang_map->modalmenu["ref_home_title"];
        }else{
            echo $this->lang_map->modalmenu["ref_on_home_title"];
        }
        echo "'>".
            "<img src='".JOINT_SITE_EXEC_DIR."/img/siteLogo/rightjoint-logo-150.png' alt='RJ-logo'>".
            $this->lang_map->modalmenu["ref_home"].
            "</a>".
            "<p>".$this->lang_map->modalmenu["home_descr"]."</p>".
            "</div>".
            "</div>";

        $this->print_products_menu();

        echo "</div></div></div></div>";
    }

    function print_products_menu()
    {
        global $request;
        $menuStyle = "style='display: none'";
        $folded_style = "folded";
        if ($request["routes"][$request["exec_dir_cnt"]] == "products" and
            $request["routes"][$request["exec_dir_cnt"]+1] == "jointsite"){
            $menuStyle = null;
            $folded_style = null;
        }
        echo "<div class='modal-line prod'>".
            "<div class='modal-line-img'><img src='/img/popimg/internet.png'></div>".
            "<div class='modal-line-text'><a class='m-l-blue' href='".JOINT_SITE_EXEC_DIR."/products/jointsite'>Web site</a><sup>php, js, mvc</sup>".
            "<span class='opnSubMenu ".$folded_style."'>product</span>".
            "<ul " . $menuStyle . ">";
        foreach ($this->branches as $b_name => $b_info) {
            echo "<li><a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/" . $b_name . "' class='sub-lnk light ";
            if($request["routes"][$request["exec_dir_cnt"]+2] == $b_name){
                echo "active";
            }
            echo "' title='".$mod_opt["altText"]."'>" . $this->lang_map->branchesList[$b_name]["title"] . "</a></li>";
        }

        echo "</ul>".
            "</div>".
            "</div>";
    }
}