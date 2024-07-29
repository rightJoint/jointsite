<?php
class lang_view_music_en extends lang_view_RecordsList_en
{
    function __construct()
    {
        $this->head["h1"] = "Music gallery";
        $this->music = array(
            "alb_created_date" => "Created",
            "alb_updated" => "Updated",
            "alb_created_by" => "Updated",
            "t_song" => "Track",
            "t_art" => "Artist",
            "t_play" => "Tune",
        );
        $this->music_head = array(
            "h1_text" => "Album"
        );
    }
    public $music_main_menu = array(
        "nav" => "Навигация",
        "nav_alb" => "Альбомы",
        "nav_tracks" => "Трэки",
        "nav_music" => "Музыка",
    );
}
