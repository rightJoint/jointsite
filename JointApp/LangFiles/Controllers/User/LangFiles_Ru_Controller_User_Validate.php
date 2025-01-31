<?php
class LangFiles_Ru_Controller_User_Validate extends LangFiles_Ru_Controller_User_Account
{
    public stdClass $vldErr;
    public function __construct()
    {
        parent::__construct();

        $vldErr = new stdClass();
        $vldErr->empty = 'код подтверждения пустой ли не передан';
        $vldErr->notFound = 'код подтверждения не найден';

        $this->vldErr = $vldErr;
    }
}