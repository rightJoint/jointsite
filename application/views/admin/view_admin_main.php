<?php
class view_admin_main extends view_admin
{
    public $admin_process_url = "/test/phpmysqladmin";

    function __construct()
    {
        parent::__construct();
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/admin/startView.css";
    }

    function print_page_content()
    {
        echo  "<div class='contentBlock-frame admin-main'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
            "<h2>".$this->lang_map->admin_h2."</h2><div class='contentMenu'>";
        foreach ($this->lang_map->menu_blocks["admin"]["menu_items"] as $admin_mod=>$mod_opt){
            echo "<div class='contentCell'>".
                "<div class='contentCell-img'>".
                "<img src='".$this->img_for_modules[$admin_mod]."'>".
                "</div><div class='contentCell-text'>".
                "<a href='".$this->admin_process_url."/".$admin_mod."'>".$mod_opt["aliasMenu"]."</a>".
                "<p>".$mod_opt["altText"]."</p></div></div>";
        }
        echo "</div>".
            "</div></div></div>";
    }
}