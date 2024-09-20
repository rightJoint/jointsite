<?php
class view_test extends SiteView
{
    function __construct()
    {
        parent::__construct();
        $this->styles[] = JOINT_SITE_EXEC_DIR."/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css";

        $this->scripts[] = JOINT_SITE_EXEC_DIR."/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js";
    }

    function print_page_content()
    {
        parent::print_page_content();
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<ul>".
            "<li><a href='".JOINT_SITE_APP_REF."/test/records'>Test Records</a></li>".
            "</ul>".
        "</div></div></div>";
    }
}