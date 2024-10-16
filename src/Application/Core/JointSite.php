<?php

namespace JointSite\Core;

use JointSite\Core\Interfaces\JointSiteInterface;
use JointSite\Core\Logger\JointSiteLoggerTrait;

class JointSite implements JointSiteInterface
{

    use JointSiteLoggerTrait;

    public $document_root;
    public $request_uri;
    public $lang_map;

    public function __construct()
    {
        $this->setLogger("Core\JointSite");
    }

    function jsRun()
    {
        global $mct, $js_result;

        $js_result["error"] = false;                    //:bool false if no err

        $mct['start_time'] = microtime(true);

        $this->jsPrepareRequest();

        $app_instances = self::jsLoadInstances();
        $result = $this->jsExecAction($app_instances);

        $this->jsHandleResult($result);
    }

    public function jsPrepareRequest()
    {
        $this->jsExplodeRequest();
        $this->jsLangReq();
        $env = $this->jsGetEnv();

        define("JOINT_SITE_USERS_DIR", "/".$env["JOINT_SITE_USERS_DIR"]);
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
    }

    private function jsLangReq($acceptable_lang = array("en", "ru", ))
    {
        global $request;
        if(isset($request["routes"][1]) and in_array(strtolower($request["routes"][1]), $acceptable_lang)){
            /*shortcut to lang_files*/
            define("JOINT_SITE_REQ_LANG", JOINT_SITE_REQUIRE_DIR."/LangFiles/".ucfirst($request["routes"][1]));
            /*wildcard for namespaces*/
            define("JOINT_SITE_NS_LANG", ucfirst($request["routes"][1]));
            /*wildcard for lang_arrays*/
            define("JOINT_SITE_LW_LANG", strtolower($request["routes"][1]));
            /*wildcard for hrefs contains slash*/
            define("JOINT_SITE_SL_LANG", "/".strtolower($request["routes"][1]));
            /*wildcard for hrefs parts after lang*/
            $pos_lang = strpos($request["routes_uri"], JOINT_SITE_SL_LANG);
            define("JOINT_SITE_LP_LANG",
                substr($request["routes_uri"], $pos_lang + strlen(JOINT_SITE_SL_LANG),
                    strlen($request["routes_uri"])));
            /*routes_ns logic part of request*/
            $request["routes_ns"] = $request["routes"];
            array_splice($request["routes_ns"], 1,1);
        }else{
            /*default lang: ru */
            /*shortcut to lang_files*/
            define("JOINT_SITE_REQ_LANG", JOINT_SITE_REQUIRE_DIR."/LangFiles/Ru");
            /*wildcard for namespaces*/
            define("JOINT_SITE_NS_LANG", "Ru");
            /*wildcard for lang_arrays*/
            define("JOINT_SITE_LW_LANG", "ru");
            /*wildcard for hrefs contains slash*/
            define("JOINT_SITE_SL_LANG", "");
            /*wildcard for hrefs parts after lang*/
            define("JOINT_SITE_LP_LANG", substr($request["routes_uri"], 0,
                strlen($request["routes_uri"])));
            /*routes_ns logic part of request*/
            $request["routes_ns"] = $request["routes"];
        }
    }

    private function jsLoadAppLang()
    {
        require_once (JOINT_SITE_REQ_LANG."/LangFiles_".JOINT_SITE_NS_LANG."_App.php");
        $lang_app_name = "LangFiles_".JOINT_SITE_NS_LANG."_App";
        //$lang_app_name = "LangFiles_Ru_App";
        $this->lang_map = new $lang_app_name();
    }

    public function jsGetEnv():array
    {
        return parse_ini_file('.env');
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

        $this->logger->info("request", $this->lang_map->app_err["request_action"].
            "<br>".$app_instances["controller_name"]."->".$action);

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
            if(!isset($js_result["view_generateJson_called"])){
                $this->logger->displayErr($js_result["errType"], $js_result["message"]);
            }
        }
    }

    //find routes and return instances names
    private function jsLoadInstances():array
    {
        global $request, $app_log;

        $return = array(
            "controller_name" => "",
            "action_name" => "",
            "model_name" => "",
            "view_name" => "",
        );

        if(!empty($request["routes_ns"][1])){
            if($request["routes_ns"][1] == "test"){
                if(empty($request["routes_ns"][2])){
                    require_once JOINT_SITE_REQUIRE_DIR."/Controllers/Controller_Test.php";
                    require_once JOINT_SITE_REQUIRE_DIR."/Models/Model_Test.php";
                    require_once JOINT_SITE_REQUIRE_DIR."/Views/View_Test.php";
                    $return = array(
                        "controller_name" => "JointSite\Controllers\Controller_Test",
                        "action_name" => "action_index",
                        "model_name" => "JointSite\Models\Model_Test",
                        "view_name" => "JointSite\Views\View_Test",
                    );
                }elseif($request["routes_ns"][2] == "migrationstest"){
                    if(empty($request["routes_ns"][2])) {
                        require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Test/Controller_Test_MigrationsTest.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Core/Model.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Views/Test/View_Test_MigrationsTest.php";
                        $return = array(
                            "controller_name" => "JointSite\Controllers\Controller_Test",
                            "action_name" => "action_index",
                            "model_name" => "JointSite\Models\Model_Test",
                            "view_name" => "JointSite\Views\Test\View_Test_MigrationsTest",
                        );
                    }elseif(empty($request["routes_ns"][3])) {
                        require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Test/Controller_Test_MigrationsTest.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Models/Migrations/Model_Migrations.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Views/Test/View_Test_MigrationsTest.php";
                        $return = array(
                            "controller_name" => "JointSite\Controllers\Test\Controller_Test_MigrationsTest",
                            "action_name" => "action_index",
                            "model_name" => "JointSite\Models\Model_Test",
                            "view_name" => "JointSite\Views\Test\View_Test_MigrationsTest",
                        );
                    }elseif($request["routes_ns"][3] == "checkConnectServerStatus"){
                        require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Test/Controller_Test_MigrationsTest.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Models/Migrations/Model_Migrations.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Views/Test/View_Test_MigrationsTest.php";
                        $return = array(
                            "controller_name" => "JointSite\Controllers\Test\Controller_Test_MigrationsTest",
                            "action_name" => "action_checkConnectServerStatus",
                            "model_name" => "JointSite\Models\Migrations\Model_Migrations",
                            "view_name" => "JointSite\Views\Test\View_Test_MigrationsTest",
                        );
                    }elseif($request["routes_ns"][3] == "createMigrationsTables"){
                        require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Test/Controller_Test_MigrationsTest.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Models/Migrations/Model_Migrations.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Views/Test/View_Test_MigrationsTest.php";
                        $return = array(
                            "controller_name" => "JointSite\Controllers\Test\Controller_Test_MigrationsTest",
                            "action_name" => "action_createMigrationsTables",
                            "model_name" => "JointSite\Models\Migrations\Model_Migrations",
                            "view_name" => "JointSite\Views\Test\View_Test_MigrationsTest",
                        );
                    }elseif($request["routes_ns"][3] == "execNewMigrations"){
                        require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Test/Controller_Test_MigrationsTest.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Models/Migrations/Model_Migrations.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Views/Test/View_Test_MigrationsTest.php";
                        $return = array(
                            "controller_name" => "JointSite\Controllers\Test\Controller_Test_MigrationsTest",
                            "action_name" => "action_execNewMigrations",
                            "model_name" => "JointSite\Models\Migrations\Model_Migrations",
                            "view_name" => "JointSite\Views\Test\View_Test_MigrationsTest",
                        );
                    }elseif($request["routes_ns"][3] == "migrationsList"){
                        require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Test/MigrationsTest/Controller_Test_MigrationsTest_MigrationsList.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Models/Migrations/Model_Migrations.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Views/Test/View_Test_MigrationsTest.php";

                        $return = array(
                            "controller_name" => "JointSite\Controllers\Test\MigrationsTest\Controller_Test_MigrationsTest_MigrationsList",
                            "action_name" => "action_index",
                            "model_name" => "JointSite\Models\Migrations\Model_Migrations",
                            "view_name" => "JointSite\Views\Test\View_Test_MigrationsTest",
                        );
                    }elseif($request["routes_ns"][3] == "migrationsLog"){
                        require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Test/MigrationsTest/Controller_Test_MigrationsTest_MigrationsLog.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Models/Migrations/Model_Migrations.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Views/Test/View_Test_MigrationsTest.php";

                        $view_name = "JointSite\Views\Test\View_Test_MigrationsTest";

                        if(isset($request["routes_ns"][4]) and $request["routes_ns"][4] == "detailview"){
                            require_once JOINT_SITE_REQUIRE_DIR . "/Views/Migrations/View_Migrations_MigrationLogDetail.php";
                            $view_name = "JointSite\Views\Migrations\View_Migrations_MigrationLogDetail";
                        }

                        $return = array(
                            "controller_name" => "JointSite\Controllers\Test\MigrationsTest\Controller_Test_MigrationsTest_MigrationsLog",
                            "action_name" => "action_index",
                            "model_name" => "JointSite\Models\Migrations\Model_MigrationsLog",
                            "view_name" => $view_name,
                        );
                    }else{
                        $this->logger->error("route in migrationstest not found", $this->logger->logger_context);
                    }
                }elseif ($request["routes_ns"][2] == "records"){

                    require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Controller_Test.php";
                    //require_once JOINT_SITE_REQUIRE_DIR . "/Models/Migrations/Model_Migrations.php";
                    require_once JOINT_SITE_REQUIRE_DIR . "/Views/Test/View_Test_MigrationsTest.php";

                    $return = array(
                        "controller_name" => "JointSite\Controllers\Controller_Test",
                        "action_name" => "action_records",
                        "model_name" => "JointSite\Core\Records\RecordsModel",
                        "view_name" => "JointSite\Views\Test\View_Test_Records",
                    );
                }elseif ($request["routes_ns"][2] == "musicAlb") {
                    require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Test/Controller_Test_MusicAlb.php";
                    require_once JOINT_SITE_REQUIRE_DIR . "/Models/Test/Records/Model_Test_Records_MusicAlb.php";
                    require_once JOINT_SITE_REQUIRE_DIR . "/Views/SiteView.php";

                    $return = array(
                        "controller_name" => "JointSite\Controllers\Test\Controller_Test_MusicAlb",
                        "action_name" => "action_index",
                        "model_name" => "JointSite\Models\Test\Records\Model_Test_Records_MusicAlb",
                        "view_name" => "JointSite\Views\SiteView",
                    );
                }elseif ($request["routes_ns"][2] == "musicTracks") {
                    require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Test/Controller_Test_MusicTracks.php";
                    require_once JOINT_SITE_REQUIRE_DIR . "/Models/Test/Records/Model_Test_Records_MusicTracks.php";
                    require_once JOINT_SITE_REQUIRE_DIR . "/Views/SiteView.php";

                    $return = array(
                        "controller_name" => "JointSite\Controllers\Test\Controller_Test_MusicTracks",
                        "action_name" => "action_index",
                        "model_name" => "JointSite\Models\Test\Records\Model_Test_Records_MusicTracks",
                        "view_name" => "JointSite\Views\SiteView",
                    );
                }elseif ($request["routes_ns"][2] == "musicTracksToAlb") {
                    $this->logger->error("route in test not found", $this->logger->logger_context);
                }else{
                    $this->logger->error("route in test not found", $this->logger->logger_context);
                }
            }elseif($request["routes_ns"][1] == "api"){
                if(isset($request["routes_ns"][2]) and $request["routes_ns"][2] == "records"){
                    if(isset($request["routes_ns"][3]) and $request["routes_ns"][3] !== null){
                        require_once JOINT_SITE_REQUIRE_DIR . "/Controllers/Api/Controller_Api_Records.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Core/Model.php";
                        require_once JOINT_SITE_REQUIRE_DIR . "/Core/View.php";

                        $return = array(
                            "controller_name" => "JointSite\Controllers\Api\Controller_Api_Records",
                            "action_name" => "action_index",
                            "model_name" => "JointSite\Core\Model",
                            "view_name" => "JointSite\Core\View",
                        );
                    }else{
                        $this->logger->error("no table for api records", $this->logger->logger_context);
                    }
                }else{
                    $this->logger->error("route in api not found", $this->logger->logger_context);
                }
            }else{
                $this->logger->error("route in root not found", $this->logger->logger_context);
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
}