<?php
//include "application/views/view_main.php";
include "application/views/landing_view.php";
class Controller_Main extends Controller
{
    function __construct()
    {
        $this->model = new Model_Main();
        //$this->view = new view_main();
        $this->view = new landing_view();
    }
}