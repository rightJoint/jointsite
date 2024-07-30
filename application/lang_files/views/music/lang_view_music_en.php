<?php
class lang_view_music_en extends lang_view_RecordsList_en
{
    public $music_main_menu = array(
        "nav" => "Навигация",
        "nav_alb" => "Альбомы",
        "nav_tracks" => "Трэки",
        "nav_music" => "Музыка",
    );

    function __construct()
    {
        $this->head["h1"] = "Музыкальная коллекция";
        $this->music = array(
            "alb_created_date" => "Создано",
            "alb_updated" => "Обновлено",
            "alb_created_by" => "Создал",
            "alb_cnt_tracks_1" => "В альбоме",
            "alb_cnt_tracks_2" => "трэков",
            "t_song" => "Трэк",
            "t_art" => "Исполнитель",
            "t_play" => "Воспр.",
        );
        $this->music_head = array(
            "h1_text" => "Альбом"
        );
    }

    function set_head_array($options)
    {

    }
}
