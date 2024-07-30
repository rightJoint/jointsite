<?php
class view_music_tracks extends view_music
{
    public $logo= JOINT_SITE_EXEC_DIR."/img/popimg/record.png";
    public $shortcut_icon = JOINT_SITE_EXEC_DIR."/img/popimg/music-logo.png";

    public $hasAccessCreate = false;

    function LoadViewLang_custom($request = null)
    {
        parent::LoadViewLang_custom();
        require_once "application/lang_files/views/music/lang_view_music_tracks_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_music_tracks_".$_SESSION[JS_SAIK]["lang"];
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap music'>";
        $this->music_menu();
        echo "</div></div></div>";
        parent::print_page_content();
    }

    function listViewTable()
    {
        return $this->print_music_tracks($this->listRecords);
    }
}