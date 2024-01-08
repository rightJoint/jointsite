<?php
include "application/views/view_main.php";
class Controller_Main extends Controller
{
    function __construct()
    {
        $this->model = new Model_Main();
        $this->view = new view_main();
    }
}