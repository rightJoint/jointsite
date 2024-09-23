<?php
class view_main extends SiteView
{
    public $current_branch = "record";

    function __construct()
    {
        parent::__construct();
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/main_view.css";
    }

    function set_head_array()
    {
        parent::set_head_array();
        $this->lang_map->head["h1"] = $this->lang_map->menu_blocks["branches"]["menu_items"][$this->current_branch]["aliasMenu"];
        $this->lang_map->head["title"] .= " - ".$this->lang_map->menu_blocks["branches"]["menu_items"][$this->current_branch]["aliasMenu"];
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

        $this->print_branch("record");

        echo "</div>";
    }

    function print_branch($b_name)
    {
        echo "<div class='branch-block'>".
            "<div class='branch-img'>".
            "<img src='".$this->branches[$b_name]["img"]."'>".
            "</div>".
            "<div class='branch-main'>".
            "<div class='branch-title'>".
            "<a href='".JOINT_SITE_APP_REF."/products/jointsite/".$b_name."' ".
            "title='".$this->lang_map->menu_blocks["branches"]["menu_items"][$b_name]["altText"]."'>".
            $this->lang_map->menu_blocks["branches"]["menu_items"][$b_name]["aliasMenu"].
            "</a>".
            "</div>".
            "<p>".
            $this->lang_map->menu_blocks["branches"]["menu_items"][$b_name]["descr"].
            "</p>".
            "</div>".
            "<div class='branch-info'>".
            "<div class='branch-version'>".
            "<span>".$this->lang_map->branches["branch-version"].":</span>".
            $this->lang_map->menu_blocks["branches"]["menu_items"][$b_name]["version"].
            "</div>".
            "<div class='branch-get'>".
            "<span>".$this->lang_map->branches["branch-get"].":</span>".
            $this->lang_map->menu_blocks["branches"]["menu_items"][$b_name]["get"].
            "</div>".
            "<div class='learn-more'>".
            "<span>".$this->lang_map->branches["learn-more"].":</span>".
            $this->lang_map->menu_blocks["branches"]["menu_items"][$b_name]["more"].
            "</div>".
            "<div class='depend'>".
            "<span>".$this->lang_map->branches["depend"].":</span>".
            $this->lang_map->menu_blocks["branches"]["menu_items"][$b_name]["depend"].
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