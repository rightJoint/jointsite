<?php

namespace JointSite\Core;

use JointSite\Core\Interfaces;
use JointSite\Core\Logger\JointSiteLoggerTrait;

class Controller implements Interfaces\ControllerInterface
{
    use JointSiteLoggerTrait;

    public $model;
    public $view;

    public $lang_map;

    function __construct(string $loaded_model, string $loaded_view, string $action_name)
    {

        $this->setLogger("JointSite\Core\Controller");

        $lang_class = $this->loadLangController();
        $this->lang_map = new $lang_class;

        $this->model = new $loaded_model();
        $this->view = new $loaded_view();
        $this->view->controller_action = $action_name;
    }

    private function loadLangController():string
    {
        require_once (JOINT_SITE_REQ_LANG."/Controllers/LangFiles_".JOINT_SITE_NS_LANG."_Controllers_Controller.php");

        $return_lang = "LangFiles_".JOINT_SITE_NS_LANG."_Controllers_Controller";

        if($custom_lang = $this->loadLangControllerCustom()){
            $return_lang = $custom_lang;
        }

        return $return_lang;
    }

    function loadLangControllerCustom():string
    {
        return "";
    }

    function action_index()
    {
        $this->view->view_data = $this->model->getData();
        $this->view->generate();
    }
}