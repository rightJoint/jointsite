<?php

namespace JointSite\Views\Templates;

use JointSite\Views\Templates\RecordView;

class RecordDetailView extends RecordView
{
    public $record;
    public $viewFields = null;

    public $logo = "/img/popimg/eye-icon.png";

    public $type = "detail";

    function __construct()
    {
        parent::__construct();

        $this->styles[] = "/css/records.css";

        $this->scripts[] = "/js/records.js";
    }

    function loadLangViewCustom()
    {
        require_once(JOINT_SITE_REQ_LANG."/Views/Templates/LangFiles_".JOINT_SITE_NS_LANG."_Views_Templates_RecordDetail.php");
        return "LangFiles_".JOINT_SITE_NS_LANG."_Views_Templates_RecordDetail";
    }

    function setHeadArray()
    {
        parent::setHeadArray();
        $this->lang_map->update_head_array(array(
            "type" => $this->type,
            "h2" => $this->h2,
        ));
    }

    function printPageContent()
    {
        parent::printPageContent();
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
            echo "<h2><a href='".JOINT_SITE_SL_LANG.$this->process_url."'>" . $this->h2 . "</a></h2>";
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