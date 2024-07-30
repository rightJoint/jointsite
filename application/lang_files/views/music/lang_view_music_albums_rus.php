<?php
class lang_view_music_albums_rus extends  lang_view_music_rus
{

    function __construct()
    {
        parent::__construct();
        $this->head["h1"] = "Список альбомов";
        $this->head["title"] = "Музыка - Список альбомов";

    }

}