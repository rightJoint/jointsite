<?php
class jointSite
{
    public $lang_map;
    public $app_log;

    function __construct($JOINT_SITE_EXEC_DIR=null)
    {
        global $mct;
        $mct['start_time'] = microtime(true);

        global $request;
        $request["routes_path"] = explode('?', $_SERVER['REQUEST_URI'])[0];
        $request["routes"] = explode('/', $request["routes_path"]);

        if(isset($JOINT_SITE_EXEC_DIR) and $JOINT_SITE_EXEC_DIR != null and $JOINT_SITE_EXEC_DIR != ""){
            $request["exec_dir"] = explode('/', $JOINT_SITE_EXEC_DIR);
        }else{
            $request["exec_dir"] = array(0 => "");
        }

        $request["routes_cnt"] = count($request["routes"]);
        $request["exec_path"] = $JOINT_SITE_EXEC_DIR;

        $request["exec_dir_cnt"] = count($request["exec_dir"]);
        $request["diff_cnt"] = $request["routes_cnt"] - $request["exec_dir_cnt"];

        session_start();

        //session app instance key at host
        $s_key = null;
        if($JOINT_SITE_EXEC_DIR){
            for ($c = 0; $c<$request["exec_dir_cnt"]; $c++){
                $s_key .= $request["exec_dir"][$c];
            }
        }else{
            $s_key = "main";
        }

        define("JS_SAIK", $s_key);
        define("JOINT_SITE_EXEC_DIR", $JOINT_SITE_EXEC_DIR);

        $this->set_lang_environment();

        if(!$this->checkAppDir()) {
            $request_exec_dir = array(
                "en" => "Application error: rout not compatible JOINT_SITE_EXEC_DIR",
                "rus" => "Ошибка приложения: Маршрут не соответствует конфигурации",
            );
            exit;
        }

        require_once ($_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/lang_files/lang_app_".$_SESSION[JS_SAIK]["lang"].".php");
        $lang_app_name = "lang_app_".$_SESSION[JS_SAIK]["lang"];
        $this->lang_map = new $lang_app_name();


        define("JOINT_SITE_CONF_DIR", $_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/__config");
        require_once JOINT_SITE_CONF_DIR."/dir_const.php";
        require_once JOINT_SITE_APP_CONFIG;

        $loaded_controller = $this->loadControllerFromRequest();
        $loaded_model = $this->loadModelFromRequest();
        $loaded_view = $this->loadViewFromRequest();
        $this->app_log["action"] = $action_name = $this->getActionFromRequest();

        $this->print_load_log();
        //$this->print_load_log("controller");

        $this->run($loaded_controller, $loaded_model, $loaded_view, $action_name);

    }

    function set_lang_environment()
    {
        global $request;
        if(isset($request["routes"][$request["exec_dir_cnt"]]) and
            $request["routes"][$request["exec_dir_cnt"]] == "en"){
            unset($request["routes"][$request["exec_dir_cnt"]]);
            $request["routes"] = array_values($request["routes"]);
            $_SESSION[JS_SAIK]["lang"] = "en";
            $_SESSION[JS_SAIK]["lang_ref"] = "/en";
            $request["routes_cnt"] --;
            define("JOINT_SITE_ROOT_LANG", JOINT_SITE_EXEC_DIR."/en");
        }elseif (isset($request["routes"][$request["exec_dir_cnt"]]) and
            $request["routes"][$request["exec_dir_cnt"]] == "ru"){
            unset($request["routes"][$request["exec_dir_cnt"]]);
            $_SESSION[JS_SAIK]["lang"] = "rus";
            $_SESSION[JS_SAIK]["lang_ref"] = "/ru";
            $request["routes"] = array_values($request["routes"]);
            $request["routes_cnt"] --;
            define("JOINT_SITE_ROOT_LANG", JOINT_SITE_EXEC_DIR."/ru");
        }else{
            $_SESSION[JS_SAIK]["lang"] = "rus";
            $_SESSION[JS_SAIK]["lang_ref"] = null;
            define("JOINT_SITE_ROOT_LANG", JOINT_SITE_EXEC_DIR);
        }
        $exec_dir_len = 0;
        if(JOINT_SITE_EXEC_DIR){
            $exec_dir_len = strlen(JOINT_SITE_EXEC_DIR);
        }
        if($_SESSION[JS_SAIK]["lang_ref"]!=null){
            $request["routes_lang"] = substr($_SERVER['REQUEST_URI'], $exec_dir_len + strlen($_SESSION[JS_SAIK]["lang_ref"]),
                strlen($_SERVER['REQUEST_URI']));
        }else{
            $request["routes_lang"] = substr($_SERVER['REQUEST_URI'], $exec_dir_len,
                strlen($_SERVER['REQUEST_URI']));;
        }
        define("JOINT_SITE_LANG_REF", JOINT_SITE_EXEC_DIR.$_SESSION[JS_SAIK]["lang_ref"]);
    }

    function run($loaded_controller, $loaded_model, $loaded_view, $action_name)
    {
        $controller = new $loaded_controller($loaded_model, $loaded_view, $action_name);
        $action = "action_".$action_name;

        if(method_exists($controller, $action)){
            $controller->$action();
        }
        else{
            if(!USE_DEFAULT_ACTION){
                self::throwErr("request", $this->lang_map->app_err["request_action"].
                    "<br>".$loaded_controller."->".$action);
            }else{
                $controller->action_index();
            }
        }
    }

    function checkAppDir()
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

    function loadControllerFromRequest()
    {
        global $request;

        $default_name = $controller_name = 'Controller';

        require_once ($_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/core/controller.php");

        if($new_controller_name = self::load_instance("controller")){
            $controller_name = $new_controller_name;
        }

        if($controller_name == $default_name and !USE_DEFAULT_CONTROLLER){

            self::throwErr("request", $this->lang_map->app_err["request_controller"]);
        }

        $this->app_log["load"]["controller"][] = array("final_controller_name" => $controller_name);

        return $controller_name;
    }

    function loadModelFromRequest()
    {
        global $request;

        //$default_model = "Model";
        $default_model = "Model_pdo";

        $model_name = $default_model;

        require_once ($_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/core/".strtolower($default_model).".php");

        if($new_model_name = self::load_instance("model")){
            $model_name = $new_model_name;
        }

        if($model_name == $default_model and !USE_DEFAULT_MODEL){
            self::throwErr("request", $this->lang_map->app_err["request_model"]);
        }

        $this->app_log["load"]["model"][] = array("final_model_name" => $model_name);

        return $model_name;
    }


    function loadViewFromRequest()
    {
        global $request;

        $default_name = "SiteView";
        $view_name = $default_name;

        require_once ($_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/core/View.php");
        require_once ($_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/views/SiteView.php");

        if($new_view_name = self::load_instance("view")){
            $view_name = $new_view_name;
        }

        if($view_name == $default_name and !USE_DEFAULT_VIEW){

            self::throwErr("request", $this->lang_map->app_err["request_view"]);
        }
        $this->app_log["load"]["view"][] = array("final_view_name" => $view_name);
        return $view_name;
    }


    function load_instance($instance_type)
    {
        global $request;

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
            $this->app_log[$instance_type]["deep"] = $deep;
            if (!empty($request["routes"][$deep])){
                $try_name = $instance_name."_".$request["routes"][$deep];
                $try_load = array(
                    "try_name" => $try_name,
                    "try_path" => $_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application".$instance_dir."/".$check_dir.
                        strtolower($try_name).'.php',
                    "loaded" => false,
                );
                if(file_exists($try_load["try_path"])){
                    require_once ($try_load["try_path"]);
                    $result_name = $try_load["try_name"];
                    $try_load["loaded"] = true;
                }else{
                    $this->app_log[$instance_type]["deep"] = $deep-1;
                }
                $this->app_log["load"][$instance_type][] = $try_load;

                $check_dir.=$request["routes"][$deep]."/";
                if (!empty($request["routes"][$deep+1])){
                    if(is_dir($_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application".$instance_dir."/".$check_dir)) {
                        $try_name = $instance_name."_" . $request["routes"][$deep] . "_" . $request["routes"][$deep + 1];
                        $try_load = array(
                            "try_name" => $try_name,
                            "try_path" => $_SERVER["DOCUMENT_ROOT"] . $request["exec_path"] . "/application".$instance_dir."/" .
                                $check_dir . strtolower($try_name) . '.php',
                            "loaded" => false,
                        );
                        if(file_exists($try_load["try_path"])){
                            require_once ($try_load["try_path"]);
                            $result_name = $try_load["try_name"];
                            $try_load["loaded"] = true;
                        }else{
                            $this->app_log[$instance_type]["deep"] = $deep-1;
                        }
                        $this->app_log["load"][$instance_type][] = $try_load;
                    }else{
                        $this->app_log["load"][$instance_type][] = array("stop_on_empty_dir" =>
                            $_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application".$instance_dir."/".$check_dir);
                        break;
                    }
                }else{

                    break;
                }
            }else{
                $try_name = $instance_name."_main";
                $try_load = array(
                    "try_name" => $try_name,
                    "try_path" => $_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application".$instance_dir."/".
                        strtolower($try_name).'.php',
                    "loaded" => false,
                );

                if(file_exists($try_load["try_path"])){
                    require_once ($try_load["try_path"]);
                    $result_name = $try_load["try_name"];
                    $try_load["loaded"] = true;
                }
                $this->app_log["load"][$instance_type][] = $try_load;
                break;
            }
        }

        return $result_name;
    }

    function getActionFromRequest()
    {
        global $request;
        $action_name = "index";
        if (!empty($request["routes"][$this->app_log["controller"]["deep"]+1])){
            $action_name = $request["routes"][$this->app_log["controller"]["deep"]+1];
        }

        return $action_name;
    }

    static function throwErr($errType, $message)
    {
        require_once ($_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/core/controller.php");
        require_once ($_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/core/alerts/Alerts_controller.php");
        require_once ($_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/core/alerts/Alerts_model.php");
        require_once ($_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/core/View.php");
        require_once ($_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/views/SiteView.php");
        require_once ($_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/core/alerts/alerts_view.php");
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