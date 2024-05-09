<?php
class jointSite
{
    public $lang_map;

    function __construct($JOINT_SITE_EXEC_DIR=null)
    {
        global $mct;
        $mct['start_time'] = microtime(true);

        session_start();

        if($_GET["lang"]=="en"){
            $_SESSION["lang"] = "en";
        }elseif($_GET["lang"]=="rus"){
            $_SESSION["lang"] = "rus";
        }elseif(!$_SESSION["lang"]){
            $_SESSION["lang"]="rus";
        }

        global $request;
        $request["routes_path"] = explode('?', $_SERVER['REQUEST_URI'])[0];
        $request["routes"] = explode('/', $request["routes_path"]);
        $request["routes_cnt"] = count($request["routes"]);
        $request["exec_path"] = $JOINT_SITE_EXEC_DIR;
        $request["exec_dir"] = explode('/', $JOINT_SITE_EXEC_DIR);
        $request["exec_dir_cnt"] = count($request["exec_dir"]);
        $request["diff_cnt"] = $request["routes_cnt"] - $request["exec_dir_cnt"];

        if(!$this->checkAppDir()) {
            $request_exec_dir = array(
                "en" => "Application error: rout not compatible JOINT_SITE_EXEC_DIR",
                "rus" => "Ошибка приложения: Маршрут не соответствует конфигурации",
            );
            echo $request_exec_dir[$_SESSION["lang"]]." (route: ".$request["routes_path"].", EXEC_DIR: ".$request["exec_path"].")";
            exit;
        }

        require_once ($_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/lang_files/lang_app_".$_SESSION["lang"].".php");
        $lang_app_name = "lang_app_".$_SESSION["lang"];
        $this->lang_map = new $lang_app_name();

        define("JOINT_SITE_EXEC_DIR", $JOINT_SITE_EXEC_DIR);
        define("JOINT_SITE_CONF_DIR", $_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/__config");
        require_once JOINT_SITE_CONF_DIR."/dir_const.php";
        require_once JOINT_SITE_APP_CONFIG;

        $loaded_controller = $this->loadControllerFromRequest();
        $loaded_model = $this->loadModelFromRequest();
        $loaded_view = $this->loadViewFromRequest();
        $action_name = $this->getActionFromRequest();

        $this->run($loaded_controller, $loaded_model, $loaded_view, $action_name);

    }

    function run($loaded_controller, $loaded_model, $loaded_view, $action_name)
    {
        $controller = new $loaded_controller($loaded_model, $loaded_view);
        $action = "action_".$action_name;

        if(method_exists($controller, $action)){
            $controller->$action();
        }
        else{
            if(!USE_DEFAULT_ACTION){
                self::throwErr("request", $this->lang_map->app_err["request_action"]);
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

        $controller_name = 'Controller';

        require_once ($_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/core/controller.php");

        if (!empty($request["routes"][$request["exec_dir_cnt"]])){
            $try_name =  "Controller_".$request["routes"][$request["exec_dir_cnt"]];
            $try_path = $_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/controllers/".strtolower($try_name).'.php';
        }else{
            $try_name = "Controller_Main";
            $try_path = $_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/controllers/controller_main.php";
        }

        if(file_exists($try_path)){
            require_once ($try_path);
            $controller_name = $try_name;
        }
        elseif(!USE_DEFAULT_CONTROLLER){
            self::throwErr("request", $this->lang_map->app_err["request_controller"]);
        }

        return $controller_name;
    }

    function loadModelFromRequest()
    {
        global $request;

        $default_model = "Model";

        $model_name = $default_model;

        require_once ($_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/core/".strtolower($default_model).".php");

        if (!empty($request["routes"][$request["exec_dir_cnt"]])){
            $try_name =  "Model_".$request["routes"][$request["exec_dir_cnt"]];
            $try_path = $_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/models/".strtolower($try_name).'.php';
            if(file_exists($try_path)){
                require_once ($try_path);
                $model_name = $try_name;
            }

            if (!empty($request["routes"][$request["exec_dir_cnt"]+1])){
                $try_name =  "Model_".$request["routes"][$request["exec_dir_cnt"]]."_".$request["routes"][$request["exec_dir_cnt"]+1];
                $try_path = $_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/models/".
                    $request["routes"][$request["exec_dir_cnt"]]."/".strtolower($try_name).'.php';
                if(file_exists($try_path)){
                    require_once ($try_path);
                    $model_name = $try_name;
                }
            }

        }else{
            $try_name = "Model_Main";
            $try_path = $_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/controllers/model_main.php";
            if(file_exists($try_path)){
                require_once ($try_path);
                $model_name = $try_name;
            }
        }

        if($model_name == $default_model and !USE_DEFAULT_MODEL){

            self::throwErr("request", $this->lang_map->app_err["request_model"]);
        }

        return $model_name;
    }

    function loadViewFromRequest()
    {
        global $request;

        $default_name = "SiteView";
        $view_name = $default_name;

        require_once ($_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/core/View.php");
        require_once ($_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/views/SiteView.php");

        if (!empty($request["routes"][$request["exec_dir_cnt"]])){
            $try_name =  "View_".$request["routes"][$request["exec_dir_cnt"]];
            $try_path = $_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/views/".strtolower($try_name).'.php';
            if(file_exists($try_path)){
                require_once ($try_path);
                $view_name = $try_name;
            }

            if (!empty($request["routes"][$request["exec_dir_cnt"]+1])){
                $try_name =  "View_".$request["routes"][$request["exec_dir_cnt"]]."_".$request["routes"][$request["exec_dir_cnt"]+1];
                $try_path = $_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/views/".
                    $request["routes"][$request["exec_dir_cnt"]]."/".strtolower($try_name).'.php';
                if(file_exists($try_path)){
                    require_once ($try_path);
                    $view_name = $try_name;
                }
            }

        }else{
            $try_name = "View_Main";
            $try_path = $_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/views/view_main.php";
            if(file_exists($try_path)){
                require_once ($try_path);
                $view_name = $try_name;
            }
        }

        if($view_name == $default_name and !USE_DEFAULT_VIEW){

            self::throwErr("request", $this->lang_map->app_err["request_view"]);
        }

        return $view_name;
    }

    function getActionFromRequest()
    {
        global $request;
        $action_name = "index";
        if (!empty($request["routes"][$request["exec_dir_cnt"]+1])){
            $action_name = $request["routes"][$request["exec_dir_cnt"]+1];
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
}