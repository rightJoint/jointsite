<?php
//include "application/views/music/musicView.php";

class Controller_Music extends Controller
{
    //function __construct()
   // {
    //    $this->model = new Model_Music();
    //    $this->view = new musicView();
    //}


    function action_index()
    {
        $this->action_album();
    }

    function action_album()
    {
        require_once JOINT_SITE_CONF_DIR."/music_dir.php";
        global $request;
        //echo "<pre>";
        //print_r($request);
        if(isset($request["routes"][3]) and $request["routes"][3]!=null){
            $this->view->playAlb = $this->model->getPlayAlb($request["routes"][3]);

            $this->view->albumsList =  $this->model->getAlbumsList();

            $this->view->trackList = $this->model->getAlbTracksList($this->view->playAlb["album_id"]);

            $this->view->generate();
        }else{
            //echo
        }

    }

}