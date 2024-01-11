<?php
class ntflistEditView extends sitemanEditView
{
    public function __construct()
    {
        parent::__construct();
        $this->scripts[] = "/js/siteman/ntfEditView.js";
    }
}