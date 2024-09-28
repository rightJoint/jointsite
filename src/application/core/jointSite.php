<?php
require_once __DIR__ . "/Interfaces/jointSiteInterface.php";
class jointSite implements jointSiteInterface
{
    public $document_root;
    public $request_uri;
    public $lang_map;

    function js_Run()
    {
        global $mct, $js_result;

        $js_result["error"] = false;                    //:bool false if no err

        $mct['start_time'] = microtime(true);

        $this->js_PrepareRequest();

        $result = $this->js_app_exec();
        $this->js_HandleResult($result);
    }

    public function js_PrepareRequest()
    {
        $this->js_ExplodeRequest();
        $this->js_LangReq();
        $env = $this->js_get_env();

        define("JOINT_SITE_USERS_DIR", JOINT_SITE_REQUIRE_DIR."/".$env["JOINT_SITE_USERS_DIR"]);
        define("JOINT_SITE_CONF_DIR", JOINT_SITE_REQUIRE_DIR."/".$env["JOINT_SITE_CONFIG_DIR"]);

        $this->load_app_lang();
    }

    private function js_ExplodeRequest()
    {
        define("JOINT_SITE_REQUIRE_DIR", $this->document_root);
        global $request;
        $request["routes_uri"] = $this->request_uri;
        $request["routes_path"] = explode('?', $request["routes_uri"])[0];
        $request["routes"] = explode('/', $request["routes_path"]);
        $request["routes_cnt"] = count($request["routes"]);
    }

    private function js_LangReq($acceptable_lang = array("en", "ru", ))
    {
        global $request;
        if(isset($request["routes"][1]) and
            in_array($request["routes"][1], $acceptable_lang)){
            define("JOINT_SITE_REQ_LANG", JOINT_SITE_REQUIRE_DIR."/application/lang_files/".$request["routes"][1]);
            define("JOINT_SITE_APP_LANG", $request["routes"][1]);
            define("JOINT_SITE_APP_REF", "/".JOINT_SITE_APP_LANG);
            $pos_lang = strpos($request["routes_uri"], JOINT_SITE_APP_REF);
            define("JOINT_SITE_REQ_ROOT",
                substr($request["routes_uri"], $pos_lang+1 + strlen(JOINT_SITE_APP_LANG),
                    strlen($request["routes_uri"])));
            unset($request["routes"][1]);
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

    private function load_app_lang()
    {
        require_once (JOINT_SITE_REQ_LANG."/lang_app.php");
        $lang_app_name = "lang_app";
        $this->lang_map = new $lang_app_name();
    }

    public function js_get_env():array
    {
        return parse_ini_file('.env');
    }

    private function js_app_exec():bool
    {
        /*define constants used default*/
        $this->set_app_config();

        $loaded_model = $this->loadModelFromRequest();


        if(!$this->checkAppModelSettings($loaded_model)) {
            return false;
        }
        $loaded_controller = $this->loadControllerFromRequest();
        if(!$this->checkAppControllerSettings($loaded_controller)){
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

    private function set_app_config()
    {
        define("USE_DEFAULT_CONTROLLER", false);
        define("USE_DEFAULT_MODEL", true);
        define("USE_DEFAULT_VIEW", true);
        define("USE_DEFAULT_ACTION", false);
    }

    private function loadControllerFromRequest():string
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

    private function load_instance($instance_type):string
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

        for($deep = 1; $deep <= $request["routes"]; $deep++){
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
                }else{

                    return "";
                }


                $app_log["load"][$instance_type][] = $try_load;


                break;
            }
        }

        return $result_name;
    }

    private function checkAppControllerSettings($controller_name, $default_name="Controller"):bool
    {
        if($controller_name == $default_name and !USE_DEFAULT_CONTROLLER){
            return self::throwErr("request", $this->lang_map->app_err["request_controller"]);
        }
        return true;
    }

    private function loadModelFromRequest():string
    {
        global $request, $app_log, $lang_app;

        //$default_model = "Model";
        $default_model = "Model_pdo";

        $model_name = $default_model;

        require_once JOINT_SITE_REQUIRE_DIR."/application/core/".strtolower($default_model).".php";

        if($new_model_name = $this->load_instance("model")){
            $model_name = $new_model_name;
        }

        $app_log["load"]["model"][] = array("final_model_name" => $model_name);

        return $model_name;
    }

    private function checkAppModelSettings($model_name, $default_model="Model_pdo"):bool
    {
        global $lang_app;
        if($model_name == $default_model and !USE_DEFAULT_MODEL){
            self::throwErr("request", $lang_app->app_err["request_model"]);
        }
        return true;
    }

    private function loadViewFromRequest():string
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

    private function checkAppViewSettings($view_name, $default_name="SiteView"):bool
    {
        global $lang_app;
        if($view_name == $default_name and !USE_DEFAULT_VIEW){
            self::throwErr("request", $lang_app->app_err["request_view"]);;
        }
        return true;
    }

    private function getActionFromRequest():string
    {
        global $request, $app_log;
        $action_name = "index";
        if (!empty($request["routes"][$app_log["controller"]["deep"]+1])){
            $action_name = $request["routes"][$app_log["controller"]["deep"]+1];
        }

        return $action_name;
    }

    private function js_ExecAction($loaded_controller, $loaded_model, $loaded_view, $action_name):bool
    {
        global $js_result;

        if($loaded_controller and $loaded_model and $loaded_view and $action_name){
            $controller = new $loaded_controller($loaded_model, $loaded_view, $action_name);
            $action = "action_".$action_name;

            if(isset($js_result["error"]) and $js_result["error"] == true){
                return false;
            }

            if(method_exists($controller, $action)){
                $controller->$action();
                if(isset($js_result["error"]) and $js_result["error"] == true){
                    return false;
                }
            }
            else{
                if(!USE_DEFAULT_ACTION){
                    return self::throwErr("request", $this->lang_map->app_err["request_action"].
                        "<br>".$loaded_controller."->".$action);
                }else{
                    $controller->action_index();
                    if(isset($js_result["error"]) and $js_result["error"] == true){
                        return false;
                    }
                }
            }
        }else{
            return false;
        }
        return true;
    }

    function js_HandleResult(bool $result)
    {
        global $js_result, $app_log;
        /*
         *
         * $js_result["error"]                                      :bool, true if err occurs
         * $js_result["errType"]                                    type last thrown err
         * $js_result["message"][] = array($errType => $message);   list err
         */

        if($result){
            return true;
        }else{
            $this->js_display_err($js_result["errType"], $js_result["message"]);
        }
    }

    static function throwErr($errType, $message):bool
    {
        global $js_result;
        $js_result["error"] = true;
        $js_result["errType"] = $errType;
        $js_result["message"][] = array($errType => $message);
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
    }
}