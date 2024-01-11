<?php
class musicView extends View
{
    public $albumsList  = null;
    public $playAlb = null;
    public $trackList = null;

    function __construct()
    {
        $this->logo = "/img/popimg/music-logo.png";
        $this->shortcut_icon = $this->logo;
        $this->lang_map["head"]["h1"] = array(
            "en" => "Music gallery",
            "rus" => "Музыкальная коллекция",
        );
        $this->scripts[]="/js/musicgallery.js";
        $this->styles[]="/css/musicgallery.css";
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap'>";

        if($this->albumsList){
            if($this->albumsList->rowCount()){

                echo "<div class='alb-menu'>";

                while ($alb_row = $this->albumsList->fetch(PDO::FETCH_ASSOC)){
                    echo "<a href='/music/album/".$alb_row["albumAlias"]."'>".$alb_row["albumName"]."</a>";
                }
                echo "</div>";
            }
        }

        if($this->playAlb){
            echo "<div class='play-alb'>".
                "<div class='alb-name'>".$this->playAlb["albumName"]."</div>".
                "<div class='alb-cover'><img src='".MUSIC_COVERS_DIR."/".$this->playAlb["albumImg"]."'></div>".
                "<div class='alb-descr'>".$this->playAlb["metaDescr"]."</div>".
                "<div class='alb-created'>Created: <span>".$this->playAlb["dateOfCr"]."</span></div>".
                "<div class='alb-updated'>Updated: <span>".$this->playAlb["refreshDate"]."</span></div>".
                "</div>";
        }

        echo "<div class='ac-wrap'>".
            "<audio controls='controls' autoplay id='htmlMusicPlayer'>".
            "</audio>".
            "</div>".
            "<div class='tracks-list' id='music-album'>";

        if($this->trackList->rowCount() > 0){
            echo "<div class='track-line caption'>".
                "<div class='track-num'>No</div>".
                "<div class='track-artist'>Artist</div>".
                "<div class='track-name'>Song</div>".
                "<div class='track-play'>Play</div>".
                "</div>";

            $track_num = 0;

            while ($track_row = $this->trackList->fetch(PDO::FETCH_ASSOC)){
                $print_track_file = $track_row["track_file"];
                if(strpos(" ".$track_row["track_file"], "http", 0)!=1){
                    $print_track_file=MUSIC_TRACKS_DIR."/".$print_track_file;
                }

                $track_num++;
                echo "<div class='track-line'>".
                    "<div class='track-num'>".$track_num."</div>".
                    "<div class='track-artist'>".$track_row["track_artist"]."</div>".
                    "<div class='track-name'>".
                    "<a href='".$print_track_file."'>".$track_row["track_name"]."</a>".
                    "</div>".
                    "<div class='track-play'><input type='button' value='Play'></div>".
                    "</div>";
            }
        }

        echo "</div>".
            "</div></div></div>";
    }
}