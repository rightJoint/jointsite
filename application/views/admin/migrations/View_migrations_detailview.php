<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordView.php";
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordDetailView.php";
class View_migrations_detailview extends RecordDetailView
{
    public $shortcut_icon = JOINT_SITE_EXEC_DIR."/img/popimg/admin-logo.png";
    public $logo = JOINT_SITE_EXEC_DIR."/img/admin/migrations.png";

    function __construct()
    {
        parent::__construct();
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/admin/migrations.css";
    }
    function print_page_content()
    {
        $this->print_migr_panel();
        parent::print_page_content();
    }
    function print_migr_panel()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap'>".
            "<form class='migration-form' method='post'>".
            "<div class='apply-line'>".
            "<input type='submit' class='exec' name='exec_migration' value='exec-migration'>".
            "<input type='hidden' name='exec_migr_file' value='".$this->record["migration_name"]["curVal"]."'>".
            "</div>".
            "</form>".
            "</div></div></div>";
    }

}