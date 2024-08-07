<?php
class Controller {
    public $model;
    public $view;

    public $lang_map;

    function __construct($loaded_model, $loaded_view, $action_name)
    {
        $lang_class = $this->LoadCntrlLang();
        $this->lang_map = new $lang_class;

        if($custom_model = $this->LoadModel_custom($action_name)){
            $loaded_model = $custom_model;
        }

        if($custom_view = $this->LoadView_custom($action_name)){
            $loaded_view = $custom_view;
        }

        $this->model = new $loaded_model();
        $this->view = new $loaded_view();
        $this->view->controller_action = $action_name;
    }

    function LoadView_custom($action_name = null)
    {

    }

    function LoadModel_custom($action_name = null)
    {

    }

    function LoadCntrlLang()
    {
        global $request;
        require_once ($_SERVER["DOCUMENT_ROOT"].$request["exec_path"].
            "/application/lang_files/controllers/lang_cntrl_".$_SESSION[JS_SAIK]["lang"].".php");
        $return_lang = "lang_cntrl_".$_SESSION[JS_SAIK]["lang"];

        if($custom_lang = $this->LoadCntrlLang_custom()){
            $return_lang = $custom_lang;
        }

        return $return_lang;

    }

    function LoadCntrlLang_custom()
    {

    }

    function action_index()
    {
        $this->view->view_data = $this->model->get_data();
        $this->view->generate();
    }
}