<?php
class lang_view_music_rus extends lang_view_rus
{
    function __construct()
    {
        $this->head["h1"] = "Музыкальная коллекция";
        $this->music = array(
            "alb_created" => "Создано",
            "alb_updated" => "Обновлено",
            "t_song" => "Трэк",
            "t_art" => "Исполнитель",
            "t_play" => "Воспр.",
        );
    }
    function set_head_array($options)
    {
        $this->head["title"] = "Music-".$options["albumName"];
        $this->head["description"] = $options["metaDescr"];
    }
}
