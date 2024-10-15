<?php

namespace jointSite\Core\Logger;

use jointSite\Psr\Log\LogLevel;

class JointSiteLoggerModel
{
    public $lang_map = array();

    public $response_codes = array(
        LogLevel::ERROR => 404,
        LogLevel::DEBUG =>  200,
        LogLevel::WARNING => 403,
        LogLevel::CRITICAL =>503,
        LogLevel::ALERT => 400,
        LogLevel::EMERGENCY => 200,
        LogLevel::NOTICE =>  200,
        LogLevel::INFO =>  200,
    );

    function __construct()
    {
        require_once(JOINT_SITE_REQ_LANG."/Models/LangFiles_".JOINT_SITE_APP_LANG."_Models_AlertsModel.php");
        $return_lang = "LangFiles_".JOINT_SITE_APP_LANG."_Models_AlertsModel";

        $this->lang_map = new $return_lang;
    }
}