<?php
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
        global $request;
        require_once (JOINT_SITE_REQ_LANG."/models/lang_model_alerts.php");
        $lang_name = "lang_model_alerts";
        $this->lang_map = new $lang_name;
    }
}