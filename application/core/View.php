<?php
class View
{
    public $view_data;

    function generate()
    {
        echo $this->view_data;
    }

    static function generateJson($data)
    {
        echo json_encode($data, true);
    }
}