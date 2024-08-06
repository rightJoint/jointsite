<?php
class Alerts_View extends SiteView
{
    public $logo = JOINT_SITE_EXEC_DIR."/img/popimg/error.png";
    public $response_code = 200;
    public $robot_no_index = true;
    public $metrik_block = false;
    public $alert_message = null;

    function __construct()
    {
        parent::__construct();

        $lang_class ="lang_view_alerts_".$_SESSION[JS_SAIK]["lang"];
        $this->lang_map = new $lang_class;

        $this->styles[]=JOINT_SITE_EXEC_DIR."/css/alerts.css";
    }

    function LoadViewLang_custom()
    {
        require_once ($_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/lang_files/views/lang_view_alerts_".$_SESSION[JS_SAIK]["lang"].".php");
        return "lang_view_alerts_".$_SESSION[JS_SAIK]["lang"];
    }

    function print_page_content()
    {
        echo"<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<div class='err-wrap'>".
            "<div class='ew-warning'>".
            $this->lang_map->ew_warning.
            "</div>".
            "<span class='ew-txt'>".$this->lang_map->ew_txt."</span>".
            "<span class='ew-code'>".$this->response_code."</span>".
            "<span class='ew-h'>";
        if($this->alert_message){
            echo $this->alert_message;
        }
            echo "</span>".
            "<div class='ew-detail'>";
        if($this->view_data){
            echo $this->view_data;
        }
        if($this->alert_message){
            echo "<p>".$this->alert_message."</p>";
        }
        echo "</div>".
            "</div>".
            "</div>".
            "</div>".
            "</div>";
    }
}