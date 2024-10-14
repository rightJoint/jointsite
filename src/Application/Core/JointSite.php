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

        define("JOINT_SITE_USERS_DIR", $this->document_root."/".$env["JOINT_SITE_USERS_DIR"]);
        define("JOINT_SITE_CONF_DIR", $this->document_root."/".$env["JOINT_SITE_CONFIG_DIR"]);
        define("JOINT_SITE_ROOT_DIR", $this->document_root);

        $this->jsLoadAppLang();
    }

    private function jsExplodeRequest()
    {
        define("JOINT_SITE_REQUIRE_DIR", $this->document_root."/Application");
        global $request;
        $request["routes_uri"] = $this->request_uri;
        $request["routes_path"] = explode('?', $request["routes_uri"])[0];
        $request["routes"] = explode('/', $request["routes_path"]);
        $request["routes_cnt"] = count($request["routes"]);
    }

    private function jsLangReq($acceptable_lang = array("en", "ru", ))
    {
        global $request;
        if(isset($request["routes"][1]) and in_array($request["routes"][1], $acceptable_lang)){

            define("JOINT_SITE_REQ_LANG", JOINT_SITE_REQUIRE_DIR."/LangFiles/".ucfirst($request["routes"][1]));
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
            define("JOINT_SITE_REQ_LANG", JOINT_SITE_REQUIRE_DIR."/LangFiles/Ru");
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

        $app_instances = self::jsLoadInstances();

        return $this->jsExecAction($app_instances);
    }

    private function jsSetAppConfig()
    {
        define("USE_DEFAULT_CONTROLLER", false);
        define("USE_DEFAULT_MODEL", true);
        define("USE_DEFAULT_VIEW", true);
        define("USE_DEFAULT_ACTION", false);
    }

    private function jsLoadInstances():array
    {
        global $request, $app_log;

        $return = array(
            "controller_name" => "",
            "action_name" => "",
            "model_name" => "",
            "view_name" => "",
        );

        if(!empty($request["routes"][1])){
            if($request["routes"][1] == "test"){
                if(empty($request["routes"][2])){
                    require_once JOINT_SITE_REQUIRE_DIR."/Controllers/Controller_Test.php";
                    require_once JOINT_SITE_REQUIRE_DIR."/Models/Model_Test.php";
                    require_once JOINT_SITE_REQUIRE_DIR."/Views/View_Test.php";
                    $return = array(
                        "controller_name" => "JointSite\Controllers\Controller_Test",
                        "action_name" => "action_index",
                        "model_name" => "JointSite\Models\Model_Test",
                        "view_name" => "JointSite\Views\View_Test",
                    );
                }elseif($request["routes"][2] == "migrationstest"){
                    if(empty($request["routes"][2])) {
                        require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Test/Controller_Test_MigrationsTest.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Core/Model.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Views/Test/View_Test_MigrationsTest.php";
                        $return = array(
                            "controller_name" => "JointSite\Controllers\Controller_Test",
                            "action_name" => "action_index",
                            "model_name" => "JointSite\Models\Model_Test",
                            "view_name" => "JointSite\Views\Test\View_Test_MigrationsTest",
                        );
                    }elseif($request["routes"][3] == "checkConnectServerStatus"){
                        require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Test/Controller_Test_MigrationsTest.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Models/Migrations/Model_Migrations.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Views/Test/View_Test_MigrationsTest.php";
                        $return = array(
                            "controller_name" => "JointSite\Controllers\Test\Controller_Test_MigrationsTest",
                            "action_name" => "action_checkConnectServerStatus",
                            "model_name" => "JointSite\Models\Migrations\Model_Migrations",
                            "view_name" => "JointSite\Views\Test\View_Test_MigrationsTest",
                        );
                    }elseif($request["routes"][3] == "createMigrationsTables"){
                        require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Test/Controller_Test_MigrationsTest.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Models/Migrations/Model_Migrations.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Views/Test/View_Test_MigrationsTest.php";
                        $return = array(
                            "controller_name" => "JointSite\Controllers\Test\Controller_Test_MigrationsTest",
                            "action_name" => "action_createMigrationsTables",
                            "model_name" => "JointSite\Models\Migrations\Model_Migrations",
                            "view_name" => "JointSite\Views\Test\View_Test_MigrationsTest",
                        );
                    }elseif($request["routes"][3] == "execNewMigrations"){
                        require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Test/Controller_Test_MigrationsTest.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Models/Migrations/Model_Migrations.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Views/Test/View_Test_MigrationsTest.php";
                        $return = array(
                            "controller_name" => "JointSite\Controllers\Test\Controller_Test_MigrationsTest",
                            "action_name" => "action_execNewMigrations",
                            "model_name" => "JointSite\Models\Migrations\Model_Migrations",
                            "view_name" => "JointSite\Views\Test\View_Test_MigrationsTest",
                        );
                    }elseif($request["routes"][3] == "migrationsList"){
                        require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Test/Controller_Test_MigrationsTest.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Core/Model.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Views/Test/View_Test_MigrationsTest.php";
                        $return = array(
                            "controller_name" => "JointSite\Controllers\Controller_Test",
                            "action_name" => "action_index",
                            "model_name" => "JointSite\Models\Model_Test",
                            "view_name" => "JointSite\Views\Test\View_Test_MigrationsTest",
                        );
                    }elseif($request["routes"][3] == "migrationsLog"){
                        require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Test/Controller_Test_MigrationsTest.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Core/Model.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Views/Test/View_Test_MigrationsTest.php";
                        $return = array(
                            "controller_name" => "JointSite\Controllers\Controller_Test",
                            "action_name" => "action_index",
                            "model_name" => "JointSite\Models\Model_Test",
                            "view_name" => "JointSite\Views\Test\View_Test_MigrationsTest",
                        );
                    }else{
                        JointSiteLogger::throwErr("XXX", "load_instance: unknown type (xxx-3)");
                    }
                }else{
                    JointSiteLogger::throwErr("XXX", "load_instance: unknown type (xxx-2)");
                }
            }else{
                JointSiteLogger::throwErr("XXX", "load_instance: unknown type (xxx-1)");
            }
        }else{
            //Main
            require_once JOINT_SITE_REQUIRE_DIR."/Controllers/Controller_Main.php";
            require_once JOINT_SITE_REQUIRE_DIR."/Models/Model_Main.php";
            require_once JOINT_SITE_REQUIRE_DIR."/Views/View_Main.php";
            $return = array(
                "controller_name" => "JointSite\Controllers\Controller_Main",
                "action_name" => "action_index",
                "model_name" => "JointSite\Models\Model_Main",
                "view_name" => "JointSite\Views\View_Main",
            );
        }

        return $return;
    }

    private function jsExecAction($app_instances):bool
    {
        global $js_result;

        if(isset($js_result["error"]) and $js_result["error"] == true){
            return false;
        }

        $controller = new $app_instances["controller_name"]($app_instances["model_name"],
            $app_instances["view_name"],
            $app_instances["action_name"]);

        $action = $app_instances["action_name"];

        if(method_exists($controller, $action)){
            $controller->$action();
            if(isset($js_result["error"]) and $js_result["error"] == true){
                return false;
            }
        }
        else{
            if(!USE_DEFAULT_ACTION){
                JointSiteLogger::throwErr("request", $this->lang_map->app_err["request_action"].
                    "<br>".$app_instances["controller_name"]."->".$action);
            }else{
                $controller->action_index();
                if(isset($js_result["error"]) and $js_result["error"] == true){
                    return false;
                }
            }
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