<?php
class Alerts_View extends View
{
    public $logo = "/img/popimg/error.png";
    public $response_code = 200;
    public $robot_no_index = true;
    public $alert_message = null;

    function __construct()
    {
        $this->styles[]="/css/alerts.css";
        $this->lang_map["ew-warning"] = array(
            "en" => "At this page displaying catched errors. If you are here, something gone wrong.",
            "rus" => "На этой странице отображаются ошибки, перехваченные приложением. Если вы здесь, значит что-то пошло не так."
        );

        $this->lang_map["ew-txt"] = array(
            "en" => "Error occurred",
            "rus" => "ОШИБКА",
        );

        global $routes;

        if($routes[1] == "admin") {
            if (!$_SESSION["admin_user"]["id"]) {
                $this->active_modal_menu = true;
            }
        }

        parent::__construct();
    }

    function print_page_content()
    {
        echo"<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<div class='err-wrap'>".
            "<div class='ew-warning'>".
            $this->lang_map["ew-warning"][$_SESSION["lang"]].
            "</div>".
            "<span class='ew-txt'>".$this->lang_map["ew-txt"][$_SESSION["lang"]]."</span>".
            "<span class='ew-code'>".$this->response_code."</span>".
            "<span class='ew-h'>".$this->h1."</span>".
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