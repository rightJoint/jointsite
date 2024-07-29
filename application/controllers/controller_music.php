<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/core/RecordsController.php";
class Controller_Music extends RecordsController
{
    public $music_path = "/music";

    function __construct($loaded_model, $loaded_view, $action_name)
    {
        require_once JOINT_SITE_CONF_DIR."/music_dir.php";
        parent::__construct($loaded_model, $loaded_view, $action_name);
    }

    function LoadModel_custom($action_name = null)
    {
        if ($action_name == "tracks"){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/models/music/model_musictracks.php";
            return "model_musictracks";
        }
    }

    function LoadView_custom($action_name = null)
    {
        if($action_name == "index"){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/music/view_music_main.php";
            return "view_music_main";
        }elseif ($action_name == "albums"){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/music/view_music_albums.php";
            return "view_music_albums";
        }elseif ($action_name == "tracks"){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/music/view_music_tracks.php";
            return "view_music_tracks";
        }elseif ($action_name == "album"){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/music/view_music_playalb.php";
            return "view_music_playalb";
        }
    }

    function action_index()
    {
        $this->view->new_albums = $this->model->getNewAlbums();
        $this->view->albums_count = $this->model->countRecords();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/models/music/model_musictracks.php";
        $model_musictracks = new model_musictracks();
        $this->view->listRecords = $model_musictracks->getNewTracks();
        $this->view->tracks_count =$model_musictracks->countRecords();
        $this->view->generate();
    }

    function action_album()
    {
        global $request;
        if(isset($request["routes"][$request["exec_dir_cnt"]+2]) and $request["routes"][$request["exec_dir_cnt"]+2]!=null){
            $this->view->playAlb = $this->model->listRecords("where musicAlb.albumAlias='".$request["routes"][$request["exec_dir_cnt"]+2]."'")[0];
            $this->view->albumsList = $this->model->listRecords();
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/models/music/model_musicalbum.php";
            $model_musicalbum = new model_musicalbum();
            $this->view->trackList = $model_musicalbum->listRecords("where musicTracksToAlb.album_id='".$this->view->playAlb["album_id"]."'",
            " order by musicTracksToAlb.sortDate desc ");
            $this->view->generate();
        }else{
            jointSite::throwErr("request", null);
        }
    }

    function action_albums()
    {
        $this->records_process(JOINT_SITE_EXEC_DIR."/music/albums");
    }

    function action_tracks()
    {
        $this->records_process(JOINT_SITE_EXEC_DIR."/music/tracks");
    }

}