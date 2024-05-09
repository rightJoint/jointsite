<?php
class lang_view_main_en extends lang_view_en
{
    function __construct()
    {
        $this->branches = array(
            "h2" => "Branches of this site",
            "branch-version" => "Version",
            "branch-get" => "Get branch",
            "learn-more" => "Learn more",
            "depend" => "dependencies",
            "site-descr" => "This is double language web site with modal win menu. Engine: php, js. Pattern: MVC.",
        );
        $this->branchesList = array(
            "main" => array(
                "title" => "Branch Application (Main)",
                "test_ref" => JOINT_SITE_EXEC_DIR."/products/jointsite/main",
                "test_ref_title" => "Do test",
                "descr" => "Set up application as website or use into site at specified url.",
                "version" => "v1.0",
                "get" => "<a href='https://github.com/rightJoint/jointsite/tree/main' title='скачать с гит хаба'>link to github</a>",
                "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/main' title='see detail info about app'>see details</a>",
                "depend" => "no dependencies",
            ),
        );
        $this->product_custom = array(
            "h3-1" => "Тематические ветки",
            "h3-2" => "Core - ветки",
        );
    }
}