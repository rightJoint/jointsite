<?php
class Application
{
    static function run()
    {
        $lang_map = array(
            "app_err" => array(
                "request_model" => array(
                    "en" => "model path not valid",
                    "rus" => "модель, неверный путь"
                ),
                "request_controller" => array(
                    "en" => "controller path not valid",
                    "rus" => "контроллер, неверный путь"
                ),
                "request_action" => array(
                    "en" => "action not exist",
                    "rus" => "действия не существует"
                ),
            )
        );

        if($_GET["lang"]=="en"){
            $_SESSION["lang"] = "en";
        }elseif($_GET["lang"]=="rus"){
            $_SESSION["lang"] = "rus";
        }elseif(!$_SESSION["lang"]){
            $_SESSION["lang"]="rus";
        }

        $controller_name = 'Main';
        $action_name = 'index';

        global $routes;

        define("JOINT_CONF_DIR", "__config");

        include JOINT_CONF_DIR."/dir_const.php";

        $routes = explode('?', $_SERVER['REQUEST_URI'])[0];
        $routes = explode('/', $routes);

        if ( !empty($routes[1]) ){
            $controller_name = $routes[1];
        }

        if ( !empty($routes[2]) ){
            $action_name = $routes[2];
        }

        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;

        $model_file = strtolower($model_name).'.php';
        $model_path = "application/models/".$model_file;

        if(file_exists($model_path)){
            include "application/models/".$model_file;
        }else{
            throwErr("request", $lang_map["app_err"]["request_model"][$_SESSION["lang"]]);
        }

        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;

        if(file_exists($controller_path)){
            include "application/controllers/".$controller_file;
        }
        else{
            throwErr("request", $lang_map["app_err"]["request_controller"][$_SESSION["lang"]]);
        }

        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action)){
            $controller->$action();
        }
        else{
            throwErr("request", $lang_map["app_err"]["request_action"][$_SESSION["lang"]]);
        }
    }
}