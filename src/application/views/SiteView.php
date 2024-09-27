<?php
class SiteView extends View
{
    public $shortcut_icon = "/img/siteLogo/favicon.png";
    public $logo = "/img/popimg/menu-icon.png";

    public $view_data = null;

    public $styles = array(
        "/css/default.css",
        "/css/header.css",
        "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css",
    );

    public $scripts = array(
        "/lib/js/googleapis.js",
        "/js/header.js",
        "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js",
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
            "img" => "/img/siteLogo/rightjoint-logo-400.png",
        ),
        "record" => array(
            "href" => "#",
            "img" => "/img/popimg/record.png",
        ),
    );

    function __construct()
    {
        global $request;
        $lang_class = $this->LoadViewLang($request);
        $this->lang_map = new $lang_class;
    }

    function LoadViewLang($request = null)
    {
        require_once(JOINT_SITE_REQ_LANG."/views/lang_view.php");
        $return_lang = "lang_view";

        if (!$request) {
            global $request;
        }


        if (!empty($request["routes"][1])) {
            $try_name = "lang_view" . $request["routes"][1];
            $try_path = JOINT_SITE_REQ_LANG."/views/" . strtolower($try_name) . '.php';
            if (file_exists($try_path)) {
                require_once($try_path);
                $return_lang = $try_name;
            }
            if (!empty($request["routes"][2])) {
                $try_name = "lang_view_" . $request["routes"][1] . "_" .
                    $request["routes"][2];
                $try_path = JOINT_SITE_REQ_LANG."/views/" . strtolower($try_name) . '.php';

                if (file_exists($try_path)) {
                    require_once($try_path);
                    $return_lang = $try_name;
                }
            }
        } else {
            $try_name = "lang_view_main";

            $try_path = JOINT_SITE_REQ_LANG."/views/" . strtolower($try_name) . '.php';
            if (file_exists($try_path)) {
                require_once($try_path);
                $return_lang = $try_name;
            }
        }


        if ($custom_lang = $this->LoadViewLang_custom()) {
            $return_lang = $custom_lang;
        }

        return $return_lang;
    }

    function LoadViewLang_custom()
    {
        return false;
    }

    function generate()
    {
        header("Content-Type: ".$this->header_content_type);

        $this->set_head_array();
        if ($this->metrik_block) {
            if (file_exists(JOINT_SITE_CONF_DIR . "/yandexmetrika.php")) {
                require_once JOINT_SITE_CONF_DIR . "/yandexmetrika.php";
                if(isset($yandex_metrika)){
                    $this->metrika = $yandex_metrika;
                }
                if(isset($yandex_verification)){
                    $this->yandex_verification = $yandex_verification;
                }
            }
        }

        echo "<!DOCTYPE html>" .
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
        echo "<head>" .
            "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>" .
            "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        if ($this->lang_map->head["description"]) {
            echo "<meta name='description' content='" . $this->lang_map->head["description"] . "'/>";
        }
        if ($this->metrik_block) {
            echo $this->yandex_verification;
        } else {
            if ($this->robot_no_index) {
                echo "<meta name='robots' content='noindex'>";
            }
        }
        echo "<title>" . $this->lang_map->head["title"] . "</title>" .
            "<link rel='SHORTCUT ICON' href='" . $this->shortcut_icon . "' type='image/png'>";
        foreach ($this->styles as $style => $stLink) {
            echo "<link rel='stylesheet' href='" . $stLink . "' type='text/css' media='screen, projection'/>";
        }
        foreach ($this->scripts as $script => $scrSrc) {
            echo "<script src='" . $scrSrc . "'></script>";
        }
        echo "</head>";
    }

    function print_mkt()
    {
        global $mct;
        $mct["end_time"] = microtime(true);
        echo "<script>$('body').after('<span style=" . '"' .
            " color: silver; position: relative; bottom: 1.2em; left: 0,5em; " .
            " display: block; height:0; width:0; font-size:0.7em;" . '"' . ">" .
            strval($mct['end_time'] - $mct['start_time']) . "</span>')</script>";
    }

    public function print_body()
    {
        echo "<body>" .
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
        global $request;
        echo "<header><div class='headerCenter'>";
        echo "<div class='lang-panel'>" .
            "<a class='lang-cntrl ";
        if (JOINT_SITE_APP_LANG == "ru") {
            echo "active ";
        }
        echo "rus' href='/ru".JOINT_SITE_REQ_ROOT."' title='" . $this->lang_map->langpaneltextrus . "'><span>Рус</span></a>" .
            "<a class='lang-cntrl ";
        if (JOINT_SITE_APP_LANG == "en") {
            echo "active ";
        }
        echo "en' href='/en".JOINT_SITE_REQ_ROOT."' title='" . $this->lang_map->langpaneltexten . "'><span>En</span></a>" .
            "</div>";
        echo "<div class='menuBtn hi-icon-effect-1 hi-icon-effect-1a'>" .
            "<span class='hi-icon hi-icon-mobile menu'><span class='hi-text'>" .
            $this->lang_map->head["menu-btn-text"] .
            "</span></span></div>" .
            "<div class='h-caption'>" .
            "<div class='textBlock ";

        /*rj-todo text block style on vertical screen, main branch*/
        if (!isset($request["routes"][1]) or $request["routes"][1] == null) {
            echo "landing";
        }
        echo "'><span class='firmName'>" . $this->lang_map->head["header_text"] . "</span>" .
            "<h1>" . $this->lang_map->head["h1"] . "</h1></div></div>" .
            "</div></header>";

        $header_add_styles = "<style>
        .hi-icon-mobile.menu:before {background-image: url(" . $this->logo . ");}
        .modal-right .modal-close{
                background-image: url('/img/popimg/closeModal.png');
            }
            @media only screen and (max-width : 1024px) and (orientation : portrait){
            .modal-right:not(.signIn) .modal-close:not(.signIn){
                    background-image: url('/img/popimg/closeModal-white.png');
            }
            }                      
            </style>";
        echo $header_add_styles;
    }

    public function print_footer()
    {
        echo "<div class='contentBlock-frame dark ft'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap'>" .
            "<footer>" .
            "<div class='ft-service'>";
        if ($this->metrik_block) {
            echo $this->metrika;
        }
        echo "</div><div class='ft-center'><hr><span>by Right Joint</span></div>" .
            "<div class='ft-right'>" .
            "</div>" .
            "</footer>" .
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
        global $request;

        $active_modal_menu_style = null;

        if ($this->active_modal_menu) {
            $active_modal_menu_style = "style='opacity: 1; visibility: visible'";
        }

        echo "<div class='modal menu' " . $active_modal_menu_style . ">" .
            "<div class='overlay' " . $active_modal_menu_style . "></div><div class='contentBlock-frame'>" .
            "<div class='contentBlock-center'><div class='modal-right'><div class='modal-close'></div>" .
            "</div><div class='modal-left'>" .
            "<div class='modal-line' style='position: relative; min-height: 3.8em' >" .
            "<div class='lang-panel mp'>" .
            "<a class='lang-cntrl ";
        if (JOINT_SITE_APP_LANG == "ru") {
            echo "active ";
        }
        echo "rus' href='/ru".JOINT_SITE_REQ_ROOT."' title='" . $this->lang_map->langpaneltextrus . "'><span>Рус</span></a>" .
            "<a class='lang-cntrl ";
        if (JOINT_SITE_APP_LANG == "en") {
            echo "active ";
        }
        echo "en' href='/en".JOINT_SITE_REQ_ROOT."' title='" . $this->lang_map->langpaneltexten . "'><span>En</span></a>" .
            "</div>" .
            "<div class='mm-htl'>";
        if(JOINT_SITE_APP_REF){
            $home_ref = JOINT_SITE_APP_REF;
        }else{
            $home_ref = "/";
        }
        echo "<a href='" . $home_ref . "' title='";
        if (!isset($request["routes"][1])) {
            echo $this->lang_map->modalmenu["ref_on_home_title"];
        } else {
            echo $this->lang_map->modalmenu["ref_home_title"];
        }
        echo "'>" .
            "<img src='/img/siteLogo/rightjoint-logo-150.png' alt='RJ-logo'>" .
            $this->lang_map->modalmenu["ref_home"] .
            "</a>" .
            "<p>" . $this->lang_map->modalmenu["home_descr"] . "</p>" .
            "</div>" .
            "</div>";

        $this->print_products_menu();

        echo "</div></div></div></div>";
    }

    function print_products_menu()
    {
        $menuStyle = "style='display: none'";
        $folded_style = "folded";

        $jointsite_menu = $this->print_menu_items("branches", "/products/jointsite", JOINT_SITE_APP_REF);

        if ($jointsite_menu["is_valid_path"]) {
            $menuStyle = null;
            $folded_style = null;
        }

        echo "<div class='modal-line prod'>".
            "<div class='modal-line-img'><img src='/img/popimg/internet.png'></div>".
            "<div class='modal-line-text'><a class='m-l-blue' href='".JOINT_SITE_APP_REF."/products/jointsite' ".
            "title='".$this->lang_map->prod_titles_in_menu["jointSite"]["title"]."'>".
            $this->lang_map->prod_titles_in_menu["jointSite"]["text"]."</a><sup>".
            $this->lang_map->prod_titles_in_menu["jointSite"]["sup"]."</sup>".
            "<span class='opnSubMenu ".$folded_style."'>".$this->lang_map->prod_titles_in_menu["jointSite"]["ddm_text"]."</span>".
            "<ul " . $menuStyle . ">".
            $jointsite_menu["text"].
            "</ul>" .
            "</div>" .
            "</div>";
    }

    function print_menu_items($block_name, $disp_url = null, $disp_lang = null)
    {
        global $request;
        $disp_url_ref = $disp_lang.$disp_url;
        $disp_url_exp = explode("/", $disp_url);
        $disp_url_count = count($disp_url_exp);

        $return = array(
            "is_valid_path" => false,
            "text" => null,
        );

        foreach ($disp_url_exp as $n => $disp_path ){
            if(isset($request["routes"][$n]) and $disp_path == $request["routes"][$n]){
                $return["is_valid_path"] = true;
            }else{
                $return["is_valid_path"] = false;
            }
        }

        foreach ($this->lang_map->menu_blocks[$block_name]["menu_items"] as $url_item => $item_info){
            if(isset($item_info["use_in_mm"]) and $item_info["use_in_mm"] == true){
                $return["text"] .= "<li><a href='" . $disp_url_ref . "/" . $url_item . "' class='sub-lnk light ";
                if (isset($request["routes"][$disp_url_count]) and
                    (($request["routes"][$disp_url_count] ==  $url_item) and $return["is_valid_path"])) {
                    $return["text"] .= "active";
                }
                $return["text"] .= "' title='" . $item_info["altText"] . "'>" . $item_info["aliasMenu"] . "</a></li>";
            }
        }
        return $return;
    }
}