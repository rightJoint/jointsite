<?php
class adminEditView extends RecordEditView
{
    public $robot_no_index = true;
    public $metrik_block = false;

    public function __construct()
    {
        parent::__construct();
        $this->styles[] = "/css/admin/records.css";
    }
}