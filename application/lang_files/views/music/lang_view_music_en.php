<?php
class lang_view_music_en extends lang_view_RecordsList_en
{
    public $music_main_menu = array(
        "nav" => "MusicNav",
        "nav_alb" => "Albums",
        "nav_tracks" => "Tracks",
        "nav_music" => "New music",
    );

    function __construct()
    {
        $this->head["h1"] = "Music collection";
        $this->music = array(
            "alb_created_date" => "Created",
            "alb_updated" => "Updated",
            "alb_created_by" => "Author",
            "alb_cnt_tracks_1" => "contains",
            "alb_cnt_tracks_2" => "tracks",
            "t_song" => "Track",
            "t_art" => "Artist",
            "t_play" => "Play.",
        );
        $this->music_head = array(
            "h1_text" => "Album"
        );
    }

    function set_head_array($options)
    {

    }
}
