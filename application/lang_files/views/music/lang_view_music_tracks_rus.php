<?php
class lang_view_music_tracks_rus extends lang_view_music_rus
{
    function __construct()
    {
        parent::__construct();
        $this->head["h1"] = "Список трэков";
        $this->head["title"] = "Музыка - Список трэков";

    }
}