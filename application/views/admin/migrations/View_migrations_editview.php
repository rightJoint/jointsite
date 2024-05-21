<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordView.php";
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordEditView.php";
class View_migrations_editview extends RecordEditView
{
    public $shortcut_icon = JOINT_SITE_EXEC_DIR."/img/popimg/admin-logo.png";
    public $logo = JOINT_SITE_EXEC_DIR."/img/admin/migrations.png";

    function __construct()
    {
        parent::__construct();
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/admin/migrations.css";
    }
}