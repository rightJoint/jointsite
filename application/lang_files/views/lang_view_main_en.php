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
        $this->product_custom = array(
            "h3-1" => "Тематические ветки",
            "h3-2" => "Core - ветки",
        );
    }
}