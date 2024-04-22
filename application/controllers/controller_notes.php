<?php
include "application/views/view_notes.php";
class controller_notes extends Controller
{
    public $lang_map = array(
        "submit_new" => array(
            "en" => "Create",
            "rus" => "Создать",
        ),
        "submit_edit" => array(
            "en" => "Update",
            "rus" => "Обновить",
        ),
    );

    function __construct()
    {
        if($_SESSION["site_user"]["user_id"] != "36332131-C26E-4B63-A22D-11A3076074ED"){
            throwErr("access", "denied in notes controller - construct");
        }
        $this->model = new model_notes();
        $this->view = new view_notes();
        $this->model->getRecordStructure();
    }

    function action_index()
    {
        if($_POST["note-submit"] == $this->lang_map["submit_new"][$_SESSION["lang"]]){
            $this->model->record["noteContent"]["curVal"] = $_POST["noteContent"];
            $this->model->record["created_date"]["curVal"] = date("Y-m-d H:i:s");
            $this->model->record["created_by"]["curVal"] = $_SESSION["site_user"]["user_id"];
            if($this->model->insertRecord()){
                header("Location: notes/edit/".$this->model->record["note_id"]["curVal"]);
            }else{
                $this->view->view_data["log_message"] = $this->model->log_message;
            }
        }
        $this->view->view_data["pre_id"] = $this->model->get_pre_note();
        $this->view->view_data["nex_id"] = $this->model->get_next_note();
        $this->view->view_data["record"] = $this->model->record;
        $this->view->view_data["count"] = $this->model->countRecords();
        $this->view->view_data["count_next"] = $this->model->count_next_notes();
        $this->view->view_data["count_pre"] = $this->model->count_pre_notes();
        $this->view->generate();
    }

    function action_edit()
    {
        global $routes;
        if($routes["3"]){
            $this->model->record["note_id"]["curVal"] = $routes["3"];
            if($this->model->copyRecord()){
                if($_POST["note-submit"] == $this->lang_map["submit_edit"][$_SESSION["lang"]]){
                    $this->model->record["noteContent"]["curVal"] = $_POST["noteContent"];
                    $this->model->record["created_by"]["curVal"] = $_SESSION["site_user"]["user_id"];
                    if($this->model->updateRecord()){
                        $this->view->view_data["log_message"] = $this->model->log_message;
                    }else{
                        $this->view->view_data["log_message"] = $this->model->log_message;
                    }
                }
                $this->view->view_data["record"] = $this->model->record;
                $this->view->view_data["count"] = $this->model->countRecords();
                $this->view->view_data["pre_id"] = $this->model->get_pre_note();
                $this->view->view_data["next_id"] = $this->model->get_next_note();
                $this->view->view_data["note_tags"] = $this->model->getNoteTags($this->model->record["note_id"]["curVal"]);
                $this->view->view_data["tags_list"] = $this->model->getTagsList();
                $this->view->view_data["count_next"] = $this->model->count_next_notes();
                $this->view->view_data["count_pre"] = $this->model->count_pre_notes();
                $this->view->generate();
            }else{
                throwErr("404", "xxx-1");
            }
        }else{
            throwErr("404", "xxx-2");
        }
    }

    function action_addTag()
    {
        if($this->model->addNoteTag($_POST["note_id_from_url"], $_POST["tag_text"])){
            echo "Ok";
        }else{
            echo "Fail";
        }
    }

    function action_delTag()
    {
        if($this->model->delNoteTag($_POST["note_id_from_url"], $_POST["tag_text"])){
            echo "Ok";
        }else{
            echo "Fail";
        }
    }

    function action_detail()
    {
        global $routes;
        if($routes["3"]){
            $this->model->record["note_id"]["curVal"] = $routes["3"];
            if($this->model->copyRecord()){
                $this->view->view_data["record"] = $this->model->record;
                $this->view->view_data["count"] = $this->model->countRecords();
                $this->view->view_data["pre_id"] = $this->model->get_pre_note();
                $this->view->view_data["next_id"] = $this->model->get_next_note();
                $this->view->view_data["note_tags"] = $this->model->getNoteTags($this->model->record["note_id"]["curVal"]);
                $this->view->view_data["count_next"] = $this->model->count_next_notes();
                $this->view->view_data["count_pre"] = $this->model->count_pre_notes();
                $this->view->generate();
            }else{
                throwErr("404", "xxx-1");
            }
        }else{
            throwErr("404", "xxx-2");
        }
    }
    function action_delNote()
    {
        global $routes;
        if($_POST["note_id_from_url"]) {
            $this->model->record["note_id"]["curVal"] = $_POST["note_id_from_url"];
            if ($this->model->copyRecord()) {
                if($this->model->deleteRecord()){
                    echo "Ok";
                }else{
                    echo "Fail";
                }
            }else{
                echo "Fail";
            }
        }
    }
}