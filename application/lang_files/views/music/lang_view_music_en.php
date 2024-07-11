<?php
class lang_view_music_en extends lang_view_en
{
    function __construct()
    {
        $this->head["h1"] = "Music gallery";
        $this->music = array(
            "alb_created" => "Created",
            "alb_updated" => "Updated",
            "t_song" => "Track",
            "t_art" => "Artist",
            "t_play" => "Tune",
        );
    }
    function set_head_array($options)
    {
        $this->head["title"] = "Music-".$options["albumName"];
        $this->head["description"] = $options["metaDescr"];
    }
}