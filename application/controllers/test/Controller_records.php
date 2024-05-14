<?php
define("MUSIC_COVERS_DIR", JOINT_SITE_EXEC_DIR."/userdata_test/music/covers");
define("MUSIC_TRACKS_DIR", JOINT_SITE_EXEC_DIR."/userdata_test/music/tracks");
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
    function action_table()
    {
        global $request;
        if($request["routes"][$request["exec_dir_cnt"]+3]){
            $this->records_process(JOINT_SITE_EXEC_DIR."/test/records/table/".$request["routes"][$request["exec_dir_cnt"]+3],
                $request["routes"][$request["exec_dir_cnt"]+3]);
        }else{
            jointSite::throwErr("request", $this->lang_map->test_rc_err_table);
        }
    }

    function LoadCntrlLang_custom()
    {
        parent::LoadCntrlLang_custom();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/controllers/test/lang_cntrl_testrec_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_cntrl_testrec_".$_SESSION[JS_SAIK]["lang"];
    }
}