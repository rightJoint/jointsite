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
        "siteman" => array(
            "href" => "#",
            "img" => JOINT_SITE_EXEC_DIR . "/img/popimg/leverage.png",
        ),
        "main" => array(
            "href" => "#",
            "img" => JOINT_SITE_EXEC_DIR . "/img/siteLogo/rightjoint-logo-400.png",
        ),
        "record" => array(
            "href" => "#",
            "img" => JOINT_SITE_EXEC_DIR . "/img/popimg/record.png",
        ),
        "admin" => array(
            "href" => "#",
            "img" => JOINT_SITE_EXEC_DIR . "/img/popimg/admin-logo.png",
        ),
        "module" => array(
            "href" => "#",
            "img" => JOINT_SITE_EXEC_DIR."/img/popimg/module.png",
        ),
        "music" => array(
            "href" => "#",
            "img" => JOINT_SITE_EXEC_DIR."/img/popimg/music-logo.png",
        ),
    );

    public $admin_auth_err = null;

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
        if(isset($_SESSION[JS_SAIK]["site_user"]["user_id"])){
            include JOINT_SITE_CONF_DIR.
                "/modules/access_groups.php";
            require_once JOINT_SITE_CONF_DIR .
                "/modules/modules_list_" . $_SESSION[JS_SAIK]["lang"] . ".php";

            foreach ($module_access_groups as $module_name => $access_groups) {
                if (!$access_groups or $_SESSION[JS_SAIK]["site_user"]["is_admin"]) {
                    $this->lang_map->menu_blocks["modules_menu"]["menu_items"][$module_name] = $modules_list[$module_name];
                    $this->lang_map->menu_blocks["modules_menu"]["menu_items"][$module_name]["use_in_mm"] = true;
                }else{
                    $match_group = false;
                    if(isset($_SESSION[JS_SAIK]["site_user"]["groups"])){
                        foreach ($_SESSION[JS_SAIK]["site_user"]["groups"] as $group_id => $gr_access_riles){
                            if(in_array($group_id, $access_groups)){
                                $match_group = true;
                                break;
                            }
                        }
                        if($match_group){
                            $this->lang_map->menu_blocks["modules_menu"]["menu_items"][$module_name] = $modules_list[$module_name];
                            $this->lang_map->menu_blocks["modules_menu"]["menu_items"][$module_name]["use_in_mm"] = true;
                        }
                    }
                }
            }
        }
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

        /*rj-todo text block style on vertical screen, main branch*/
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

        if(isset($_SESSION[JS_SAIK]["site_user"])){
            echo "<div class='modal-line'>".
                "<div class='modal-line-img'><img src='";
            if(isset($_SESSION[JS_SAIK]["site_user"]["avatar"])){
                echo USERS_AVATARS_DIR."/".$_SESSION[JS_SAIK]["site_user"]["avatar"];
            }else{
                echo JOINT_SITE_EXEC_DIR."/img/popimg/avatar-default.png";
            }
            $user_link_add_class = null;
            $user_link_ref = "/user";
            if ($this->controller_action == "user") {
                $user_link_add_class = " decnone";
                $user_link_ref = "#";
            }

            echo "'></div>" .
                "<div class='modal-line-text'><a class='m-l-blue" . $user_link_add_class . "' href='" . JOINT_SITE_EXEC_DIR . $user_link_ref . "' " .
                "title='" . $this->lang_map->auth_menu_text["site"]["title"] . "'>" .
                $this->lang_map->auth_menu_text["site"]["siteUser"] . ":</a>" .
                $_SESSION[JS_SAIK]['site_user']['accAlias'] . "<sup><a href='" . JOINT_SITE_EXEC_DIR . "/user?cmd=exit'>" .
                $this->lang_map->auth_menu_text["site"]["exit"] . "</a></sup></div>" .
                "</div>";
        } else {
            $this->print_auth_forms();
        }

        $this->print_siteman_menu();

        $this->print_admin_menu("/admin");
        $this->print_music_menu();

        echo "</div></div></div></div>";
    }

    function print_auth_forms()
    {
        $this->print_signIn_form();
        $this->print_signUp_form("disp-none");
    }

    function print_signIn_form($add_form_class = null)
    {
        echo "<form class='auth-form signIn " . $add_form_class . "' method='post' action='" . JOINT_SITE_EXEC_DIR . "/user/signIn'>" .
            "<div class='modal-line'>" .
            "<div class='modal-line-img'><img src='" . JOINT_SITE_EXEC_DIR . "/img/popimg/user-logo.png'></div>" .
            "<div class='modal-line-text'>";
        //$this->print_social_buttons();
        echo "<a class='m-l-blue title decnone' id='siteSignIn' href='#'>" .
            $this->lang_map->sitesignInform["form_title"] .
            "</a>" .
            "</div>" .
            "</div>" .
            "<div class='modal-line'>" .
            "<div class='modal-line-text'><input type='text' name='login' value='";
        if(isset($_POST["login"])){
            echo $_POST["login"];
        }
        echo "' placeholder='" . $this->lang_map->sitesignInform["placeholder_login"] . "'>" . "</div>" .
            "<div class='modal-line-img'><img src='" . JOINT_SITE_EXEC_DIR . "/img/popimg/avatar-default.png'></div>" .
            "</div>" .
            "<div class='modal-line'>" .
            "<div class='modal-line-text'>" .
            "<input type='password' name='password' value='";
        if(isset($_POST["password"])){
            echo $_POST["password"];
        }
        echo "' placeholder='".$this->lang_map->sitesignInform["placeholder_password"]."'>".
            "</div>".
            "<div class='modal-line-img'><img src='".JOINT_SITE_EXEC_DIR."/img/popimg/pass-img.png'></div>";
        if (isset($this->alert_message) and $this->alert_message != null) {
            echo "<div class='modal-line-err'>" . $this->alert_message . "</div>";
        }
        echo "</div>";
        //if throwErr, thrown message

        echo "<div class='modal-line'>" .
            "<div class='modal-line-text'>" .
            "<a class='m-l-blue title' href='#siteSignUp'>" .
            $this->lang_map->sitesignUpform["form_title"] .
            "</a>" .
            "<input type='submit' name='auth_signIn' value='" . $this->lang_map->sitesignInform["submit_btn"] . "'></div>" .
            "<div class='modal-line-img'></div>" .
            "</div>" .
            "</form>";
    }

    function print_signUp_form($add_form_class = null, $signUp_err=array(
        "login_unacceptable" => false,
        "login_reserved" => false,
        "pass_unacceptable" => false,
        "pass_dont_match" => false,
        "email_unacceptable" => false,
    ))
    {
        echo "<form class='auth-form signUp " . $add_form_class . "' method='post' action='" . JOINT_SITE_EXEC_DIR . "/user/signUp'>" .
            "<div class='modal-line'>" .
            "<div class='modal-line-img'><img src='" . JOINT_SITE_EXEC_DIR . "/img/popimg/checkInNow.png'></div>" .
            "<div class='modal-line-text'>";
        //$this->print_social_buttons();
        echo "<a class='m-l-blue title decnone' href='#' id='siteSignUp'>" .
            $this->lang_map->sitesignUpform["form_title"] .
            "</a>" .
            "</div>" .
            "</div>" .
            "<div class='modal-line'>" .
            "<div class='modal-line-text'><input type='text' name='login' value='";
        if(isset($_POST["login"])){
            echo $_POST["login"];
        }
        echo "' placeholder='".$this->lang_map->sitesignUpform["placeholder_login"]."'>"."</div>".
            "<div class='modal-line-img'><img src='".JOINT_SITE_EXEC_DIR."/img/popimg/avatar-default.png'></div>";
        if($signUp_err["login_unacceptable"] == true){
            echo "<div class='modal-line-err'>".$this->lang_map->sitesignUpform["errors"]["login_unacceptable"]."</div>";
        }
        if($signUp_err["login_reserved"] == true){
            echo "<div class='modal-line-err'>".$this->lang_map->sitesignUpform["errors"]["login_reserved"]."</div>";
        }
        echo "</div>" .
            "<div class='modal-line'>" .
            "<div class='modal-line-text'>" .
            "<input type='password' name='password' value='";
        if(isset($_POST["password"])){
            echo $_POST["password"];
        }
        echo "' placeholder='".$this->lang_map->sitesignUpform["placeholder_password"]."'>".
            "</div>".
            "<div class='modal-line-img'><img src='".JOINT_SITE_EXEC_DIR."/img/popimg/pass-img.png'></div>";
        if(isset($signUp_err["pass_unacceptable"])){
            echo "<div class='modal-line-err'>".$this->lang_map->sitesignUpform["errors"]["pass_unacceptable"]."</div>";
        }
        echo "</div>" .
            "<div class='modal-line'>" .
            "<div class='modal-line-text'>" .
            "<input type='password' name='repeat_password' value='";
        if(isset($_POST["repeat_password"])){
            echo $_POST["repeat_password"];
        }
        echo "' placeholder='".$this->lang_map->sitesignUpform["placeholder_repeat"]."'>".
            "</div>".
            "<div class='modal-line-img'><img src='".JOINT_SITE_EXEC_DIR."/img/popimg/pass-img.png'></div>";
        if(isset($signUp_err["pass_dont_match"])){
            echo "<div class='modal-line-err'>".$this->lang_map->sitesignUpform["errors"]["pass_dont_match"]."</div>";
        }
        echo "</div>" .
            "<div class='modal-line'>" .
            "<div class='modal-line-text'>" .
            "<input type='email' name='email' value='";
        if(isset($_POST["email"])){
            echo $_POST["email"];
        }
        echo "' placeholder='".$this->lang_map->sitesignUpform["placeholder_mail"]."'>".
            "</div>".
            "<div class='modal-line-img'><img src='".JOINT_SITE_EXEC_DIR."/img/popimg/eMailLogo.png'></div>";
        if($signUp_err["email_unacceptable"] == true){
            echo "<div class='modal-line-err'>".$this->lang_map->sitesignUpform["errors"]["email_unacceptable"]."</div>";
        }
        echo "</div>" .
            "<div class='modal-line'>" .

            "<div class='modal-line-text'>" .
            "<a class='m-l-blue title' href='#siteSignIn'>" .
            $this->lang_map->sitesignInform["form_title"] .
            "</a>" .
            "<input type='submit' name='auth_signUp' value='" . $this->lang_map->sitesignUpform["submit_btn"] . "'></div>" .
            "<div class='modal-line-img'></div>" .
            "</div>" .
            "</form>";

    }

    function print_products_menu()
    {
        $menuStyle = "style='display: none'";
        $folded_style = "folded";

        $jointsite_menu = $this->print_menu_items("branches", "/products/jointsite");

        if ($jointsite_menu["is_valid_path"]) {
            $menuStyle = null;
            $folded_style = null;
        }

        echo "<div class='modal-line prod'>" .
            "<div class='modal-line-img'><img src='" . JOINT_SITE_EXEC_DIR . "/img/popimg/internet.png'></div>" .
            "<div class='modal-line-text'><a class='m-l-blue' href='" . JOINT_SITE_EXEC_DIR . "/products/jointsite' " .
            "title='" . $this->lang_map->prod_titles_in_menu["jointSite"]["title"] . "'>" .
            $this->lang_map->prod_titles_in_menu["jointSite"]["text"] . "</a><sup>" .
            $this->lang_map->prod_titles_in_menu["jointSite"]["sup"] . "</sup>" .
            "<span class='opnSubMenu " . $folded_style . "'>" . $this->lang_map->prod_titles_in_menu["jointSite"]["ddm_text"] . "</span>" .
            "<ul " . $menuStyle . ">" .
            $jointsite_menu["text"] .
            "</ul>" .
            "</div>" .
            "</div>";
    }

    function print_menu_items($block_name, $disp_url = null)
    {
        global $request;
        $disp_url = JOINT_SITE_EXEC_DIR . $disp_url;
        $disp_url_exp = explode("/", $disp_url);
        $disp_url_count = count($disp_url_exp);

        $return = array(
            "is_valid_path" => true,
            "text" => null,
        );

        foreach ($disp_url_exp as $n => $disp_path) {
            if ($disp_path != $request["routes"][$n]) {
                $return["is_valid_path"] = false;
                break;
            }
        }

        foreach ($this->lang_map->menu_blocks[$block_name]["menu_items"] as $url_item => $item_info){
            if(isset($item_info["use_in_mm"]) and $item_info["use_in_mm"] == true){
                $return["text"] .= "<li><a href='" . $disp_url . "/" . $url_item . "' class='sub-lnk light ";
                if (isset($request["routes"][$disp_url_count]) and
                    (($request["routes"][$disp_url_count] ==  $url_item) and $return["is_valid_path"])) {
                    $return["text"] .= "active";
                }
                $return["text"] .= "' title='" . $item_info["altText"] . "'>" . $item_info["aliasMenu"] . "</a></li>";
            }
        }
        return $return;
    }


    function print_siteman_menu($siteman_url = "/siteman")
    {
        if(isset($this->lang_map->menu_blocks["modules_menu"]["menu_items"])){
            $menuStyle = "style='display: none'";
            $folded_style = "folded";

            $siteman_menu_items = $this->print_menu_items("modules_menu", $siteman_url);

            if ($siteman_menu_items["is_valid_path"]) {
                $menuStyle = null;
                $folded_style = null;
            }

            echo "<div class='modal-line prod'>".
                "<div class='modal-line-img'><img src='".JOINT_SITE_EXEC_DIR."/img/popimg/leverage.png'></div>".
                "<div class='modal-line-text'><a class='m-l-blue' href='".JOINT_SITE_EXEC_DIR.$siteman_url."' ".
                "title='".$this->lang_map->prod_titles_in_menu["siteman"]["title"]."'>".
                $this->lang_map->prod_titles_in_menu["siteman"]["text"]."</a><sup>".
                $this->lang_map->prod_titles_in_menu["siteman"]["sup"]."</sup>".
                "<span class='opnSubMenu ".$folded_style."'>".$this->lang_map->prod_titles_in_menu["siteman"]["ddm_text"]."</span>".
                "<ul " . $menuStyle . ">".
                $siteman_menu_items["text"].
                "</ul>" .
                "</div>" .
                "</div>";
        }
    }

    public function print_admin_menu($admin_url = "/admin")
    {
        $admin_menu = $this->print_menu_items("admin", $admin_url);
        if (!isset($_SESSION[JS_SAIK]["admin_user"]["id"]) and $admin_menu["is_valid_path"]) {
            echo "<form class='auth-form admin' method='post'>" .
                "<div class='modal-line'>" .
                "<div class='modal-line-img'><img src='" . JOINT_SITE_EXEC_DIR . "/img/popimg/admin-logo.png'></div>" .
                "<div class='modal-line-text'><a class='m-l-blue title decnone' href='#'>" . $this->lang_map->adminblock["form_title"] .
                "</a></div>" .
                "</div>" .
                "<div class='modal-line'>" .
                "<div class='modal-line-text'><input type='text' name='login' value='";
            if (isset($_POST["login"])) {
                echo $_POST["login"];
            }
            echo "' placeholder='" . $this->lang_map->adminblock["placeholder_login"] . "'>" . "</div>" .
                "<div class='modal-line-img'><img src='" . JOINT_SITE_EXEC_DIR . "/img/popimg/avatar-default.png'></div>" .
                "</div>" .
                "<div class='modal-line'>" .
                "<div class='modal-line-text'>" .
                "<input type='password' name='password' value='";
            if (isset($_POST["password"])) {
                echo $_POST["password"];
            }
            echo "' placeholder='" . $this->lang_map->adminblock["placeholder_password"] . "'>" .
                "</div>" .
                "<div class='modal-line-img'><img src='" . JOINT_SITE_EXEC_DIR . "/img/popimg/pass-img.png'></div>";
            if ($this->admin_auth_err) {
                echo "<div class='modal-line-err'>" . $this->admin_auth_err . "</div>";
            }
            //if throwErr, thrown message
            if ($this->alert_message) {
                echo "<div class='modal-line-err'>" . $this->alert_message . "</div>";
            }
            echo "</div>" .
                "<div class='modal-line'>" .
                "<div class='modal-line-text'>" .
                "<input type='submit' name='auth_admin' value='" . $this->lang_map->adminblock["submit_btn"] . "'></div>" .
                "<div class='modal-line-img'></div>" .
                "</div>" .
                "</form>";
        }

        if (isset($_SESSION[JS_SAIK]["admin_user"]["id"])) {
            echo "<div class='modal-line'>" .
                "<div class='modal-line-img'><img src='" . JOINT_SITE_EXEC_DIR . "/img/popimg/avatar-default.png'></div>" .
                "<div class='modal-line-text'>" . $this->lang_map->auth_menu_text["admin"]["adminUser"] . ": " . $_SESSION[JS_SAIK]['admin_user']['id'] . "<sup>" .
                "<a href='" . JOINT_SITE_EXEC_DIR . $admin_url . "?cmd=exit'>" . $this->lang_map->auth_menu_text["admin"]["exit"] . "</sup></div>" .
                "</div>";

            //$admin_menu = $this->print_menu_items("admin", $admin_url);

            $menuStyle = "style='display: none'";
            $folded_style = "folded";

            if ($admin_menu["is_valid_path"]) {
                $menuStyle = null;
                $folded_style = null;
            }

            echo "<div class='modal-line prod'>" .
                "<div class='modal-line-img'><img src='" . JOINT_SITE_EXEC_DIR . "/img/popimg/admin-logo.png'></div>" .
                "<div class='modal-line-text'><a class='m-l-blue' href='" . JOINT_SITE_EXEC_DIR . $admin_url . "' " .
                "title='" . $this->lang_map->prod_titles_in_menu["admin"]["title"] . "'>" .
                $this->lang_map->prod_titles_in_menu["admin"]["text"] . "</a><sup>" .
                $this->lang_map->prod_titles_in_menu["admin"]["sup"] . "</sup>" .
                "<span class='opnSubMenu " . $folded_style . "'>" . $this->lang_map->prod_titles_in_menu["admin"]["ddm_text"] . "</span>" .
                "<ul " . $menuStyle . ">" .
                $admin_menu["text"] .
                "</ul>" .
                "</div>" .
                "</div>";
        }
    }
    function print_music_menu()
    {
        echo "<div class='modal-line'>".
            "<div class='modal-line-img'><img src='".JOINT_SITE_EXEC_DIR."/img/popimg/music-logo.png'></div>".
            "<div class='modal-line-text'><a class='m-l-blue' href='".JOINT_SITE_EXEC_DIR."/music/album/my-fav-music' ".
            "title='".$this->lang_map->musicmenu["link_title"]."'>".
            $this->lang_map->musicmenu["link_text"].
            "</a></div>".
            "</div>";
    }
}