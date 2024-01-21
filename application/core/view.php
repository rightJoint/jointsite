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
        "site-signIn-form" => array(
            "form_title" => array(
                "en" => "Sign in",
                "rus" => "Вход на сайт"
            ),
            "placeholder_login" => array(
                "en" => "Your login...",
                "rus" => "Ваш логин...",
            ),
            "placeholder_password" => array(
                "en" => "Enter Your password...",
                "rus" => "введите пароль...",
            ),

            "submit_btn" => array(
                "en" => "Submit",
                "rus" => "Войти",
            ),
            "errors" => array(
                "wrong_login_or_pass" => array(
                    "en" => "wrong login or password",
                    "rus" => "неправильный логин или пароль",
                ),
                "user_in_black_list" => array(
                    "en" => "user in black list",
                    "rus" => "Пользователь заблокирован",
                ),
                "email_not_validated" => array(
                    "en" => "email not validated",
                    "rus" => "email не подтвержден",
                ),
            ),
        ),
        "site-signUp-form" => array(
            "form_title" => array(
                "en" => "Sign up",
                "rus" => "Регистрация на сайте",
            ),
            "placeholder_login" => array(
                "en" => "Make up login...",
                "rus" => "Придумайте логин...",
            ),
            "placeholder_password" => array(
                "en" => "password...",
                "rus" => "пароль...",
            ),
            "placeholder_repeat" => array(
                "en" => "repeat password...",
                "rus" => "повторите пароль...",
            ),
            "placeholder_mail" => array(
                "en" => "your email...",
                "rus" => "Ваш email...",
            ),
            "submit_btn" => array(
                "en" => "Register now",
                "rus" => "Зарегистрировать",
            ),
            "errors" => array(
                "login_unacceptable" => array(
                    "en" => "login unacceptable",
                    "rus" => "недопустимый логин",
                ),
                "login_reserved" => array(
                    "en" => "login reserved",
                    "rus" => "логин зарезервирован",
                ),
                "pass_unacceptable" => array(
                    "en" => "password unacceptable",
                    "rus" => "недопустимый пароль",
                ),
                "pass_dont_match" => array(
                    "en" => "passwords dont match",
                    "rus" => "пароль не совпадают",
                ),
                "email_unacceptable" => array(
                    "en" => "email unacceptable",
                    "rus" => "недопустимый email",
                ),
            ),
        ),
        "sitemanmenu" => array(
            "ref-text" => array(
                "en" => "Siteman",
                "rus" => "Управление сайтом",
            ),
            "ref-title" => array(
                "en" => "Manage content on site",
                "rus" => "Управление контентом на сайте",
            ),
        ),
    );

    function __construct()
    {

    }

    function set_head_array()
    {

    }

    function generate()
    {
        $this->set_head_array();

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

        if($_SESSION["site_user"]){
            echo "<div class='modal-line'>".
                "<div class='modal-line-img'><img src='";
            if($_SESSION["site_user"]["avatar"]){
                echo USERS_AVATARS_DIR."/".$_SESSION["site_user"]["avatar"];
            }else{
                echo "/img/popimg/avatar-default.png";
            }
            $user_link_add_class = null;
            $user_link_ref = "/user";
            if($routes[1] == "user" and $routes[2] != "signIn"){
                $user_link_add_class = " decnone";
                $user_link_ref = "#";
            }

            echo "'></div>".
                "<div class='modal-line-text'><a class='m-l-blue".$user_link_add_class."' href='".$user_link_ref."' title='personal page'>Site user:</a>".
                $_SESSION['site_user']['accAlias']."<sup><a href='/user?cmd=exit'>Exit</a></sup></div>".
                "</div>";
        }else{
            $this->print_auth_forms();
        }

        $this->print_siteman_menu();

        echo "</div></div></div></div>";
    }

    public function print_siteman_menu()
    {

        global $routes;

        require_once "application/core/Module/ModuleMenu.php";

        if($siteman_menu = moduleMenu::sitemanMenuAccess()){

            echo "<div class='modal-line'><div class='modal-line-img'>".
                "<img src='/img/popimg/leverage.png' alt='admin-logo'></div>";

            $menuSign = "+";
            $menuStyle = "style='display: none'";

            echo "<div class='modal-line-text'>";

            if ($routes[1] == "siteman") {
                $menuSign = "-";
                $menuStyle = null;
            }

            $list_menu = null;

            foreach ($siteman_menu as $mUrl => $mOpt){
                $list_menu.= "<li><a href='/" . $mUrl . "' class='sub-lnk light ";
                if ($mOpt["active"]) {
                    $list_menu.= "active";
                }
                $list_menu.= "' title='".$mOpt["mAliases"][$_SESSION["lang"]]."'>" . $mOpt["mAlias"] . "</a></li>";
            }

            echo "<a href='/siteman' title='".$this->lang_map["sitemanmenu"]["ref-title"][$_SESSION["lang"]]."'>".$this->lang_map["sitemanmenu"]["ref-text"][$_SESSION["lang"]]."</a> ".
                "<span class='opnSubMenu'>" . $menuSign . "</span> "."<ul " . $menuStyle . ">".
                $list_menu."</ul></div></div>";
        }
    }

    function print_auth_forms()
    {
        $this->print_signIn_form();
        $this->print_signUp_form("disp-none");
    }

    function print_signIn_form($add_form_class = null, $signIn_err=null)
    {
        echo "<form class='auth-form signIn ".$add_form_class."' method='post' action='/user/signIn'>".
            "<div class='modal-line'>".
            "<div class='modal-line-img'><img src='/img/popimg/user-logo.png'></div>".
            "<div class='modal-line-text'>".
            "<a class='m-l-blue title decnone' id='siteSignIn' href='#'>".
            $this->lang_map["site-signIn-form"]["form_title"][$_SESSION["lang"]].
            "</a>".
            "</div>".
            "</div>".
            "<div class='modal-line'>".
            "<div class='modal-line-text'><input type='text' name='login' value='";
        if($_POST["login"]){
            echo $_POST["login"];
        }
        echo "' placeholder='".$this->lang_map["site-signIn-form"]["placeholder_login"][$_SESSION["lang"]]."'>"."</div>".
            "<div class='modal-line-img'><img src='/img/popimg/avatar-default.png'></div>".
            "</div>".
            "<div class='modal-line'>".
            "<div class='modal-line-text'>".
            "<input type='password' name='password' value='";
        if($_POST["password"]){
            echo $_POST["password"];
        }
        echo "' placeholder='".$this->lang_map["site-signIn-form"]["placeholder_password"][$_SESSION["lang"]]."'>".
            "</div>".
            "<div class='modal-line-img'><img src='/img/popimg/pass-img.png'></div>";
        foreach ($this->lang_map["site-signIn-form"]["errors"] as $err_k => $err_v){
            if($signIn_err[$err_k]){
                echo "<div class='modal-line-err'>".
                    $err_v[$_SESSION["lang"]]."</div>";
            }
        }
        echo "</div>".
            "<div class='modal-line'>" .
            "<div class='modal-line-text'>".
            "<a class='m-l-blue title' href='#siteSignUp'>".
            $this->lang_map["site-signUp-form"]["form_title"][$_SESSION["lang"]].
            "</a>".
            "<input type='submit' name='auth_signIn' value='".$this->lang_map["site-signIn-form"]["submit_btn"][$_SESSION["lang"]]."'></div>" .
            "<div class='modal-line-img'></div>" .
            "</div>".
            "</form>";
    }

    function print_signUp_form($add_form_class = null, $signUp_err=null)
    {
        echo "<form class='auth-form signUp ".$add_form_class."' method='post' action='/user/signUp'>".
            "<div class='modal-line'>".
            "<div class='modal-line-img'><img src='/img/popimg/checkInNow.png'></div>".
            "<div class='modal-line-text'>".
            "<a class='m-l-blue title decnone' href='#' id='siteSignUp'>".
            $this->lang_map["site-signUp-form"]["form_title"][$_SESSION["lang"]].
            "</a>".
            "</div>".
            "</div>".
            "<div class='modal-line'>".
            "<div class='modal-line-text'><input type='text' name='login' value='";
        if($_POST["login"]){
            echo $_POST["login"];
        }
        echo "' placeholder='".$this->lang_map["site-signUp-form"]["placeholder_login"][$_SESSION["lang"]]."'>"."</div>".
            "<div class='modal-line-img'><img src='/img/popimg/avatar-default.png'></div>";
        if($signUp_err["login_unacceptable"]){
            echo "<div class='modal-line-err'>".$this->lang_map["site-signUp-form"]["errors"]["login_unacceptable"][$_SESSION["lang"]]."</div>";
        }
        if($signUp_err["login_reserved"]){
            echo "<div class='modal-line-err'>".$this->lang_map["site-signUp-form"]["errors"]["login_reserved"][$_SESSION["lang"]]."</div>";
        }
        echo    "</div>".
            "<div class='modal-line'>".
            "<div class='modal-line-text'>".
            "<input type='password' name='password' value='";
        if($_POST["password"]){
            echo $_POST["password"];
        }
        echo "' placeholder='".$this->lang_map["site-signUp-form"]["placeholder_password"][$_SESSION["lang"]]."'>".
            "</div>".
            "<div class='modal-line-img'><img src='/img/popimg/pass-img.png'></div>";
        if($signUp_err["pass_unacceptable"]){
            echo "<div class='modal-line-err'>".$this->lang_map["site-signUp-form"]["errors"]["pass_unacceptable"][$_SESSION["lang"]]."</div>";
        }
        echo "</div>".
            "<div class='modal-line'>".
            "<div class='modal-line-text'>".
            "<input type='password' name='repeat_password' value='";
        if($_POST["repeat_password"]){
            echo $_POST["repeat_password"];
        }
        echo "' placeholder='".$this->lang_map["site-signUp-form"]["placeholder_repeat"][$_SESSION["lang"]]."'>".
            "</div>".
            "<div class='modal-line-img'><img src='/img/popimg/pass-img.png'></div>";
        if($signUp_err["pass_dont_match"]){
            echo "<div class='modal-line-err'>".$this->lang_map["site-signUp-form"]["errors"]["pass_dont_match"][$_SESSION["lang"]]."</div>";
        }
        echo "</div>".
            "<div class='modal-line'>".
            "<div class='modal-line-text'>".
            "<input type='email' name='email' value='";
        if($_POST["email"]){
            echo $_POST["email"];
        }
        echo "' placeholder='".$this->lang_map["site-signUp-form"]["placeholder_mail"][$_SESSION["lang"]]."'>".
            "</div>".
            "<div class='modal-line-img'><img src='/img/popimg/eMailLogo.png'></div>";
        if($signUp_err["email_unacceptable"]){
            echo "<div class='modal-line-err'>".$this->lang_map["site-signUp-form"]["errors"]["email_unacceptable"][$_SESSION["lang"]]."</div>";
        }
        echo "</div>".
            "<div class='modal-line'>" .

            "<div class='modal-line-text'>".
            "<a class='m-l-blue title' href='#siteSignIn'>".
            $this->lang_map["site-signIn-form"]["form_title"][$_SESSION["lang"]].
            "</a>".
            "<input type='submit' name='auth_signUp' value='".$this->lang_map["site-signUp-form"]["submit_btn"][$_SESSION["lang"]]."'></div>" .
            "<div class='modal-line-img'></div>" .
            "</div>".
            "</form>";

    }

    function generateJson($data)
    {
        echo json_encode($data, true);
    }
}