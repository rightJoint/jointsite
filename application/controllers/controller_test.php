<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/core/RecordsController.php";
class controller_test extends RecordsController
{
    function action_testErr()
    {
        jointSite::throwErr("XXX", "xxx");
    }

    function action_records()
    {
        $this->records_process(JOINT_SITE_ROOT_LANG."/test/records", "migrations_log", null);
    }

    function doAction_custom($action_name)
    {
        if(method_exists($this, $action_name)){
            $this->$action_name;
        }
    }
}