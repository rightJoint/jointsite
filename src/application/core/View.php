<?php
class View
{
    public $view_data;
    public $controller_action;
    public $header_content_type = "text/html; charset=utf-8";

    function generate()
    {
        header("Content-Type: ".$this->header_content_type);
        echo $this->view_data;
    }

    function generateJson($data)
    {
        global $js_result;
        $js_result["view_generateJson_called"] = true;

        header("Content-Type: ".$this->header_content_type);
        echo json_encode($data, true);
    }
}