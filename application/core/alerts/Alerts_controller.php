<?php
class Alerts_controller extends Controller
{
    function __construct()
    {
        $this->model = new Alerts_model();
        $this->view = new Alerts_View();
    }
    function generateErr($errType, $message)
    {
        if($_GET["errType"]){
            $errType = $_GET["errType"];
            if($_GET["message"]){
                $message = $_GET["message"];
            }
        }

        foreach ($this->model->lang_map->stack_err as $err_type => $err_info){
            if ($errType == $err_type) {
                $this->view->lang_map->head["h1"] = $err_info["h1"];
                $this->view->lang_map->head["title"] = $err_info["title"];
                $this->view->lang_map->head["description"] = $err_info["description"];
                $this->view->view_data = $err_info["description"];
                $this->view->response_code = $this->model->response_codes[$err_type];
                break;
            }
        }
        $this->view->alert_message = $message;
        $this->view->generate();

        if($this->view->response_code != 200){
            http_response_code($this->view->response_code);
        }
    }
}