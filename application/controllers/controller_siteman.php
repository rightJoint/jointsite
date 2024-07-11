<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/core/RecordsController.php";
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/core/ModuleController.php";
class controller_siteman extends ModuleController
{
    public $sm_process_url = JOINT_SITE_EXEC_DIR."/siteman";

    function __construct($loaded_model, $loaded_view, $action_name)
    {
        if(!isset($_SESSION[JS_SAIK]["site_user"]["user_id"])){
            jointSite::throwErr("access", "auth in siteman required");
        }
        parent::__construct($loaded_model, $loaded_view, $action_name);
    }

    function load_module_view($type_of_view)
    {
        $parent_view = parent::load_module_view($type_of_view);
        if($type_of_view == "ModulesList"){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/templates/Siteman_ModulesListView.php";
            return "Siteman_ModulesListView";
        }else{
            return $parent_view;
        }
    }

    function action_index()
    {

        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/views/templates/ModulesListView.php";
        $this->view->sm_process_url = $this->sm_process_url;
        $this->view = new ModulesListView();

        $this->view->generate();
    }

    function action_users()
    {
        $this->module_process("users", $this->sm_process_url."/users");
    }

    function action_groups()
    {
        $this->module_process("groups", $this->sm_process_url."/groups");
    }

    function action_notifications()
    {
        $this->module_process("notifications", $this->sm_process_url."/notifications");
    }

    function action_music()
    {
        require_once JOINT_SITE_CONF_DIR."/music_dir.php";
        $this->module_process("music", $this->sm_process_url."/music");
    }

    function action_sitemap()
    {
        global $request;
        require_once JOINT_SITE_CONF_DIR."/sitemap_dir.php";
        if(isset($request["routes"][$request["exec_dir_cnt"]+2]) and $request["routes"][$request["exec_dir_cnt"]+2] == "sitemapupdate"){
            $model_name = $this->load_module_model("sitemap", "sitemapupdate");
            $this->model = new $model_name();
            $view_data = $this->model->update_sitemap();
            $this->view->module_config = $this->load_module_config("sitemap");
            $this->view->m_process_url = $this->sm_process_url."/sitemap";
            $this->view->module_name = "sitemap";
            $this->view->view_data = $view_data;
            $this->view->generate();
        }else{
            $this->module_process("sitemap", $this->sm_process_url."/sitemap");
        }
    }
}