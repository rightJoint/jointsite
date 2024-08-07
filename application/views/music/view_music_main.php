<?php
class view_music_main extends view_music
{
    public $new_albums;
    public $albums_count;
    public $new_tracks;
    public $tracks_count;

    function LoadViewLang($request = null)
    {
        parent::LoadViewLang($request = null); // TODO: Change the autogenerated stub

        require_once "application/lang_files/views/music/lang_view_music_main_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_music_main_".$_SESSION[JS_SAIK]["lang"];
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap music'>";
        $this->music_menu();
        echo "<section>";
        echo "<h2>".$this->lang_map->alb_section["h2"]."</h2>";

        $this->print_last_albums();
        echo "<div class='music-block-ref'><a href='".JOINT_SITE_EXEC_DIR."/music/albums' title='albums list'>".
            $this->lang_map->alb_section["see_all_1"].
            " ".$this->albums_count." ".$this->lang_map->alb_section["see_all_2"]."</a></div>";
        echo "</section>";
        echo "<section>";
        echo "<h2>".$this->lang_map->tracks_section["h2"]."</h2>";
        echo $this->print_music_tracks();
        echo "<div class='music-block-ref'><a href='".JOINT_SITE_EXEC_DIR."/music/tracks' title='albums list'>".
            $this->lang_map->tracks_section["see_all_1"].
            " ".$this->tracks_count." ".$this->lang_map->tracks_section["see_all_2"]."</a></div>";
        echo "</section>";
        echo "</div></div></div>";
    }

    function print_last_albums()
    {
        if(count($this->new_albums) > 0){
            foreach ($this->new_albums as $album){
                echo $this->print_music_album($album);
            }
        }
    }
}