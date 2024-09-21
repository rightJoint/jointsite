<?php
class RecordDetailView extends RecordView
{
    public $record;
    public $viewFields = null;

    public $logo = JOINT_SITE_EXEC_DIR."/img/popimg/eye-icon.png";

    public $type = "detail";

    function __construct()
    {
        parent::__construct();

        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/records.css";

        $this->scripts[] = JOINT_SITE_EXEC_DIR."/js/records.js";
    }

    function LoadViewLang_custom()
    {
        require_once JOINT_SITE_REQ_LANG."/views/templates/lang_view_RecordDetail.php";
        return "lang_view_RecordDetail";
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
            echo "<h2><a href='".$this->process_url."'>" . $this->h2 . "</a></h2>";
        }
        echo "<form class='editForm' method='post'>";
        if($this->type=="delete"){
            echo "<div class='submit-line'><span class='del-confirm'>".$this->lang_map->del_confirm_txt."</span>";
            if($this->action_log){
                if($this->action_log["result"]){
                    $sub_class = "well";
                }else{
                    $sub_class = "fail";
                }
                echo "<div class='action-log ".$sub_class."'>".$this->action_log["log"]."</div>";
            }
            echo "<input type='submit' class='del-submit' value='".$this->lang_map->del_confirm_btn."'> </div>".
                "<input type='hidden' name='confirmdetelerecord' value=1>";
        }

        foreach ($this->viewFields as $fieldName => $fieldData) {
            $fieldName_curVal = null;
            if(isset($this->record[$fieldName]["curVal"])){
                $fieldName_curVal = $this->record[$fieldName]["curVal"];
            }

            echo $this->getTnputType($fieldName, $fieldData, $fieldName_curVal)["html"];
        }
        echo "</form>" .
            "</div>";
    }
}