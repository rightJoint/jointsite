<?php
class view_music_main extends view_music
{
    public $new_albums;
    public $albums_count;
    public $new_tracks;
    public $tracks_count;

    function print_page_content()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap music'>";
        $this->music_menu();
        echo "<section>";
        echo "<h2>New albums</h2>";

        $this->print_last_albums();
        echo "<div class='music-block-ref'><a href='".JOINT_SITE_EXEC_DIR."/music/albums' title='albums list'>See all ".$this->albums_count." albums</a></div>";
        echo "</section>";
        echo "<section>";
        echo "<h2>New tracks</h2>";
        echo $this->print_music_tracks();
        echo "<div class='music-block-ref'><a href='".JOINT_SITE_EXEC_DIR."/music/albums' title='albums list'>See all ".$this->tracks_count." tracks</a></div>";
        echo "</section>";
        echo "</div></div></div>";
        //parent::print_page_content(); // TODO: Change the autogenerated stub
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