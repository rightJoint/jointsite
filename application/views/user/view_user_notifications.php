<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordView.php";
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordListView.php";
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/ModuleListView.php";
class view_user_notifications extends ModuleListView
{
    public $logo = JOINT_SITE_EXEC_DIR."/img/popimg/eMailLogo-2.png";
    public $shortcut_icon = JOINT_SITE_EXEC_DIR."/img/popimg/eMailLogo-2.png";

    public $robot_no_index = true;
    public $metrik_block = false;
/*
    function set_head_array()
    {

    }
*/
}