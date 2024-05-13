<?php
define("MUSIC_COVERS_DIR", JOINT_SITE_EXEC_DIR."/music/covers");
define("MUSIC_TRACKS_DIR", JOINT_SITE_EXEC_DIR."/music/tracks");
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/core/RecordsController.php";
class Controller_records extends RecordsController
{
    function action_musicalb()
    {
        $this->records_process(JOINT_SITE_EXEC_DIR."/test/records/musicalb");
    }
    function action_musictracks()
    {
        $this->records_process(JOINT_SITE_EXEC_DIR."/test/records/musictracks");
    }
    function action_musictrackstoalb()
    {
        $this->records_process(JOINT_SITE_EXEC_DIR."/test/records/musictrackstoalb");
    }
}