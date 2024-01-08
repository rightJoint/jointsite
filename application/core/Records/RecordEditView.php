<?php
class RecordEditView extends RecordsView
{
    public $logo = "/img/popimg/edit-icon.png";
    public $editFields = null;

    public $type = "edit"; /*or edit or new*/

    function __construct()
    {
        $this->styles[] = "/css/records.css";
    }

    function set_head_array()
    {
        if($this->type == "edit"){
            $txt_en = "Edit";
            $txt_rus = "Редактирование";

            $this->lang_map["view_submit_val"] = array(
                "en" => "Update",
                "rus" => "Обновить"
            );

        }elseif ($this->type == "new"){
            $txt_en = "Create";
            $txt_rus = "Создание";
            $this->lang_map["view_submit_val"] = array(
                "en" => "Create",
                "rus" => "Создать"
            );
        }

        $this->lang_map["head"]["description"] = array(
            "en" => $txt_en." record in table",
            "rus" => $txt_rus." записи в таблице",
        );
        $this->lang_map["head"]["title"] = array(
            "en" => $txt_en." view in table ".$this->h2,
            "rus" => $txt_rus." записи в таблице ".$this->h2,
        );
        $this->lang_map["head"]["h1"] = array(
            "en" => $txt_en." view in table ".$this->h2,
            "rus" => $txt_rus." записи в таблице ".$this->h2,
        );
    }

    function print_page_content()
    {
        $this->printEditView();
    }

    function printEditView()
    {

        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap'>" . "<div class='edit-record-frame'>";
        if ($this->h2) {
            echo "<h2>" . $this->h2 . "</h2>";
        }
        echo "<form class='editForm' method='post' enctype='multipart/form-data'>";

        foreach ($this->editFields as $fieldName => $fieldData) {
            echo $this->getTnputType($fieldName, $fieldData, $this->record[$fieldName]["curVal"])["html"];
        }
        echo "<div class='submit-line'>";
        if($this->action_log){
            if($this->action_log["result"]){
                $sub_class = "well";
            }else{
                $sub_class = "fail";
            }
            echo "<div class='action-log ".$sub_class."'>".$this->action_log["log"]."</div>";
        }
        echo "<input type='submit' value='".$this->lang_map["view_submit_val"][$_SESSION["lang"]]."'> </div>".
            "</form>" .
            "</div>".
            "</div>" .
            "</div>" .
            "</div>";
    }
}