<?php
class Controller_Test extends Controller
{

    function action_main()
    {
        $this->action_index();
        //jointSite::throwErr("request", "test-err");
    }
}