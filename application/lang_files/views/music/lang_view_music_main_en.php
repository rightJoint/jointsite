<?php
class lang_view_music_main_en extends lang_view_music_en
{
    public $alb_section = array(
        "h2" => "Новые альбомы",
        "see_all_1" => "Смотреть все",
        "see_all_2" => "альбома",
    );
    public $tracks_section = array(
        "h2" => "Новые трэки",
        "see_all_1" => "Слушать все",
        "see_all_2" => "трэка",
    );

    function __construct()
    {
        parent::__construct();
        $this->head["title"] = $this->head["h1"];
    }
}