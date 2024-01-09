<?php
class adminDetailView extends RecordDetailView
{
    public function __construct()
    {

        parent::__construct();
        $this->styles[] = "/css/admin/records.css";
    }
}