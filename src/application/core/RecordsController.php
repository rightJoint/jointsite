<?php
require_once JOINT_SITE_REQUIRE_DIR."/application/core/RecordsProcessController.php";
require_once JOINT_SITE_REQUIRE_DIR."/application/core/Interfaces/RecordsControllerInterface.php";
class RecordsController extends RecordsProcessController implements RecordsControllerInterface
{
    function action_index()
    {
        $this->records_process($this->process_path, $this->default_table, $this->view_data);
    }

    function action_detailview()
    {
        $this->records_process($this->process_path, $this->default_table, $this->view_data);
    }

    function action_listview()
    {
        $this->records_process($this->process_path, $this->default_table, $this->view_data);
    }

    function action_editview()
    {
        $this->records_process($this->process_path, $this->default_table, $this->view_data);
    }

    function action_deleteview()
    {
        $this->records_process($this->process_path, $this->default_table, $this->view_data);
    }
    function action_newview()
    {
        $this->records_process($this->process_path, $this->default_table, $this->view_data);
    }

}