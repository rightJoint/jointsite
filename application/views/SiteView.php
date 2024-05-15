<?php
class SiteView extends View
{
    public $shortcut_icon = JOINT_SITE_EXEC_DIR . "/img/siteLogo/favicon.png";
    public $logo = JOINT_SITE_EXEC_DIR . "/img/popimg/menu-icon.png";

    public $view_data = null;

    public $styles = array(
        JOINT_SITE_EXEC_DIR . "/css/default.css",
        JOINT_SITE_EXEC_DIR . "/css/header.css",
    );

    public $scripts = array(
        JOINT_SITE_EXEC_DIR . "/lib/js/googleapis.js",
        JOINT_SITE_EXEC_DIR . "/js/header.js",
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
            "img" => JOINT_SITE_EXEC_DIR . "/img/siteLogo/rightjoint-logo-400.png",
        ),
    );

    public $admin_urls = array("/admin", "/test/admin");

    function __construct()
    {
        global $request;
        $lang_class = $this->LoadViewLang($request);
        $this->lang_map = new $lang_class;
    }

    function LoadViewLang($request = null)
    {
        require_once($_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR .
            "/application/lang_files/views/lang_view_" . $_SESSION[JS_SAIK]["lang"] . ".php");
        $return_lang = "lang_view_" . $_SESSION[JS_SAIK]["lang"];

        if (!$request) {
            global $request;
        }


        if (!empty($request["routes"][$request["exec_dir_cnt"]])) {
            $try_name = "lang_view_" . $request["routes"][$request["exec_dir_cnt"]] . "_" . $_SESSION[JS_SAIK]["lang"];
            $try_path = $_SERVER["DOCUMENT_ROOT"] . $request["exec_path"] . "/application/lang_files/views/" . strtolower($try_name) . '.php';
            if (file_exists($try_path)) {
                require_once($try_path);
                $return_lang = $try_name;
            }
            if (!empty($request["routes"][$request["exec_dir_cnt"] + 1])) {
                $try_name = "lang_view_" . $request["routes"][$request["exec_dir_cnt"]] . "_" .
                    $request["routes"][$request["exec_dir_cnt"] + 1] . "_" . $_SESSION[JS_SAIK]["lang"];
                $try_path = $_SERVER["DOCUMENT_ROOT"] . $request["exec_path"] . "/application/lang_files/views/" . strtolower($try_name) . '.php';

                if (file_exists($try_path)) {
                    require_once($try_path);
                    $return_lang = $try_name;
                }
            }
        } else {
            $try_name = "lang_view_main_" . $_SESSION[JS_SAIK]["lang"];

            $try_path = $_SERVER["DOCUMENT_ROOT"] . $request["exec_path"] . "/application/lang_files/views/" . strtolower($try_name) . '.php';
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
        $this->set_head_array();
        if ($this->metrik_block) {
            if (file_exists(JOINT_SITE_CONF_DIR . "/yandexmetrika.php")) {
                require_once JOINT_SITE_CONF_DIR . "/yandexmetrika.php";
                $this->metrika = $yandex_metrika;
                $this->yandex_verification = $yandex_verification;
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
        echo "<script>var exec_dir='" . JOINT_SITE_EXEC_DIR . "';</script>";
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
        echo "<header><div class='headerCenter'>";
        echo "<div class='lang-panel'>" .
            "<a class='lang-cntrl ";
        if ($_SESSION[JS_SAIK]["lang"] == "rus") {
            echo "active ";
        }
        echo "rus' href='?lang=rus' title='" . $this->lang_map->langpaneltextrus . "'><span>Рус</span></a>" .
            "<a class='lang-cntrl ";
        if ($_SESSION[JS_SAIK]["lang"] == "en") {
            echo "active ";
        }
        echo "en' href='?lang=en' title='" . $this->lang_map->lang_panel_text_en . "'><span>En</span></a>" .
            "</div>";
        echo "<div class='menuBtn hi-icon-effect-1 hi-icon-effect-1a'>" .
            "<span class='hi-icon hi-icon-mobile menu'><span class='hi-text'>" .
            $this->lang_map->head["menu-btn-text"] .
            "</span></span></div>" .
            "<div class='h-caption'>" .
            "<div class='textBlock ";
        global $routes;
        if (!$routes[1]) {
            echo "landing";
        }
        echo "'><span class='firmName'>" . $this->lang_map->head["header_text"] . "</span>" .
            "<h1>" . $this->lang_map->head["h1"] . "</h1></div></div>" .
            "</div></header>";

        $header_add_styles = "<style>
        .hi-icon-mobile.menu:before {background-image: url(" . $this->logo . ");}
        .modal-right .modal-close{
                background-image: url('" . JOINT_SITE_EXEC_DIR . "/img/popimg/closeModal.png');
            }
            @media only screen and (max-width : 1024px) and (orientation : portrait){
            .modal-right:not(.signIn) .modal-close:not(.signIn){
                    background-image: url('" . JOINT_SITE_EXEC_DIR . "/img/popimg/closeModal-white.png');
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
        if ($_SESSION[JS_SAIK]["lang"] == "rus") {
            echo "active ";
        }
        echo "rus' href='?lang=rus' title='" . $this->lang_map->langpaneltextrus . "'><span>Рус</span></a>" .
            "<a class='lang-cntrl ";
        if ($_SESSION[JS_SAIK]["lang"] == "en") {
            echo "active ";
        }
        echo "en' href='?lang=en' title='" . $this->lang_map->langpaneltexten . "'><span>En</span></a>" .
            "</div>" .
            "<div class='mm-htl'>";
        $home_ref = "/";
        if (JOINT_SITE_EXEC_DIR) {
            $home_ref = JOINT_SITE_EXEC_DIR;
        }
        echo "<a href='" . $home_ref . "' title='";
        if (!$request["routes"][$request["exec_dir_cnt"]]) {
            echo $this->lang_map->modalmenu["ref_on_home_title"];
        } else {
            echo $this->lang_map->modalmenu["ref_home_title"];
        }
        echo "'>" .
            "<img src='" . JOINT_SITE_EXEC_DIR . "/img/siteLogo/rightjoint-logo-150.png' alt='RJ-logo'>" .
            $this->lang_map->modalmenu["ref_home"] .
            "</a>" .
            "<p>" . $this->lang_map->modalmenu["home_descr"] . "</p>" .
            "</div>" .
            "</div>";

        $this->print_products_menu();

        $this->print_admin_menu();

        echo "</div></div></div></div>";
    }

    function print_products_menu()
    {
        global $request;
        $menuStyle = "style='display: none'";
        $folded_style = "folded";
        if ($request["routes"][$request["exec_dir_cnt"]] == "products" and
            $request["routes"][$request["exec_dir_cnt"] + 1] == "jointsite") {
            $menuStyle = null;
            $folded_style = null;
        }
        echo "<div class='modal-line prod'>" .
            "<div class='modal-line-img'><img src='" . JOINT_SITE_EXEC_DIR . "/img/popimg/internet.png'></div>" .
            "<div class='modal-line-text'><a class='m-l-blue' href='" . JOINT_SITE_EXEC_DIR . "/products/jointsite'>Web site</a><sup>php, js, mvc</sup>" .
            "<span class='opnSubMenu " . $folded_style . "'>product</span>" .
            "<ul " . $menuStyle . ">";
        foreach ($this->branches as $b_name => $b_info) {
            echo "<li><a href='" . JOINT_SITE_EXEC_DIR . "/products/jointsite/" . $b_name . "' class='sub-lnk light ";
            if ($request["routes"][$request["exec_dir_cnt"] + 2] == $b_name) {
                echo "active";
            }
            echo "' title='" . $mod_opt["altText"] . "'>" . $this->lang_map->branchesList[$b_name]["title"] . "</a></li>";
        }

        echo "</ul>" .
            "</div>" .
            "</div>";
    }

    public function print_admin_menu()
    {

        foreach ($this->admin_urls as $admin_url){
            echo $admin_url."<br>";
        }

        return true;

        global $routes;
        $default_admin_url = "admin";
        if (in_array($routes[1], $this->admin_urls)) {
            $default_admin_url = $routes[1];
            if (!$_SESSION["admin_user"]["id"]) {
                echo "<form class='auth-form admin' method='post'>" .
                    "<div class='modal-line'>" .
                    "<div class='modal-line-img'><img src='/img/popimg/admin-logo.png'></div>" .
                    "<div class='modal-line-text'><a class='m-l-blue title decnone' href='#'>" . $this->lang_map->adminblock["form_title"] .
                    "</a></div>" .
                    "</div>" .
                    "<div class='modal-line'>" .
                    "<div class='modal-line-text'><input type='text' name='login' value='";
                if ($_POST["login"]) {
                    echo $_POST["login"];
                }
                echo "' placeholder='" . $this->lang_map->adminblock["placeholder_login"] . "'>" . "</div>" .
                    "<div class='modal-line-img'><img src='/img/popimg/avatar-default.png'></div>" .
                    "</div>" .
                    "<div class='modal-line'>" .
                    "<div class='modal-line-text'>" .
                    "<input type='password' name='password' value='";
                if ($_POST["password"]) {
                    echo $_POST["password"];
                }
                echo "' placeholder='" . $this->lang_map->adminblock["placeholder_password"] . "'>" .
                    "</div>" .
                    "<div class='modal-line-img'><img src='/img/popimg/pass-img.png'></div>";
                if ($_SESSION["admin_user"]["auth_err"]) {
                    echo "<div class='modal-line-err'>" . $_SESSION["admin_user"]["auth_err"] . "</div>";
                }
                echo "</div>" .
                    "<div class='modal-line'>" .

                    "<div class='modal-line-text'>" .
                    "<input type='submit' name='auth_admin' value='" . $this->lang_map->adminblock["submit_btn"] . "'></div>" .
                    "<div class='modal-line-img'></div>" .
                    "</div>" .
                    "</form>";
            }
        }
        if ($_SESSION["admin_user"]["id"]) {
            echo "<div class='modal-line'>" .
                "<div class='modal-line-img'><img src='/img/popimg/avatar-default.png'></div>" .
                "<div class='modal-line-text'>Admin user: " . $_SESSION['admin_user']['id'] . "<sup><a href='/" . $routes[1] . "?cmd=exit'>Exit</sup></div>" .
                "</div>" .
                "<div class='modal-line'><div class='modal-line-img'>" .
                "<img src='/img/popimg/admin-logo.png' alt='admin-logo'></div>";

            $menuSign = "+";
            $menuStyle = "style='display: none'";

            echo "<div class='modal-line-text'>";

            global $routes;

            if ($routes[1] == $default_admin_url) {
                $menuSign = "-";
                $menuStyle = null;
            }
            echo "<a href='/" . $default_admin_url . "' title='php-mysql-admin'>Admin</a> " .
                "<span class='opnSubMenu'>" . $menuSign . "</span> " . "<ul " . $menuStyle . ">";

            foreach ($this->lang_map->adminblock["modules_list"] as $admin_mod => $mod_opt) {
                echo "<li><a href='/" . $default_admin_url . "/" . $admin_mod . "' class='sub-lnk light ";
                if ($routes[2] == $admin_mod) {
                    echo "active";
                }
                echo "' title='" . $mod_opt["altText"] . "'>" . $mod_opt["aliasMenu"] . "</a></li>";
            }
            echo "</ul></div></div>";

        }
    }
}