<?php
include "application/core/Records/RecordsView.php";
include "application/core/Records/RecordsListView.php";
include "application/views/siteman/sitemanListView.php";
class userGroups_view extends sitemanListView
{
    public $logo = "/img/popimg/user_group.png";
    public $shortcut_icon = "/img/popimg/user_group.png";
    public $h2;

    public $robot_no_index = true;
    public $metrik_block = false;

    public function __construct()
    {
        parent::__construct();

        $this->lang_map["view_submit_val"] = array(
            "en" => "Update",
            "rus" => "Обновить"
        );
        $this->lang_map["h2_users"] = array(
            "en" => "users groups",
            "rus" => "гуппы пользователя"
        );

        $this->h2 = $this->lang_map["h2_users"][$_SESSION["lang"]];
    }

    function print_page_content()
    {
        echo "<div class='list_frame'>";
        echo moduleMenu::print_module_menu($this->module);
        $this->listView();
        echo "</div>";
    }

    function listView()
    {

        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>";
        if ($this->h2) {
            echo "<h2>" . $this->h2 . "</h2>";
        }
        echo "<form class='editForm' method='post'>".
            "<div class='list_frame' id='".$this->list_frame_id."'>".
            "<div class='list_table'>".
            $this->listViewTable().
            "</div>".
            "</div>".
            "<div class='submit-line'>";
        if($this->action_log){
            if($this->action_log["result"]){
                $sub_class = "well";
            }else{
                $sub_class = "fail";
            }
            echo "<div class='action-log ".$sub_class."'>".$this->action_log["log"]."</div>";
        }
        echo "<input name='userGroupSubmit' type='submit' value='".$this->lang_map["view_submit_val"][$_SESSION["lang"]]."'> </div>".
            "</form>".
            "</div>".
            "</div>".
            "</div>";
    }
}