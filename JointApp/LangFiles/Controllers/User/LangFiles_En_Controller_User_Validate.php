<?php
class LangFiles_En_Controller_User_Validate extends LangFiles_En_Controller_User_Account
{
    public stdClass $vldErr;
    public function __construct()
    {
        parent::__construct();

        $vldErr = new stdClass();
        $vldErr->empty = 'vld-code-is-empty';
        $vldErr->notFound = 'vld-code-not-found';

        $this->vldErr = $vldErr;
    }
}