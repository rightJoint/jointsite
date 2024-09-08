<?php
class controller_test extends Controller
{
    function action_testErr()
    {
        jointSite::throwErr("XXX", "xxx");
    }
}