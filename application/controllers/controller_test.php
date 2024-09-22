<?php
require_once JOINT_SITE_REQUIRE_DIR."/application/core/RecordsController.php";
class controller_test extends RecordsController
{
    public $process_path = JOINT_SITE_EXEC_DIR.JOINT_SITE_APP_REF."/test";
    public $default_table = "migrations_log";

    function action_testErr()
    {
        jointSite::throwErr("XXX", "xxx");
    }

    function action_index()
    {

        $this->records_process(JOINT_SITE_EXEC_DIR.JOINT_SITE_APP_REF."/test", "migrations_log", null);
    }
}