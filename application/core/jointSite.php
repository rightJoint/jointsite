<?php
class jointSite
{
    //public static $lang_map;
    public $app_log;

    static function jointSiteRun($JOINT_SITE_EXEC_DIR=null, $DOCUMENT_ROOT = null, $REQUEST_URI = null)
    {


        global $request;
        /*
        run site on /mirror

        $JOINT_SITE_EXEC_DIR = "/mirror",
        $_SERVER["DOCUMENT_ROOT"] = "",
        $_SERVER["REQUEST_URI"] = "/mirror/ru/test/phpmysqladmin/printquery?test=1111"

         * global request =
Array
(
    [routes_uri] => /mirror/ru/test/phpmysqladmin/printquery?test=1111      uri with get request, its $_SERVER["REQUEST_URI"]
    [routes_path] => /mirror/ru/test/phpmysqladmin/printquery               no get request in $_SERVER[REQUEST_URI]
    [routes] => Array
        (
            [0] =>                                                          always zero
            [1] => mirror
            [2] => test
            [3] => phpmysqladmin
            [4] => printquery
        )

    [exec_dir] => Array
        (
            [0] =>
            [1] => mirror
        )

    [routes_cnt] => 5                                                       count(routes)
    [exec_path] => /mirror                                                  its $JOINT_SITE_EXEC_DIR = /mirror
    [exec_dir_cnt] => 2                                                     CASE: 1 in root, 2 on mirror
    [diff_cnt] => 4
)

        define constants:
        JOINT_SITE_EXEC_DIR                                                 $JOINT_SITE_EXEC_DIR = /mirror
        JOINT_SITE_REQUIRE_DIR                                              its $_SERVER["DOCUMENT_ROOT"]
                                                                            C:/OSPanel/domains/rj-test.local/mirror
        JOINT_SITE_REQ_LANG                                                 shortcut for lang_file C:/OSPanel/domains/rj-test.local/mirror/application/lang_files/ru
        JOINT_SITE_APP_LANG                                                 ru or en
        JOINT_SITE_APP_REF                                                  null, /ru or /en
        JOINT_SITE_REQ_ROOT                                                 it routes_uri cut of lang uri to process logic
                                                                            /mirror/test/phpmysqladmin/printquery?test=1111

        JS_SAIK                                                             main or mirror

         */
        self::set_app_envir($JOINT_SITE_EXEC_DIR, $DOCUMENT_ROOT, $REQUEST_URI);

        if(!self::checkAppDir()) {
            $request_exec_dir = array(
                "en" => "Application error: rout not compatible JOINT_SITE_EXEC_DIR",
                "rus" => "Ошибка приложения: Маршрут не соответствует конфигурации",
            );
            echo $request_exec_dir[JOINT_SITE_APP_LANG]." (route: ".$request["routes_path"].", EXEC_DIR: ".$request["exec_path"].")";
            exit;
        }

        ;

        /*
         * define constants JOINT_SITE_CONF_DIR = "C:/OSPanel/domains/rj-test.local/mirror/__config";
         */
        self::get_config_dir();

        /*
         * options default model, view
         */
        self::set_app_config();

        $loaded_controller = self::loadControllerFromRequest();
        $loaded_model = self::loadModelFromRequest();
        $loaded_view = self::loadViewFromRequest();
        $app_log["action"] = $action_name = self::getActionFromRequest();



        //echo JOINT_SITE_REQUIRE_DIR;
        //exit;

        //define("JOINT_SITE_CONF_DIR", $_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/__config");
        //require_once JOINT_SITE_CONF_DIR."/dir_const.php";
        //require_once JOINT_SITE_APP_CONFIG;

        //echo JOINT_SITE_EXEC_DIR." / ".JOINT_SITE_REQUIRE_DIR." / ".JOINT_SITE_REQ_LANG." / ".JOINT_SITE_APP_LANG." / ".JOINT_SITE_APP_REF." / ".JOINT_SITE_REQ_ROOT;
        //echo "<pre>";
        //print_r($request);
        //exit;

        //echo "<pre>";
        //print_r($request);
        //exit;
    }

    static function set_app_envir($JOINT_SITE_EXEC_DIR, $DOCUMENT_ROOT, $REQUEST_URI)
    {
        global $mct;
        $mct['start_time'] = microtime(true);

        self::prepare_request($JOINT_SITE_EXEC_DIR, $DOCUMENT_ROOT, $REQUEST_URI);
        self::prepare_app_lang();
        self::prepare_session_key();
        self::load_app_lang();
    }

    static function prepare_request($JOINT_SITE_EXEC_DIR=null, $DOCUMENT_ROOT = null, $REQUEST_URI = null)
    {
        define("JOINT_SITE_EXEC_DIR", $JOINT_SITE_EXEC_DIR);

        define("JOINT_SITE_REQUIRE_DIR", $DOCUMENT_ROOT.$JOINT_SITE_EXEC_DIR);
        global $request;
        $request["routes_uri"] = $REQUEST_URI;
        $request["routes_path"] = explode('?', $request["routes_uri"])[0];
        $request["routes"] = explode('/', $request["routes_path"]);

        if(JOINT_SITE_EXEC_DIR != null and JOINT_SITE_EXEC_DIR != ""){
            $request["exec_dir"] = explode('/', JOINT_SITE_EXEC_DIR);
        }else{
            $request["exec_dir"] = array(0 => "");
        }

        $request["routes_cnt"] = count($request["routes"]);
        $request["exec_path"] = JOINT_SITE_EXEC_DIR;
        $request["exec_dir_cnt"] = count($request["exec_dir"]);
        $request["diff_cnt"] = $request["routes_cnt"] - $request["exec_dir_cnt"];
    }

    static function prepare_app_lang($acceptable_lang = array("en", "ru", ))
    {
        global $request;
        if(isset($request["routes"][$request["exec_dir_cnt"]]) and
            in_array($request["routes"][$request["exec_dir_cnt"]], $acceptable_lang)){
            define("JOINT_SITE_REQ_LANG", JOINT_SITE_REQUIRE_DIR."/application/lang_files/".$request["routes"][$request["exec_dir_cnt"]]);
            define("JOINT_SITE_APP_LANG", $request["routes"][$request["exec_dir_cnt"]]);
            define("JOINT_SITE_APP_REF", "/".JOINT_SITE_APP_LANG);
            $pos_lang = strpos($request["routes_uri"], JOINT_SITE_APP_REF);
            define("JOINT_SITE_REQ_ROOT",
                substr($request["routes_uri"], 0,
                    $pos_lang)
                .substr($request["routes_uri"], $pos_lang+1 + strlen(JOINT_SITE_APP_LANG),
                    strlen($request["routes_uri"])));
            unset($request["routes"][$request["exec_dir_cnt"]]);
            $request["routes"] = array_values($request["routes"]);
            $request["routes_cnt"] --;

        }else{
            /*default lang: ru */
            define("JOINT_SITE_REQ_LANG", JOINT_SITE_REQUIRE_DIR."/application/lang_files/ru");
            define("JOINT_SITE_APP_LANG", "ru");
            define("JOINT_SITE_REQ_ROOT", substr($request["routes_uri"], 0,
                strlen($request["routes_uri"])));
            define("JOINT_SITE_APP_REF", null);
        }
    }

    //session app instance key at host
    static function prepare_session_key()
    {
        session_start();
        global $request;
        $s_key = null;
        if(JOINT_SITE_EXEC_DIR){
            for ($c = 0; $c<$request["exec_dir_cnt"]; $c++){
                $s_key .= $request["exec_dir"][$c];
            }
        }else{
            $s_key = "main";
        }
        define("JS_SAIK", $s_key);
    }

    static function get_config_dir()
    {
        define("JOINT_SITE_CONF_DIR", JOINT_SITE_REQUIRE_DIR."/".trim(file_get_contents(JOINT_SITE_REQUIRE_DIR."/app_config_dir.txt")));
    }

    static function set_app_config()
    {
        define("USE_DEFAULT_CONTROLLER", false);
        define("USE_DEFAULT_MODEL", true);
        define("USE_DEFAULT_VIEW", true);
        define("USE_DEFAULT_ACTION", false);
    }

    static function run($loaded_controller, $loaded_model, $loaded_view, $action_name)
    {
        global $lang_app;

        $controller = new $loaded_controller($loaded_model, $loaded_view, $action_name);
        $action = "action_".$action_name;

        if(method_exists($controller, $action)){
            $controller->$action();
        }
        else{
            if(!USE_DEFAULT_ACTION){
                self::throwErr("request", $lang_app->app_err["request_action"].
                    "<br>".$loaded_controller."->".$action);
            }else{
                $controller->action_index();
            }
        }
    }

    static function load_app_lang()
    {
        global $lang_app;
        require_once (JOINT_SITE_REQ_LANG."/lang_app.php");
        $lang_app_name = "lang_app";
        $lang_app = new $lang_app_name();
    }

    static function checkAppDir()
    {
        global $request;

        if($request["diff_cnt"] > 0){
            for ($pp =0; $pp< $request["exec_dir_cnt"]; $pp++){
                if($request["routes"][$pp] != $request["exec_dir"][$pp]){
                    return false;
                }
            }
            return true;
        }else{
            return false;
        }
    }

    static function loadControllerFromRequest()
    {
        global $request, $app_log, $lang_app;

        $default_name = $controller_name = 'Controller';

        require_once JOINT_SITE_REQUIRE_DIR."/application/core/controller.php";

        if($new_controller_name = self::load_instance("controller")){
            $controller_name = $new_controller_name;
        }

        if($controller_name == $default_name and !USE_DEFAULT_CONTROLLER){
            self::throwErr("request", $lang_app->app_err["request_controller"]);
        }

        $app_log["load"]["controller"][] = array("final_controller_name" => $controller_name);

        return $controller_name;
    }

    static function loadModelFromRequest()
    {
        global $request, $app_log, $lang_app;

        //$default_model = "Model";
        $default_model = "Model_pdo";

        $model_name = $default_model;

        require_once JOINT_SITE_REQUIRE_DIR."/application/core/".strtolower($default_model).".php";

        if($new_model_name = self::load_instance("model")){
            $model_name = $new_model_name;
        }

        if($model_name == $default_model and !USE_DEFAULT_MODEL){
            self::throwErr("request", $lang_app->app_err["request_model"]);
        }

        $app_log["load"]["model"][] = array("final_model_name" => $model_name);

        return $model_name;
    }


    static function loadViewFromRequest()
    {
        global $request, $app_log, $lang_app;

        $default_name = "SiteView";
        $view_name = $default_name;

        require_once JOINT_SITE_REQUIRE_DIR."/application/core/View.php";
        require_once JOINT_SITE_REQUIRE_DIR."/application/views/SiteView.php";

        if($new_view_name = self::load_instance("view")){
            $view_name = $new_view_name;
        }

        if($view_name == $default_name and !USE_DEFAULT_VIEW){

            self::throwErr("request", $lang_app->app_err["request_view"]);
        }
        $app_log["load"]["view"][] = array("final_view_name" => $view_name);
        return $view_name;
    }


    static function load_instance($instance_type)
    {
        global $request, $app_log;

        if($instance_type == "controller"){
            $instance_dir = "/controllers";
            $instance_name = "Controller";
        }elseif ($instance_type == "model"){
            $instance_dir = "/models";
            $instance_name = "Model";
        }elseif ($instance_type == "view"){
            $instance_dir = "/views";
            $instance_name = "View";
        }else{
            self::throwErr("XXX", "load_instance: unknown type (".$instance_type.")");
        }

        $result_name = null;
        $check_dir = null;
        for($deep = $request["exec_dir_cnt"]; $deep <= $request["routes"]; $deep++){
            $app_log[$instance_type]["deep"] = $deep;
            if (!empty($request["routes"][$deep])){
                $try_name = $instance_name."_".$request["routes"][$deep];
                $try_load = array(
                    "try_name" => $try_name,
                    "try_path" => JOINT_SITE_REQUIRE_DIR."/application".$instance_dir."/".$check_dir.
                        strtolower($try_name).'.php',
                    "loaded" => false,
                );
                if(file_exists($try_load["try_path"])){
                    require_once ($try_load["try_path"]);
                    $result_name = $try_load["try_name"];
                    $try_load["loaded"] = true;
                }else{
                    $app_log[$instance_type]["deep"] = $deep-1;
                }
                $app_log["load"][$instance_type][] = $try_load;

                $check_dir.=$request["routes"][$deep]."/";
                if (!empty($request["routes"][$deep+1])){
                    if(is_dir(JOINT_SITE_REQUIRE_DIR."/application".$instance_dir."/".$check_dir)) {
                        $try_name = $instance_name."_" . $request["routes"][$deep] . "_" . $request["routes"][$deep + 1];
                        $try_load = array(
                            "try_name" => $try_name,
                            "try_path" => JOINT_SITE_REQUIRE_DIR . "/application".$instance_dir."/" .
                                $check_dir . strtolower($try_name) . '.php',
                            "loaded" => false,
                        );
                        if(file_exists($try_load["try_path"])){
                            require_once ($try_load["try_path"]);
                            $result_name = $try_load["try_name"];
                            $try_load["loaded"] = true;
                        }else{
                            $app_log[$instance_type]["deep"] = $deep-1;
                        }
                        $app_log["load"][$instance_type][] = $try_load;
                    }else{
                        $app_log["load"][$instance_type][] = array("stop_on_empty_dir" =>
                            JOINT_SITE_REQUIRE_DIR."/application".$instance_dir."/".$check_dir);
                        break;
                    }
                }else{

                    break;
                }
            }else{
                $try_name = $instance_name."_main";
                $try_load = array(
                    "try_name" => $try_name,
                    "try_path" => JOINT_SITE_REQUIRE_DIR."/application".$instance_dir."/".
                        strtolower($try_name).'.php',
                    "loaded" => false,
                );

                if(file_exists($try_load["try_path"])){
                    require_once ($try_load["try_path"]);
                    $result_name = $try_load["try_name"];
                    $try_load["loaded"] = true;
                }
                $app_log["load"][$instance_type][] = $try_load;
                break;
            }
        }

        return $result_name;
    }

    static function getActionFromRequest()
    {
        global $request, $app_log;
        $action_name = "index";
        if (!empty($request["routes"][$app_log["controller"]["deep"]+1])){
            $action_name = $request["routes"][$app_log["controller"]["deep"]+1];
        }

        return $action_name;
    }

    static function throwErr($errType, $message)
    {
        require_once (JOINT_SITE_REQUIRE_DIR."/application/core/controller.php");
        require_once (JOINT_SITE_REQUIRE_DIR."/application/core/alerts/Alerts_controller.php");
        require_once (JOINT_SITE_REQUIRE_DIR."/application/core/alerts/Alerts_model.php");
        require_once (JOINT_SITE_REQUIRE_DIR."/application/core/View.php");
        require_once (JOINT_SITE_REQUIRE_DIR."/application/views/SiteView.php");
        require_once (JOINT_SITE_REQUIRE_DIR."/application/core/alerts/alerts_view.php");
        $controller = new Alerts_controller();
        $controller->generateErr($errType, $message);
        exit;
    }

    function print_load_log($type_of_log = null)
    {
        if($type_of_log){
            echo "<div style='text-align: left; font-size: 16px;'>";
            if($type_of_log == "all"){
                echo "Controller_Action: ".$this->app_log["action"] ."<br>";
                foreach ($this->app_log["load"] as $type_of_log => $block_log){
                    self::print_load_log_type($type_of_log);
                }
            }else{
                self::print_load_log_type($type_of_log);
            }
            echo "</div>";
        }
    }

    function print_load_log_type($type_of_log)
    {
        echo $type_of_log."-LOG<br>";
        echo "LoadDeep: ".$this->app_log[$type_of_log]["deep"]."<br>";
        for($load_deep = 0; $load_deep< count($this->app_log["load"][$type_of_log]);$load_deep++){
            foreach ($this->app_log["load"][$type_of_log][$load_deep] as $try_f => $try_v){
                echo $load_deep.":> ".$try_f."=".$try_v."<br>";
            }
            echo "........................................................................................<br>";
        }
    }
}