<?php

namespace jointSite\Core\Logger;

class JointSiteLoggerModel
{
    public $lang_map = array();

    public $response_codes = array(
        "notFound" => 404,
        "stab" =>  200,
        "access" => 403,
        "connection" =>503,
        "request" => 400,
        "config" => 200,
        "XXX" =>  200,
    );

    function __construct()
    {
        require_once(JOINT_SITE_REQ_LANG."/Models/LangFiles_".JOINT_SITE_APP_LANG."_Models_AlertsModel.php");
        $return_lang = "LangFiles_".JOINT_SITE_APP_LANG."_Models_AlertsModel";

        $this->lang_map = new $return_lang;
    }
}