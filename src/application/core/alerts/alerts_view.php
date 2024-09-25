<?php
class Alerts_View extends SiteView
{
    public $logo = JOINT_SITE_EXEC_DIR."/img/popimg/error.png";
    public $response_code = 200;
    public $robot_no_index = true;
    public $metrik_block = false;
    public $alert_message = array();

    function __construct()
    {
        parent::__construct();

        $lang_class ="lang_view_alerts";
        $this->lang_map = new $lang_class;

        $this->styles[]=JOINT_SITE_EXEC_DIR."/css/alerts.css";
    }

    function LoadViewLang_custom()
    {
        require_once (JOINT_SITE_REQ_LANG."/views/lang_view_alerts.php");
        return "lang_view_alerts";
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

        if(count($this->alert_message)){
            echo $this->view_data;
            echo "</span>".
                "<div class='ew-detail'>";
            foreach ($this->alert_message as $num => $alert_signal){
                foreach ($alert_signal as $alert_type => $alert_message){
                    echo $num.": ".$alert_type." => ".$alert_message."<br>";
                }
            }
            echo "</div>";
        }
        echo "</div>".
            "</div>".
            "</div>".
            "</div>";
    }
}