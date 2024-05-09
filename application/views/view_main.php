<?php
class view_main extends SiteView
{
    public $current_branch = "main";

    function __construct()
    {
        parent::__construct();
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/main_view.css";
    }

    function set_head_array()
    {
        $this->lang_map->head["h1"] = $this->lang_map->branchesList[$this->current_branch]["title"];
        $this->lang_map->head["title"] .= " - ".$this->current_branch;
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section class='prod-about'>";

        echo $this->print_title();

        echo "</section>";
        $this->print_branches_block();

        echo    "</div></div></div>";
    }

    function print_branches_block()
    {
        echo "<div class='branches-block'>";
        echo "<h3>".$this->lang_map->product_custom["h3-2"]."</h3>";

        $this->print_branch("main", $this->lang_map->branchesList["main"]);

        echo "</div>";
    }

    function print_branch($b_name, $b_info)
    {
        echo "<div class='branch-block'>".
            "<div class='branch-img'>".
            "<img src='".$this->branches[$b_name]["img"]."'>".
            "</div>".
            "<div class='branch-main'>".
            "<div class='branch-title'>".
            "<a href='".$b_info["test_ref"]."' title='".$b_info["test_ref_title"]."'>".
            $b_info["title"].
            "</a>".
            "</div>".
            "<p>".
            $b_info["descr"].
            "</p>".
            "</div>".
            "<div class='branch-info'>".
            "<div class='branch-version'>".
            "<span>".$this->lang_map->branches["branch-version"].":</span>".
            $b_info["version"].
            "</div>".
            "<div class='branch-get'>".
            "<span>".$this->lang_map->branches["branch-get"].":</span>".
            $b_info["get"].
            "</div>".
            "<div class='learn-more'>".
            "<span>".$this->lang_map->branches["learn-more"].":</span>".
            $b_info["more"].
            "</div>".
            "<div class='depend'>".
            "<span>".$this->lang_map->branches["depend"].":</span>".
            $b_info["depend"].
            "</div>".
            "</div>".
            "</div>";
    }

    function print_title()
    {
        echo "<p>".
            $this->lang_map->branches["site-descr"]."<br>",
            $this->view_data."</p>";
    }

}