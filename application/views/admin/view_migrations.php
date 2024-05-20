<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordView.php";
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordListView.php";
class view_migrations extends RecordListView
{
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
            "<input type='submit' class='exec' name='exec_all_migrations' value='exec-all-migrations'>".
            "<input type='submit' class='glob' name='glob_migr_files' value='glob-migr-files'>".
            "</div>".
            "</form>".
            "</div></div></div>";
    }
}