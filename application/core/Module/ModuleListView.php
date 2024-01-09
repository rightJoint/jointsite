<?php
class ModuleListView extends RecordsListView
{
    public $module;

    function __construct()
    {
        parent::__construct();
        $this->styles[] = "/css/module.css";
    }
}