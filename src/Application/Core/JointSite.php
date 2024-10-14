<?php
namespace JointSite\Core;
use JointSite\Core\Interfaces\JointSiteInterface;
use JointSite\Core\Logger\JointSiteLogger;

//use JointSite\LangFiles\Ru\LangFiles_Ru_App;

class JointSite implements JointSiteInterface
{
    public $document_root;
    public $request_uri;
    public $lang_map;

    function jsRun()
    {
        global $mct, $js_result;

        $js_result["error"] = false;                    //:bool false if no err

        $mct['start_time'] = microtime(true);

        $this->jsPrepareRequest();

        $result = $this->jsAppExec();
        $this->jsHandleResult($result);
    }

    public function jsPrepareRequest()
    {
        $this->jsExplodeRequest();
        $this->jsLangReq();
        $env = $this->jsGetEnv();

        define("JOINT_SITE_USERS_DIR", JOINT_SITE_REQUIRE_DIR."/".$env["JOINT_SITE_USERS_DIR"]);
        define("JOINT_SITE_CONF_DIR", JOINT_SITE_REQUIRE_DIR."/".$env["JOINT_SITE_CONFIG_DIR"]);

        $this->jsLoadAppLang();
    }

    private function jsExplodeRequest()
    {
        define("JOINT_SITE_REQUIRE_DIR", $this->document_root);
        global $request;
        $request["routes_uri"] = $this->request_uri;
        $request["routes_path"] = explode('?', $request["routes_uri"])[0];
        $request["routes"] = explode('/', $request["routes_path"]);
        $request["routes_cnt"] = count($request["routes"]);
    }

    private function jsLangReq($acceptable_lang = array("En", "Ru", ))
    {
        global $request;
        if(isset($request["routes"][1]) and
            in_array($request["routes"][1], $acceptable_lang)){
            define("JOINT_SITE_REQ_LANG", JOINT_SITE_REQUIRE_DIR."/Application/LangFiles/".$request["routes"][1]);
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
            define("JOINT_SITE_REQ_LANG", JOINT_SITE_REQUIRE_DIR."/Application/LangFiles/ru");
            define("JOINT_SITE_APP_LANG", "Ru");
            define("JOINT_SITE_REQ_ROOT", substr($request["routes_uri"], 0,
                strlen($request["routes_uri"])));
            define("JOINT_SITE_APP_REF", null);
        }
    }

    private function jsLoadAppLang()
    {
        require_once (JOINT_SITE_REQ_LANG."/LangFiles_".JOINT_SITE_APP_LANG."_App.php");
        $lang_app_name = "LangFiles_".JOINT_SITE_APP_LANG."_App";
        //$lang_app_name = "LangFiles_Ru_App";
        $this->lang_map = new $lang_app_name();
    }

    public function jsGetEnv():array
    {
        return parse_ini_file('.env');
    }

    private function jsAppExec():bool
    {
        /*define constants used default*/
        $this->jsSetAppConfig();

        $loaded_model = $this->jsLoadModelFromRequest();
        if(!$this->jsCheckAppModelSettings($loaded_model)) {
            return false;
        }

        $loaded_controller = $this->jsLoadControllerFromRequest();
        if(!$this->jsCheckAppControllerSettings($loaded_controller)){
            return false;
        }

        $loaded_view = $this->jsLoadViewFromRequest();
        if(!$this->jsCheckAppViewSettings($loaded_view)){
            return false;
        }

        global $app_log;

        $app_log["action"] = $action_name = $this->jsGetActionFromRequest();
        return $this->jsExecAction($loaded_controller, $loaded_model, $loaded_view, $action_name);
    }

    private function jsSetAppConfig()
    {
        define("USE_DEFAULT_CONTROLLER", false);
        define("USE_DEFAULT_MODEL", true);
        define("USE_DEFAULT_VIEW", true);
        define("USE_DEFAULT_ACTION", false);
    }

    private function jsLoadControllerFromRequest():string
    {
        global $request, $app_log, $lang_app;

        $controller_name = "Controller";

        //require_once JOINT_SITE_REQUIRE_DIR."/application/core/controller.php";

        if($new_controller_name = self::jsLoadInstance("Controller")){
            $controller_name = $new_controller_name;
        }

        $app_log["load"]["Controller"][] = array("final_controller_name" => $controller_name);
        return $controller_name;
    }

    private function jsLoadInstance($instance_type):string
    {
        global $request, $app_log;

        if($instance_type == "Controller"){
            $instance_dir = "/Controllers";
            $instance_name = "Controller";
            $namespace_name = "\Controller";
        }elseif ($instance_type == "Model"){
            $instance_dir = "/Models";
            $instance_name = "Model";
            $namespace_name = "\Model";
        }elseif ($instance_type == "View"){
            $instance_dir = "/Views";
            $instance_name = "View";
            $namespace_name = "\Views";
        }else{
            JointSiteLogger::throwErr("XXX", "load_instance: unknown type (".$instance_type.")");
        }

        $result_name = "";
        $check_dir = null;
        $dir_list = null;
        $namespace_list = null;
        $names_list = $instance_type;
        $loaded_index = 0;

        for($deep = 1; $deep <= $request["routes"]; $deep++){
            $app_log[$instance_type]["deep"] = $deep;

            if (!empty($request["routes"][$deep])){

                $names_list.="_".$request["routes"][$deep];

                $request_routes_val = $request["routes"][$deep];

                $namespace_list.="\\$request_routes_val";
                $dir_list .= $request["routes"][$deep-1]."_";
                $try_name = $instance_name.$dir_list.$request["routes"][$deep];

                $try_load = array(
                    "namespace" => "JointSite\\$namespace_name\\$namespace_list",
                    "try_name" => $names_list,
                    "try_path" => JOINT_SITE_REQUIRE_DIR."/Application".$instance_dir."/".$check_dir.
                        $try_name.'.php',
                    "loaded" => false,
                );

                if(file_exists($try_load["try_path"])){
                    //require_once ($try_load["try_path"]);
                    $result_name = $try_load["try_name"];
                    $loaded_index = $deep;
                    $try_load["loaded"] = true;
                }else{
                    $app_log[$instance_type]["deep"] = $deep-1;
                }
                $app_log["load"][$instance_type][] = $try_load;




                $check_dir.=$request["routes"][$deep]."/";
                if (!empty($request["routes"][$deep+1])){
                    if(!is_dir(JOINT_SITE_REQUIRE_DIR."/Application".$instance_dir."/".$check_dir)) {
                        $app_log["load"][$instance_type][] = array("stop_on_empty_dir" =>
                            JOINT_SITE_REQUIRE_DIR."/Application".$instance_dir."/".$check_dir);
                        break;
                    }
                }else{
                    break;
                }
            }else{
                $try_name = $instance_name."_Main";
                $try_load = array(
                    "namespace" => "JointSite\\$namespace_name\\$namespace_list",
                    "try_name" => $names_list,
                    "try_path" => JOINT_SITE_REQUIRE_DIR."/Application".$instance_dir."/".
                        $try_name.'.php',
                    "loaded" => false,
                );

                if(file_exists($try_load["try_path"])){
                    //require_once ($try_load["try_path"]);
                    $result_name = $try_load["try_name"];
                    $loaded_index = $deep;
                    $try_load["loaded"] = true;
                }else{

                    return "";
                }


                $app_log["load"][$instance_type][] = $try_load;


                break;
            }
        }

        /*
        if($instance_type == "Controller"){
            echo "<pre>";
            print_r($app_log["load"]);
            exit;
        }*/

        if(!$loaded_index){
            $loaded_index = 1;
        }

        require_once $app_log["load"][$instance_type][$loaded_index-1]["try_path"];

        return $result_name;
    }

    private function jsCheckAppControllerSettings($controller_name, $default_name="Controller"):bool
    {
        if($controller_name == $default_name and !USE_DEFAULT_CONTROLLER){
            JointSiteLogger::throwErr("request", $this->lang_map->app_err["request_controller"]);
        }
        return true;
    }

    private function jsLoadModelFromRequest():string
    {
        global $request, $app_log, $lang_app;

        //$default_model = "Model";
        $default_model = "Model_Pdo";

        $model_name = $default_model;

        require_once JOINT_SITE_REQUIRE_DIR."/Application/Core/".strtolower($default_model).".php";

        if($new_model_name = $this->jsLoadInstance("Model")){
            $model_name = $new_model_name;
        }

        $app_log["load"]["Model"][] = array("final_model_name" => $model_name);

        return $model_name;
    }

    private function jsCheckAppModelSettings($model_name, $default_model="Model_Pdo"):bool
    {
        global $lang_app;
        if($model_name == $default_model and !USE_DEFAULT_MODEL){
            JointSiteLogger::throwErr("request", $lang_app->app_err["request_model"]);
        }
        return true;
    }

    private function jsLoadViewFromRequest():string
    {
        global $request, $app_log, $lang_app;

        $default_name = "SiteView";
        $view_name = $default_name;

        require_once JOINT_SITE_REQUIRE_DIR."/application/core/View.php";
        require_once JOINT_SITE_REQUIRE_DIR."/application/views/SiteView.php";

        if($new_view_name = self::jsLoadInstance("View")){
            $view_name = $new_view_name;
        }

        $app_log["load"]["view"][] = array("final_view_name" => $view_name);
        return $view_name;
    }

    private function jsCheckAppViewSettings($view_name, $default_name="SiteView"):bool
    {
        global $lang_app;
        if($view_name == $default_name and !USE_DEFAULT_VIEW){
            JointSiteLogger::throwErr("request", $lang_app->app_err["request_view"]);;
        }
        return true;
    }

    private function jsGetActionFromRequest():string
    {
        global $request, $app_log;
        $action_name = "index";
        if (!empty($request["routes"][$app_log["Controller"]["deep"]+1])){
            $action_name = $request["routes"][$app_log["Controller"]["deep"]+1];
        }

        return $action_name;
    }

    private function jsExecAction($loaded_controller, $loaded_model, $loaded_view, $action_name):bool
    {
        global $js_result, $app_log;

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
                    JointSiteLogger::throwErr("request", $this->lang_map->app_err["request_action"].
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

    function jsHandleResult(bool $result)
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
            JointSiteLogger::displayErr($js_result["errType"], $js_result["message"]);
        }
    }
}