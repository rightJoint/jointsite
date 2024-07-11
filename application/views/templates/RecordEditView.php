<?php
class RecordEditView extends RecordView
{
    public $logo = JOINT_SITE_EXEC_DIR."/img/popimg/edit-icon.png";
    public $editFields = null;

    public $type = "edit"; /*or edit or new*/

    function __construct()
    {
        parent::__construct();
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/records.css";
    }

    function LoadViewLang_custom()
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR.
            "/application/lang_files/views/templates/lang_view_RecordEdit_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_RecordEdit_".$_SESSION[JS_SAIK]["lang"];
    }

    function set_head_array()
    {
        parent::set_head_array();
        $this->lang_map->update_head_array(array(
            "type" => $this->type,
            "h2" => $this->h2,
        ));
    }

    function print_page_content()
    {
        parent::print_page_content();
        $this->printEditView();
    }

    function printEditView()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap'>" . "<div class='edit-record-frame'>";
        if ($this->h2) {
            echo "<h2><a href='".$this->process_url."'>" . $this->h2 . "</a></h2>";
        }
        echo "<form class='editForm' method='post' enctype='multipart/form-data'>";

        foreach ($this->editFields as $fieldName => $fieldData) {
            $field_data_val = null;
            if(isset($this->record[$fieldName]["curVal"])){
                $field_data_val = $this->record[$fieldName]["curVal"];
            }
            echo $this->getTnputType($fieldName, $fieldData, $field_data_val)["html"];
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
        echo "<input name='submit' type='submit' value='".$this->lang_map->view_submit_val."'> </div>".
            "</form>" .
            "</div>".
            "</div>" .
            "</div>" .
            "</div>";
    }
}