<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/controllers/controller_admin.php";
class controller_phpmysqladmin extends controller_admin
{
    public $admin_process_url = JOINT_SITE_ROOT_LANG."/test/phpmysqladmin";

}