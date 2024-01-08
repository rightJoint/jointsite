<?php
class RecordDetailView extends RecordsView
{
    public $viewFields = null;
    public $record;
    public $mUrl;
    public $moduleTable;
    public $logo = "/img/popimg/eye-icon.png";

    public $type = "detail"; /*detail or delete*/


    function __construct()
    {
        $this->styles[] = "/css/records.css";

        $this->styles[] = "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css";

        $this->scripts[] = "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js";
        $this->scripts[] = "/js/records.js";
    }

    function set_head_array()
    {
        if($this->type == "detail"){
            $txt_en = "View record in table";
            $txt_rus = "Просмотр записи в таблице";
        }elseif ($this->type == "delete"){
            $txt_en = "Delete record from table";
            $txt_rus = "Удаление записи из таблицы";
        }
        $this->lang_map["head"]["description"] = array(
            "en" => $txt_en,
            "rus" => $txt_rus,
        );
        $this->lang_map["head"]["title"] = array(
            "en" => $txt_en." ".$this->h2,
            "rus" => $txt_rus." ".$this->h2,
        );
        $this->lang_map["head"]["h1"] = array(
            "en" => $txt_en." ".$this->h2,
            "rus" => $txt_rus." ".$this->h2,
        );

        $this->lang_map["del-confirm-btn"] = array(
            "en" => "Delete",
            "rus" => "Удалить"
        );
        $this->lang_map["del-confirm-txt"] = array(
            "en" => "Confirm to delete record",
            "rus" => "Подтвердите удаление записи"
        );
    }


    function print_page_content()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap'>";
        $this->printDetailView();

        echo "</div>" .
            "</div>" .
            "</div>";
    }

    function printDetailView()
    {

        echo "<div class='edit-record-frame'>";
        if ($this->h2) {
            echo "<h2>" . $this->h2 . "</h2>";
        }
        echo "<form class='editForm' method='post'>";
        if($this->type=="delete"){
            echo "<div class='submit-line'><span class='del-confirm'>".$this->lang_map["del-confirm-txt"][$_SESSION["lang"]]."</span>";
            if($this->action_log){
                if($this->action_log["result"]){
                    $sub_class = "well";
                }else{
                    $sub_class = "fail";
                }
                echo "<div class='action-log ".$sub_class."'>".$this->action_log["log"]."</div>";
            }
            echo "<input type='submit' class='del-submit' value='".$this->lang_map["del-confirm-btn"][$_SESSION["lang"]]."'> </div>".
                "<input type='hidden' name='confirmdetelerecord' value=1>";
        }

        foreach ($this->viewFields as $fieldName => $fieldData) {
            echo $this->getTnputType($fieldName, $fieldData, $this->record[$fieldName]["curVal"])["html"];
        }
        echo "</form>" .
            "</div>";
    }
}