<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordView.php";
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordListView.php";
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/ModuleListView.php";
class view_user_groups extends ModuleListView
{
    public $logo = JOINT_SITE_EXEC_DIR."/img/popimg/user_group.png";
    public $shortcut_icon = JOINT_SITE_EXEC_DIR."/img/popimg/user_group.png";
    public $h2;

    public $robot_no_index = true;
    public $metrik_block = false;

    public function __construct()
    {
        parent::__construct();
        $this->h2 = $this->lang_map->h2_users;
    }

    function LoadViewLang_custom()
    {
        parent::LoadViewLang_custom();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/views/user/lang_view_user_groups_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_user_groups_".$_SESSION[JS_SAIK]["lang"];
    }

    function print_page_content()
    {
        echo "<div class='list_frame'>";
        echo moduleMenu::print_module_menu( null, $this->module_info, $this->m_process_url);
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
            echo "<div class='action-log ".$sub_class."'>";
            if(isset($this->action_log["log"])){
                echo $this->action_log["log"];
            }
            echo "</div>";
        }
        echo "<input name='userGroupSubmit' type='submit' value='".$this->lang_map->view_submit_val."'> </div>".
            "</form>".
            "</div>".
            "</div>".
            "</div>";
    }
}