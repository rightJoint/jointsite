<?php
require_once "application/core/Module/ModuleMenu.php";
include "application/core/Records/RecordsView.php";
include "application/core/Records/RecordsListView.php";
include "application/core/Module/ModuleListView.php";
class sitemapUpdateView extends ModuleListView
{
    function __construct()
    {
        parent::__construct();
        $this->styles[] = "/css/siteman/update-sitemap.css";
    }

    function print_page_content()
    {
        echo moduleMenu::print_module_menu($this->module);
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap'>";

        $count_url = 0;
        if($this->view_data){
            $count_url = $this->view_data;
        }
        echo "<div class='upd-stat'>".
            "<span class='stat-lbl'>count url:</span>".
            "<span class='stat-val'>".$count_url."</span>".
            "<span class='stat-lbl'>updated:</span>".
            "<span class='stat-val'>".date("Y-m-d H:i:s")."</span>".
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