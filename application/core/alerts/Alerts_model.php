<?php
class Alerts_model
{
    public $lang_map = array();

    public $response_codes = array(
        "notFound" => 404,
        "stab" =>  200,
        "access" => 403,
        "connection" =>200,
        "request" => 400,
        "config" => 200,
        "XXX" =>  200,
    );

    function __construct()
    {
        global $request;
        require_once ($_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/application/lang_files/models/lang_model_alerts_".$_SESSION["lang"].".php");
        $lang_name = "lang_model_alerts_".$_SESSION["lang"];
        $this->lang_map = new $lang_name;
    }
}