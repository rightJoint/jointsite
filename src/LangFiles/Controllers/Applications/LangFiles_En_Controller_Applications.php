<?php
class LangFiles_En_Controller_Applications extends LangFiles_En_Controller_Records
{
    public function __construct()
    {
        $mkAppErr = new stdClass();
        $mkAppErr->err_f = 'error';
        $mkAppErr->err_1 = 'client name unacceptable';
        $mkAppErr->err_2 = 'email unacceptable';
        $mkAppErr->err_3 = 'length of message unacceptable';

        $this->mkAppErr = $mkAppErr;
    }

}