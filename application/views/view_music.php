<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordView.php";
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordListView.php";
class view_music extends RecordListView
{
    public $albumsList  = null;
    public $playAlb = null;
    public $trackList = null;

    public $logo = JOINT_SITE_EXEC_DIR."/img/popimg/music-logo.png";
    public $shortcut_icon = JOINT_SITE_EXEC_DIR."/img/popimg/music-logo.png";

    function __construct()
    {
        parent::__construct();
        $this->scripts[]= JOINT_SITE_EXEC_DIR."/js/musicgallery.js";
        $this->styles[]= JOINT_SITE_EXEC_DIR."/css/musicgallery.css";
    }

    function LoadViewLang_custom()
    {
        parent::LoadViewLang_custom();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/views/music/lang_view_music_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_music_".$_SESSION[JS_SAIK]["lang"];
    }

    function music_menu()
    {
        echo "<div class='music-menu'>";
        $this->music_nav_menu();
        echo "</div>";
    }

    function music_nav_menu()
    {
        echo "<div class='music-nav' id='music-nav-menu'>".
            "<span>".$this->lang_map->music_main_menu["nav"]."</span>".
            "<ul>".
            "<li><a href='".JOINT_SITE_EXEC_DIR."/music/albums'>".$this->lang_map->music_main_menu["nav_alb"]."</a></li>".
            "<li><a href='".JOINT_SITE_EXEC_DIR."/music/tracks'>".$this->lang_map->music_main_menu["nav_tracks"]."</a></li>".
            "<li>"."<a href='".JOINT_SITE_EXEC_DIR."/music'>".$this->lang_map->music_main_menu["nav_music"]."</a>"."</li>".
            "</ul>".
            "</div>";
    }

    function print_music_album($album)
    {
        $return_text = "<div class='alb-block'>".
            "<div class='alb-name'>".$album["albumName"]."</div>".
            "<div class='alb-cover'><a href='".JOINT_SITE_EXEC_DIR."/music/album/".$album["albumAlias"]."' title='play album'>";
        if($album["albumImg"]!=null){
            $return_text .="<img src='".MUSIC_COVERS_DIR."/".$album["albumImg"]."'>";
        }else{
            $return_text .="<img src='".JOINT_SITE_EXEC_DIR."/img/popimg/avatar-default.png' alt='no-cover'>";
        }
        $return_text .="</a>".
            "<div class='alb-count-tracks'>".
            "<span class='alb-info-name'>".$this->lang_map->music["alb_cnt_tracks_1"]."</span>".
            "<span class='alb-info-val'>".$album["countRec"]."</span>".
            "<span class='alb-info-name'>".$this->lang_map->music["alb_cnt_tracks_2"]."<span>".
            "</div>".
            "</div>".
            "<div class='alb-descr'>".
            $album["metaDescr"]."</div>".
            "<div class='alb-row3'>".
            "<span class='alb-info-name'>".$this->lang_map->music["alb_created_by"]."</span>".
            "<span class='alb-info-val'>".$album["alb_created"]."</span>".
            "</div>".
            "<div class='alb-row3'>".
            "<span class='alb-info-name'>".$this->lang_map->music["alb_created_date"]."</span>".
            "<span class='alb-info-val'>".$album["dateOfCr"]."</span>".
            "</div>".
            "<div class='alb-row3'>".
            "<span class='alb-info-name'>".$this->lang_map->music["alb_updated"]."</span>".
            "<span class='alb-info-val'>".$album["refreshDate"]."</span>".
            "</div>".
            "</div>";
        return $return_text;
    }

    function print_music_tracks()
    {
        $return_text = "<div class='ac-wrap'>".
            "<audio controls='controls' autoplay id='htmlMusicPlayer'>".
            "</audio>".
            "</div>".
            "<div class='tracks-list' id='music-album'>";
        if(count($this->listRecords)){
            $return_text.= "<div class='track-line caption'>".
                "<div class='track-num'>No</div>".
                "<div class='track-artist'>".$this->lang_map->music["t_art"]."</div>".
                "<div class='track-name'>".$this->lang_map->music["t_song"]."</div>".
                "<div class='track-play'>".$this->lang_map->music["t_play"]."</div>".
                "</div>";

            $track_num = 0;

            foreach ($this->listRecords  as $num => $track_row){

                $print_track_file = $track_row["track_file"];
                if(strpos(" ".$track_row["track_file"], "http", 0)!=1){
                    $print_track_file=MUSIC_TRACKS_DIR."/".$print_track_file;
                }

                $track_num++;
                $return_text.= "<div class='track-line'>".
                    "<div class='track-num'>".$track_num."</div>".
                    "<div class='track-artist'>".$track_row["track_artist"]."</div>".
                    "<div class='track-name'>".
                    "<a href='".$print_track_file."'>".$track_row["track_name"]."</a>".
                    "</div>".
                    "<div class='track-play'><input type='button' value='Play'></div>".
                    "</div>";
            }
        }

        $return_text.= "</div>";
        return $return_text;
    }
}