<?php
include "application/core/Records/RecordsController.php";
include "application/core/Module/ModuleRecordsController.php";

class Controller_Siteman extends ModuleRecordsController
{
    public $modules;

    function __construct()
    {
        $this->lang_map["menu-index-warning"] = array(
            "en" => "denied in controller siteman action index",
            "rus" => "Ошибка доступа в controller siteman action index",
        );

        $modulesInfo = null;
        require_once JOINT_CONF_DIR."/modulesInfo.php";

        $this->modules = $modulesInfo;

        parent::__construct();
    }

    function action_groups()
    {
        $this->module_process("groups");
    }

    function action_users()
    {
        $this->module_process("users");
    }

    function action_notifications()
    {

        if($this->fillDataList()){
            return true;
        }
        $this->module_process("notifications");
    }
}