<?php
class view_test extends SiteView
{
    function print_page_content()
    {
        parent::print_page_content();
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<ul>".
            "<li><a href='".JOINT_SITE_EXEC_DIR."/test/records'>Test Records</a></li>".
            "</ul>".
        "</div></div></div>";
    }
}