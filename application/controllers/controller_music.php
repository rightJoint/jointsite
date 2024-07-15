<?php
class Controller_Music extends Controller
{
    function action_index()
    {
        $this->action_album();
    }

    function action_album()
    {
        require_once JOINT_SITE_CONF_DIR."/music_dir.php";
        global $request;
        if(isset($request["routes"][$request["exec_dir_cnt"]+2]) and $request["routes"][$request["exec_dir_cnt"]+2]!=null){
            $this->view->playAlb = $this->model->getPlayAlb($request["routes"][$request["exec_dir_cnt"]+2]);

            $this->view->albumsList =  $this->model->getAlbumsList();

            $this->view->trackList = $this->model->getAlbTracksList($this->view->playAlb["album_id"]);

            $this->view->generate();
        }else{
            jointSite::throwErr("request", null);
        }
    }

}