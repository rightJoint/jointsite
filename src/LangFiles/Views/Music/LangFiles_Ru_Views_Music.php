<?php
class LangFiles_Ru_Views_Music extends LangFiles_Ru_Views_Templates_RecordsList
{
    static public function getLangPageContent():stdClass
    {
        $langPageContent = parent::getLangPageContent();


        /*$list_table = array(
            "found" => "Найдено",
            "list_by" => "Показывать по",
            "sort" => "Сортировка",
            "new" => "Создать запись",
            "btn_apply" => "Применить фильтр",
            "cell_view" => "Смотр.",
            "cell_del" => "Удал.",
            "cell_edit" => "Редакт.",
            "btn_clear" => "Очистить",
        );

        $filterView = new stdClass();
        $filterView->list_table = $list_table;

        $langPageContent->fiterView = $filterView;
        */

        $navMenu = new stdClass();
        $navMenu->nav_text = 'Навигация';
        $navMenu->nav_alb = 'Альбомы';
        $navMenu->nav_tracks = 'Трэки';
        $navMenu->nav_fresh = 'Свежее';

        $langPageContent->navMenu = $navMenu;

        $albBlock = new stdClass();
        $albBlock->alb_created_date = 'Создано';
        $albBlock->alb_updated = 'Обновлено';
        $albBlock->alb_created_by = 'Создал';
        $albBlock->alb_cnt_tracks_1 = 'В альбоме';
        $albBlock->alb_cnt_tracks_2 = 'трэков';
        $albBlock->t_song = 'Трэк';
        $albBlock->t_art = 'Исполнитель';
        $albBlock->t_play = 'Воспр.';

        $langPageContent->fiterView->albBlock = $albBlock;

        return $langPageContent;
    }
    /*
    public $music_main_menu = array(
        "nav" => "Навигация",
        "nav_alb" => "Альбомы",
        "nav_tracks" => "Трэки",
        "nav_music" => "Свежее",
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
    */
}
