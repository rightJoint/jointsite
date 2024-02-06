<?php
include "application/views/music/musicView.php";

class Controller_Music extends Controller
{
    function __construct()
    {

        $this->model = new Model_Music();
        $this->view = new musicView();

    }


    function action_index()
    {
        $this->action_album();
    }

    function action_album()
    {
        global $routes;
        $this->view->playAlb = $this->model->getPlayAlb($routes[3]);

        $this->view->albumsList =  $this->model->getAlbumsList();

        $this->view->trackList = $this->model->getAlbTracksList($this->view->playAlb["album_id"]);

        if(!$this->view->playAlb["robIndex"]){
            $this->view->metrik_block = false;
            $this->view->robot_no_index = true;
        }
        $this->view->lang_map["head"]["title"] = array(
           "en" => "Music-".$this->view->playAlb["albumName"],
            "rus" => "Музыка -".$this->view->playAlb["albumName"],
        );
        $this->view->lang_map["head"]["description"] = array(
            "en" => $this->view->playAlb["metaDescr"],
            "rus" => $this->view->playAlb["metaDescr"],
        );

        $this->view->generate();
    }

}