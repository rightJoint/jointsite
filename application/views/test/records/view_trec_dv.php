<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/views/templates/RecordView.php";
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/views/templates/RecordDetailView.php";
class view_trec_dv extends RecordDetailView
{
    function __construct()
    {
        parent::__construct();
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/test/test-rec.css";
    }
}