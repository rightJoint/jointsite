<?php
class controller_musicalb extends RecordsController
{
    public $process_url = JOINT_SITE_APP_REF."/test/musicAlb";
    function LoadModel_custom($action_name = null): string
    {
        require_once JOINT_SITE_REQUIRE_DIR."/application/models/test/records/model_records_musicalb.php";
        return "model_records_musicalb";
    }
}