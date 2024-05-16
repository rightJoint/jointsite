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

        $this->view->lang_map->head["h1"] = $this->model->lang_map->stack_err[$errType]["h1"];
        $this->view->lang_map->head["title"] = $this->model->lang_map->stack_err[$errType]["title"];
        $this->view->lang_map->head["description"] = $this->model->lang_map->stack_err[$errType]["description"];
        $this->view->view_data = $this->model->lang_map->stack_err[$errType]["description"];
        $this->view->response_code = $this->model->response_codes[$errType];

        //view modal menu active to display sign in forms
        if($this->view->response_code == 403){
            $this->view->active_modal_menu = true;
        }

        $this->view->alert_message = $message;
        $this->view->generate();

        if($this->view->response_code != 200){
            http_response_code($this->view->response_code);
        }
    }
}