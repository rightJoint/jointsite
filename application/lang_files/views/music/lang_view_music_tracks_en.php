<?php
class lang_view_music_tracks_en extends lang_view_music_en
{
    function __construct()
    {
        parent::__construct();
        $this->head["h1"] = "Список трэков";
        $this->head["title"] = "Музыка - Список трэков";

    }
}