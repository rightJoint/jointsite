<?php
class lang_view_music_albums_en extends  lang_view_music_en
{
    function __construct()
    {
        parent::__construct();
        $this->head["h1"] = "Albums list";
        $this->head["title"] = "Music - albums list";
    }
}