<?php
class view_music_playalb extends view_music
{
    function print_page_content()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap'>";
        echo "<div class='music-menu'>";

        $this->music_menu();
        echo "</div>";

        echo $this->print_music_album($this->playAlb);

        echo "<div class='ac-wrap'>".
            "<audio controls='controls' autoplay id='htmlMusicPlayer'>".
            "</audio>".
            "</div>".
            "<div class='tracks-list' id='music-album'>";

        if(count($this->trackList) > 0){
            echo "<div class='track-line caption'>".
                "<div class='track-num'>No</div>".
                "<div class='track-artist'>".$this->lang_map->music["t_art"]."</div>".
                "<div class='track-name'>".$this->lang_map->music["t_song"]."</div>".
                "<div class='track-play'>".$this->lang_map->music["t_play"]."</div>".
                "</div>";

            $track_num = 0;

            foreach ($this->trackList as $num=>$track_row){
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
    function music_menu()
    {
        echo "<div class='music-menu'>";
        $this->music_nav_menu();
        if($this->albumsList){
            echo "<div class='alb-menu'>";

            foreach ($this->albumsList as $num => $alb_row){
                echo "<a href='".JOINT_SITE_EXEC_DIR."/music/album/".$alb_row["albumAlias"]."'>".$alb_row["albumName"]."</a>";
            }
            echo "</div>";
        }

        echo "</div>";
    }
}