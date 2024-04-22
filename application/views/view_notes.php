<?php
class view_notes extends View
{

    public $metrik_block = false;
    public $robot_no_index = false;

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
        global $routes;
        echo
            "<div class='contentBlock-frame'>".
            "<div class='contentBlock-center'><div class='contentBlock-wrap'>";

        $this->note_panel();

        if($routes[2] == "edit" or !$routes[2]){
            $this->note_form();
            $this->photos_form();
        }elseif ($routes[2] == "detail"){
            $this->note_view();
        }


        //echo "<form class='note'"


        echo "</div></div></div>";



    }

    function note_view()
    {

        if($this->view_data["record"]["created_date"]["curVal"]){
            $note_date = $this->view_data["record"]["created_date"]["curVal"];
        }

        $tags_list = "<div class='tags-list'>";
        if(count($this->view_data["note_tags"])){
            foreach ($this->view_data["note_tags"] as $note_tag){
                $tags_list .="<div class='note-tag'><span class='tag-text'>".$note_tag."</span></div>";
            }

        }else{
            $tags_list .="<div class='note-tag'>no tags</div>";
        }
        $tags_list .= "</div>";



        echo "<div class='note-view'>";

        echo "<div class='tags-block'>".$tags_list."</div>".
        "<div class='note-date'>".
        "<label for='created_date'>From: </label>".
        "<input type='text' name='created_date' value='".$note_date."' readonly>"."</div>".
        "<div class='view-note-content'>".
        $this->view_data["record"]["noteContent"]["curVal"].
        "</div>";

        echo "</div>";
        $this->photos_form();
    }

    function note_panel()
    {
        global $routes;

        $btn_view_type = "edit";
        if($routes[2] == "edit"){
            $edit_btn_ref = "#";
            $edit_btn_class = " active";
            $view_btn_ref = "/notes/detail/".$this->view_data["record"]["note_id"]["curVal"];
        }
        if($routes[2] == "detail"){
            $edit_btn_ref = "/notes/edit/".$this->view_data["record"]["note_id"]["curVal"];
            $view_btn_ref = "#";
            $view_btn_class = " active";
            $btn_view_type = "detail";
        }
        if(!$routes[2]){
            $edit_btn_ref = "#";
            $view_btn_ref = "#";
            $edit_btn_class = " active";
            $btn_view_type = "detail";
        }
        echo "<div class='note-panel'>".
            "<div class='np-new'>".
            "<a href='/notes' class='new-note' title='add new note'><img src='/img/admin/create-icon.png'>New</a>".
            "</div>";


        echo "<div class='np-forward'>";

        if($this->view_data["next_id"]){
            echo "<a href='/notes/".$btn_view_type."/".$this->view_data["next_id"]."' title='".$this->view_data["count_next"]."'>".
                "<img src='/img/notes/forward.png' style='transform: rotate(180deg);'></a>";
        }else{
            echo "<a href='#'>#</a>";
        }
        echo "<span class='notes-count'>".($this->view_data["count"]-$this->view_data["count_next"])."</span>";
        if($this->view_data["pre_id"]){
            echo "<a href='/notes/".$btn_view_type."/".$this->view_data["pre_id"]."' title='".$this->view_data["count_pre"]."'>".
                "<img src='/img/notes/forward.png'></a>";
        }else{
            echo "<a href='#'>#</a>";
        }
        echo "</div>";

        echo "<div class='np-mode'>".
            "<a class='view-mode".$view_btn_class."' href='".$view_btn_ref."'><img src='/img/popimg/eye-icon.png'></a>".
            "<a class='edit-mode".$edit_btn_class."' href='".$edit_btn_ref."'><img src='/img/popimg/edit-icon.png'></a>".
            "</div>";

        echo "</div>";
    }


    function note_form()
    {
        $delete_button = "";
        $tags = "";
        $tags_list = "<div class='tags-list'>";
        if($this->view_data["record"]["created_date"]["curVal"]){
            $note_date = $this->view_data["record"]["created_date"]["curVal"];
            $delete_button = "<input type='button' class='dell-button' value='Удалить' onclick='dellNote()'>";
            $submit_btn_txt = "Обновить";

            $tags = "<input type='text' name='note_tag' list='note_tag' value=''>";
            if(count($this->view_data["tags_list"])){
                $tags .= "<datalist id='note_tag'>";
                foreach ($this->view_data["tags_list"] as $tag_name => $use_count){
                    $tags .= "<option value='".$tag_name."'>";
                }
                $tags.= "</datalist>";
            }
            $tags.= "<input type='button' value='add tag' onclick='addNoteTag()'>";
            if(count($this->view_data["note_tags"])){
                foreach ($this->view_data["note_tags"] as $note_tag){
                    $tags_list .="<div class='note-tag'><span class='tag-text'>".$note_tag."</span><span class='tag-del' onclick='delTag(this)'>-del</span></div>";
                }

            }else{
                $tags_list .="<span class='no-tags'>no tags</span>";
            }


        }else{
            $submit_btn_txt = "Создать";
            $note_date = date("Y-m-d H:i:s");
            $tags_list .="<span class='no-tags'>no tags</span>";
        }



        //$tags_list = "<div class='tags-list'>";

        $tags_list .= "</div>";


        echo "<form class='note-form' method='post'>".
            "<div class='tags-block'>".$tags.$tags_list."</div>".
            "<div class='note-date'>".
            "<label for='created_date'>From: </label>".
            "<input type='text' name='created_date' value='".$note_date."' readonly>"."</div>".
            "<textarea name='noteContent' class='note-content'>".$this->view_data["record"]["noteContent"]["curVal"]."</textarea>".
            "<div class='submit-line'>".
            "<span class='log-message'>".$this->view_data["log_message"]."</span>".
            $delete_button.
            "<input type='submit' name='note-submit' value='".$submit_btn_txt."'>".
            "</div>".
            "</form>";
    }

    function photos_form()
    {
        echo '<form method="post" class="photos-form" id="photos-form" enctype="multipart/form-data" style="border: 1px solid red; margin: 1em;">
    <input type="file" name="photo">
    <input type="submit" value="Submit">
</form>';
    }
}