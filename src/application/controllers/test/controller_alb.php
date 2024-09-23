<?php
require_once JOINT_SITE_REQUIRE_DIR."/application/models/test/records/model_records_musicalb.php";
class controller_alb extends RecordsController
{
    public $process_path = JOINT_SITE_EXEC_DIR.JOINT_SITE_APP_REF."/test/alb";
    function LoadModel_custom($action_name = null): string
    {
        require_once JOINT_SITE_REQUIRE_DIR."/application/models/test/records/model_records_musicalb.php";
        return "model_records_musicalb";
    }
}