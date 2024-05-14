<?php
require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR . "/application/views/templates/RecordView.php";
require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR . "/application/views/templates/RecordEditView.php";
class view_newview extends RecordEditView
{
    function __construct()
    {
        parent::__construct();
        $this->scripts[] = JOINT_SITE_EXEC_DIR."/lib/js/find-adn-select-cntrl.js";
        $this->scripts[] = JOINT_SITE_EXEC_DIR."/js/test/music-tracks-to-alb.js";
    }
}