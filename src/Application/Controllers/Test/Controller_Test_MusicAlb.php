<?php

use jointSite\Core\Records\RecordsController;

class Controller_Test_MusicAlb extends RecordsController
{
    public $process_url = JOINT_SITE_SL_LANG."/test/musicAlb";
    function LoadModel_custom($action_name = null): string
    {
        require_once JOINT_SITE_REQUIRE_DIR."/application/models/test/records/model_records_musicalb.php";
        return "model_records_musicalb";
    }
}