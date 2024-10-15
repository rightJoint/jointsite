<?php
class controller_records extends controller_api
{
    public $process_path = JOINT_SITE_SL_LANG."/api/records";
    public $default_table = "migrations_log";

    function __construct($loaded_model, $loaded_view, $action_name)
    {
        parent::__construct($loaded_model, $loaded_view, $action_name);
        $this->view->header_content_type = "application/json; charset=utf-8";
    }

    function LoadView_custom($action_name = null):string
    {
        return "View";
    }

    function action_index()
    {
        $this->process_path = JOINT_SITE_SL_LANG."/api/records";
        $this->default_table = "migrations_log";

        parent::action_index();
        //$this->records_process($this->process_path, "migrations_log", null);
    }

    function action_users_dt()
    {
        $this->records_process(JOINT_SITE_SL_LANG."/api/records/users_dt", "migration_log", null);
    }
}