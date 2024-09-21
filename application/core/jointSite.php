<?php
class jointSite
{
    public $lang_map;

    function js_Run($JOINT_SITE_EXEC_DIR=null, $DOCUMENT_ROOT = null, $REQUEST_URI = null)
    {
        global $mct;
        $mct['start_time'] = microtime(true);
        $this->js_PrepareRequest($JOINT_SITE_EXEC_DIR, $DOCUMENT_ROOT, $REQUEST_URI);
        $this->load_app_lang();
        $result = $this->js_app_exec();
        $this->js_HandleResult($result);
    }

    function js_PrepareRequest($JOINT_SITE_EXEC_DIR, $DOCUMENT_ROOT, $REQUEST_URI)
    {
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
        JOINT_SITE_REQ_LANG                                                 shortcut for lang_file C:/OSPanel/domains/rj-test.local/mirror/application/lang_files/ru
        JOINT_SITE_APP_LANG                                                 ru or en
        JOINT_SITE_APP_REF                                                  null, /ru or /en
        JOINT_SITE_REQ_ROOT                                                 it routes_uri cut of lang uri to process logic
                                                                            /mirror/test/phpmysqladmin/printquery?test=1111

        JS_SAIK                                                             main or mirror

         */


        $this->js_ExplodeRequest($JOINT_SITE_EXEC_DIR, $DOCUMENT_ROOT, $REQUEST_URI);
        $this->js_LangReq();
        $this->js_session_key();
        define("JOINT_SITE_CONF_DIR", $this->js_config_dir());
    }

    function load_app_lang()
    {
        require_once (JOINT_SITE_REQ_LANG."/lang_app.php");
        $lang_app_name = "lang_app";
        $this->lang_map = new $lang_app_name();
    }

    function js_ExplodeRequest($JOINT_SITE_EXEC_DIR=null, $DOCUMENT_ROOT = null, $REQUEST_URI = null)
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

    function js_LangReq($acceptable_lang = array("en", "ru", ))
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

    function js_session_key()
    {
        //session_start();
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

    function js_config_dir()
    {
        return JOINT_SITE_REQUIRE_DIR."/".trim(file_get_contents(JOINT_SITE_REQUIRE_DIR."/app_config_dir.txt"));
    }

    function js_app_exec():bool
    {
        /*define constants used default*/
        $this->set_app_config();

        $loaded_controller = $this->loadControllerFromRequest();
        if(!$this->checkAppControllerSettings($loaded_controller)){
            return false;
        }

        $loaded_model = $this->loadModelFromRequest();
        if(!$this->checkAppModelSettings($loaded_model)) {
            return false;
        }

        $loaded_view = $this->loadViewFromRequest();
        if(!$this->checkAppViewSettings($loaded_view)){
            return false;
        }

        global $app_log;

        $app_log["action"] = $action_name = $this->getActionFromRequest();

        return $this->js_ExecAction($loaded_controller, $loaded_model, $loaded_view, $action_name);
    }

    function set_app_config()
    {
        define("USE_DEFAULT_CONTROLLER", false);
        define("USE_DEFAULT_MODEL", true);
        define("USE_DEFAULT_VIEW", true);
        define("USE_DEFAULT_ACTION", false);
    }

    function loadControllerFromRequest():string
    {
        global $request, $app_log, $lang_app;

        $controller_name = "Controller";

        require_once JOINT_SITE_REQUIRE_DIR."/application/core/controller.php";

        if($new_controller_name = self::load_instance("controller")){
            $controller_name = $new_controller_name;
        }

        $app_log["load"]["controller"][] = array("final_controller_name" => $controller_name);
        return $controller_name;
    }

    function load_instance($instance_type):string
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

        $result_name = "";
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

    function checkAppControllerSettings($controller_name, $default_name="Controller"):bool
    {
        if($controller_name == $default_name and !USE_DEFAULT_CONTROLLER){
            return self::throwErr("request", $this->lang_map->app_err["request_controller"]);
        }
        return true;
    }

    function loadModelFromRequest()
    {
        global $request, $app_log, $lang_app;

        //$default_model = "Model";
        $default_model = "Model_pdo";

        $model_name = $default_model;

        require_once JOINT_SITE_REQUIRE_DIR."/application/core/".strtolower($default_model).".php";

        if($new_model_name = self::load_instance("model")){
            $model_name = $new_model_name;
        }



        $app_log["load"]["model"][] = array("final_model_name" => $model_name);

        return $model_name;
    }

    function checkAppModelSettings($model_name, $default_model="Model_pdo"):bool
    {
        global $lang_app;
        if($model_name == $default_model and !USE_DEFAULT_MODEL){
            self::throwErr("request", $lang_app->app_err["request_model"]);
        }
        return true;
    }

    function loadViewFromRequest()
    {
        global $request, $app_log, $lang_app;

        $default_name = "SiteView";
        $view_name = $default_name;

        require_once JOINT_SITE_REQUIRE_DIR."/application/core/View.php";
        require_once JOINT_SITE_REQUIRE_DIR."/application/views/SiteView.php";

        if($new_view_name = self::load_instance("view")){
            $view_name = $new_view_name;
        }

        $app_log["load"]["view"][] = array("final_view_name" => $view_name);
        return $view_name;
    }

    function checkAppViewSettings($view_name, $default_name="SiteView"):bool
    {
        global $lang_app;
        if($view_name == $default_name and !USE_DEFAULT_VIEW){
            self::throwErr("request", $lang_app->app_err["request_view"]);;
        }
        return true;
    }

    function getActionFromRequest()
    {
        global $request, $app_log;
        $action_name = "index";
        if (!empty($request["routes"][$app_log["controller"]["deep"]+1])){
            $action_name = $request["routes"][$app_log["controller"]["deep"]+1];
        }

        return $action_name;
    }

    function js_ExecAction($loaded_controller, $loaded_model, $loaded_view, $action_name):bool
    {
        global $lang_app;

        if($loaded_controller and $loaded_model and $loaded_view and $action_name){
            $controller = new $loaded_controller($loaded_model, $loaded_view, $action_name);
            $action = "action_".$action_name;

            if(method_exists($controller, $action)){
                $controller->$action();
            }
            else{
                if(!USE_DEFAULT_ACTION){
                    return self::throwErr("request", $lang_app->app_err["request_action"].
                        "<br>".$loaded_controller."->".$action);
                }else{
                    $controller->action_index();
                }
            }
        }else{
            return false;
        }
        return true;
    }

    function js_HandleResult(bool $result)
    {
        global $js_result;

        if($result){
            return true;
            //echo "run: ok";
        }else{
            $this->js_display_err($js_result["errType"], $js_result["message"]);
            echo "run: err";
        }
    }

/*
    function load_app_lang()
    {

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
*/
    static function throwErr($errType, $message):bool
    {
        global $js_result;
        $js_result["error"] = true;
        $js_result["errType"] = $errType;
        $js_result["message"] = $message;
        /*always return false*/
        return false;

    }

    function js_display_err($errType, $message)
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
/*
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
*/
}