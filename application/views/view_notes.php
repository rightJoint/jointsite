<?php
class view_notes extends View
{

    function __construct()
    {
        $this->scripts[]="/lib/js/tinymce/js/tinymce/tinymce.min.js";
        $this->scripts[] = "/js/notes.js";
        $this->styles[] = "/css/notes.css";
    }

    function print_page_content()
    {

        echo
            "<div class='contentBlock-frame'>".
            "<div class='contentBlock-center'><div class='contentBlock-wrap'>";

        $this->print_note_form();

        //echo "<form class='note'"


        echo "</div></div></div>";



    }


    function print_note_form()
    {
        echo "<form class='note-form'>".
            "<input type='text' value='".date("Y-m-d H:i:s")."'>".
            "<textarea class='note-content'>sdcsdc</textarea>".
            "<input type='submit' value='Создать'>".

            "</form>";
    }
}