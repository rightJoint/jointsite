<?php
class view_notes extends View
{

    function __construct()
    {
        $this->scripts[] = "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js";
        $this->scripts[]="/lib/js/tinymce/js/tinymce/tinymce.min.js";
        $this->scripts[] = "/js/notes.js";

        $this->styles[] = "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css";
        $this->styles[] = "/css/notes.css";
    }

    function print_page_content()
    {

        echo
            "<div class='contentBlock-frame'>".
            "<div class='contentBlock-center'><div class='contentBlock-wrap'>";

        $this->note_panel();

        $this->note_form();

        //echo "<form class='note'"


        echo "</div></div></div>";



    }

    function note_panel()
    {
        echo "<div class='note-panel'>";

        echo "<a href='/notes' title='add new note'>New note</a>-----";
        if($this->view_data["next_id"]){
            echo "<a href='/notes/edit/".$this->view_data["next_id"]."'>next</a>";
        }else{
            echo "<a href='#'>#</a>";
        }
        echo "<span class='notes-count'>".$this->view_data["count"]."</span>";
        if($this->view_data["pre_id"]){
            echo "<a href='/notes/edit/".$this->view_data["pre_id"]."'>pre</a>";
        }else{
            echo "<a href='#'>#</a>";
        }

        echo "</div>";
    }


    function note_form()
    {

        if($this->view_data["record"]["created_date"]["curVal"]){
            $note_date = $this->view_data["record"]["created_date"]["curVal"];
            $submit_btn_txt = "Обновить";
        }else{
            $submit_btn_txt = "Создать";
            $note_date = date("Y-m-d H:i:s");
        }
        $tags = "<input type='text' name='note_tag' list='dbname' value=''>".
            "<datalist id='dbname'>";
        if($this->list_databases){
            while ($dbRow = $this->list_databases->fetch(PDO::FETCH_ASSOC)){
                $tags.= "<option value='".$dbRow["Database"]."' ".
                 ">";
            }
        }
        $tags.= "</datalist>".
        "<input type='button' value='add tag' onclick='addNoteTag()'>";

        echo "<form class='note-form' method='post'>".
            "<div class='tags-block'>".$tags."</div>".
            "<div class='note-date'>".
            "<label for='created_date'>From: </label>".
            "<input type='text' name='created_date' value='".$note_date."' readonly>"."</div>".
            "<textarea name='noteContent' class='note-content'>".$this->view_data["record"]["noteContent"]["curVal"]."</textarea>".
            "<div class='submit-line'>".
            "<span class='log-message'>".$this->view_data["log_message"]."</span>".
            "<input type='submit' name='note-submit' value='".$submit_btn_txt."'>".
            "</div>".
            "</form>";
    }
}