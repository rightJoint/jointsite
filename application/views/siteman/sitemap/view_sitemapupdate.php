<?php
require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR . "/application/views/templates/RecordView.php";
require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR . "/application/views/templates/RecordListView.php";
require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR . "/application/views/templates/ModuleListView.php";
class view_sitemapupdate extends ModuleListView
{
    function __construct()
    {
        parent::__construct();
        $this->styles[] = JOINT_SITE_EXEC_DIR . "/css/siteman/sitemap-update.css";
    }

    function print_page_content()
    {
        $aliasMenu = null;
        if(isset($this->lang_map->menu_blocks["modules_menu"]["menu_items"][$this->module_name]["aliasMenu"])){
            $aliasMenu = $this->lang_map->menu_blocks["modules_menu"]["menu_items"][$this->module_name]["aliasMenu"];
        }
        echo moduleMenu::print_module_menu($aliasMenu, $this->module_config, $this->m_process_url);
        //echo moduleMenu::print_module_menu($this->module);
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap'>";

        $count_url = 0;
        $updated_text = "not updated";
        if($this->view_data){
            $count_url = $this->view_data;
            $updated_text = date("Y-m-d H:i:s");
        }
        echo "<div class='upd-stat'>".
            "<span class='stat-lbl'>count url:</span>".
            "<span class='stat-val'>".$count_url."</span>".
            "<span class='stat-lbl'>updated:</span>".
            "<span class='stat-val'>".$updated_text."</span>".
            "</div>".
            "<div class='map-lines'>";
        $handle = fopen($_SERVER["DOCUMENT_ROOT"]."/sitemap.xml", "r");
        $line_counter = 0;
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line_counter++;
                echo "<div class='map-line'><div class='line-num'>".$line_counter."</div><div class='line-text'>".$line."</div></div>";
            }
            fclose($handle);
        }

        echo "</div>".
            "</div>".
            "</div>".
            "</div>";
    }
}