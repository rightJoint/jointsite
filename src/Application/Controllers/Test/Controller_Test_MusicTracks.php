<?php

use jointSite\Core\Records\RecordsController;

class Controller_Test_MusicTracks extends RecordsController
{
    public $process_url = JOINT_SITE_APP_REF."/test/musicTracks";
    function LoadModel_custom($action_name = null): string
    {
        require_once JOINT_SITE_REQUIRE_DIR."/application/models/test/records/model_records_musictracks.php";
        return "model_records_musictracks";
    }
}