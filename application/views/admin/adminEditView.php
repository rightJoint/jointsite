<?php
class adminEditView extends RecordEditView
{
    public function __construct()
    {
        parent::__construct();
        $this->styles[] = "/css/admin/records.css";
    }
}