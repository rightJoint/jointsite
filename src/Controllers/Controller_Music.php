<?php


namespace Src\Controllers;


use JointApp\Controllers\Components\Controller_Components_MusicAlb;
use Src\Controllers\Controller_Music_Alb;
use JointApp\Controllers\Controller;
use JointApp\Controllers\Records\RecordsController;
use JointApp\Factories\ModelFactory;
use JointApp\JointAppQueryBuilder;
use Src\Models\Music\Model_Music_Tracks;

class Controller_Music extends Controller
{

    public function actionIndex()
    {
        $this->view->newAlbums = $this->model->getNewAlbums();
        $this->view->albumsCount = $this->model->countRecords(new JointAppQueryBuilder());
        $modelMusicTracks = ModelFactory::createFromExistModel('Src\Models\Music\Model_Music_Tracks', $this->model);
        $this->view->newTracks = $modelMusicTracks->getNewTracks();
        $this->view->tracksCount =$modelMusicTracks->countRecords(new JointAppQueryBuilder());
    }

    function actionAlbums()
    {
        $controllerAlb = new Controller_Music_Alb($this->getRequest(), $this->model, $this->view, []);
        $controllerAlb->getListView();
        //$this->getListView();
        //$this->view->process_url = "/music/albums";
        //$arr = $this->getListRecords();
    }

    public function actionPlayAlbum()
    {
        echo '<pre>';
        print_r($this->routes_ns);
        exit;
        global $request;
        if(isset($this->routes_ns[3]) and $request["routes"][$request["exec_dir_cnt"]+2]!=null){
            $playAlb = $this->model->listRecords("where musicAlb.albumAlias='".$request["routes"][$request["exec_dir_cnt"]+2]."'");
            if(isset($playAlb[0])){
                $this->view->playAlb = $playAlb[0];
                $this->view->albumsList = $this->model->listRecords();
                require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                    "/application/models/music/model_musicalbum.php";
                $model_musicalbum = new model_musicalbum();
                $this->view->trackList = $model_musicalbum->listRecords("where musicTracksToAlb.album_id='".$this->view->playAlb["album_id"]."'",
                    " order by musicTracksToAlb.sortDate desc ");
                $this->view->generate();
            }else{
                jointSite::throwErr("notFound", "album-not-found");
            }
        }else{
            jointSite::throwErr("request", null);
        }
    }
}