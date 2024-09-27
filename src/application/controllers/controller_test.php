<?php
require_once JOINT_SITE_REQUIRE_DIR."/application/core/RecordsController.php";

define("PATH_TO_MIGRATIONS", JOINT_SITE_REQUIRE_DIR."/migrations");

class controller_test extends RecordsController
{
    public $process_url = JOINT_SITE_EXEC_DIR.JOINT_SITE_APP_REF."/test";
    public $process_table = "rjt_musicAlb";

    function action_index()
    {
        $this->view->generate();
    }

    function action_records()
    {
        echo "test-records";
    }

}