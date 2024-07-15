<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordView.php";
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordListView.php";
class view_migrations_log extends RecordListView
{
    public $shortcut_icon = JOINT_SITE_EXEC_DIR."/img/popimg/admin-logo.png";
    public $logo = JOINT_SITE_EXEC_DIR."/img/admin/migrations.png";

    function scriptListViewCrtlPannel($slave_req = "")
    {
        if(isset($_GET["migration_name"])){
            return parent::scriptListViewCrtlPannel($slave_req = "migration_name=".$_GET["migration_name"]);
        }else{
            return false;
        }

    }
}
