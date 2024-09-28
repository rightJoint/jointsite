<?php
require_once JOINT_SITE_REQUIRE_DIR."/application/core/Interfaces/ControllerInterface.php";
class Controller implements ControllerInterface
{
    public $model;
    public $view;

    public $lang_map;

    function __construct(string $loaded_model, string $loaded_view, string $action_name)
    {
        $lang_class = $this->LoadCntrlLang();
        $this->lang_map = new $lang_class;

        global $app_log;
        if($custom_model = $this->LoadModel_custom($action_name)){
            $app_log["load"]["model"][] = array(
                "try_name" => $custom_model,
                "try_path" => "Controller __construct LoadModel_custom",
                "loaded" => true,
            );
            $loaded_model = $custom_model;
        }

        if($custom_view = $this->LoadView_custom($action_name)){
            $loaded_view = $custom_view;
            $app_log["load"]["view"][] = array(
                "try_name" => $custom_model,
                "try_path" => "Controller __construct LoadModel_custom",
                "loaded" => true,
            );
        }

        $this->model = new $loaded_model();
        $this->view = new $loaded_view();
        $this->view->controller_action = $action_name;
    }

    function LoadView_custom($action_name = null):string
    {
        return "";
    }

    function LoadModel_custom($action_name = null):string
    {
        return "";
    }

    private function LoadCntrlLang():string
    {
        require_once (JOINT_SITE_REQ_LANG."/controllers/lang_cntrl.php");
        $return_lang = "lang_cntrl";

        if($custom_lang = $this->LoadCntrlLang_custom()){
            $return_lang = $custom_lang;
        }

        return $return_lang;
    }

    function LoadCntrlLang_custom():string
    {
        return "";
    }

    function action_index()
    {
        $this->view->view_data = $this->model->get_data();
        $this->view->generate();
    }
}