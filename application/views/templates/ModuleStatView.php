<?php
class ModuleStatView extends SiteView
{
    public $module_stat = null;
    public $module_config = null;
    public $m_process_url = null;
    public $module_name = null;

    function __construct()
    {
        parent::__construct();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/views/templates/ModuleMenu.php";
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/records.css";
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/module.css";
    }

    function LoadViewLang_custom()
    {
        parent::LoadViewLang_custom();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/views/templates/lang_view_ModuleStat_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_ModuleStat_".$_SESSION[JS_SAIK]["lang"];
    }

    function set_head_array()
    {

        parent::set_head_array();

        $this->logo = $this->shortcut_icon = $this->lang_map->menu_blocks["modules_menu"]["menu_items"][$this->module_name]["mImg"];
        $this->lang_map->head["h1"] = $this->lang_map->head["title"] =
        $this->lang_map->head["description"] =
            $this->lang_map->menu_blocks["modules_menu"]["menu_items"][$this->module_name]["aliasMenu"];
    }

    function print_page_content()
    {
        echo moduleMenu::print_module_menu($this->lang_map->menu_blocks["modules_menu"]["menu_items"][$this->module_name]["aliasMenu"],
            $this->module_config, $this->m_process_url);
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<div class='module-stat'>";

        if($this->module_info["mAliases"][$_SESSION[JS_SAIK]["lang"]]){
            echo "<h2>".$this->lang_map["mAliases"][$_SESSION[JS_SAIK]["lang"]]."</h2>";
        }

        echo "<table>".
            "<tr class='fCaption'>".
            "<td>".$this->lang_map->fCaption["Name"]."</td>".
            "<td>".$this->lang_map->fCaption["table"]."</td>".
            "<td>".$this->lang_map->fCaption["relationship"]."</td>".
            "<td>".$this->lang_map->fCaption["Count"]."</td>".
            "</tr>";
        echo "<tr class='mst'>".
            "<td>".$this->module_config["moduleTable"]["aliases"][$_SESSION[JS_SAIK]["lang"]]."</td>".
            "<td>".$this->module_config["moduleTable"]["tableName"]."</td>".
            "<td>master</td>".
            "<td>".$this->module_stat["moduleTable"]["countRecords"]."</td>".
            "</tr>";

        if($this->module_stat["bindTables"]){
            foreach ($this->module_config["bindTables"] as $tName => $tOptions){
                echo "<tr class='mst'>".
                    "<td>".$tOptions["aliases"][$_SESSION[JS_SAIK]["lang"]]."</td>".
                    "<td>".$tName."</td>".
                    "<td>";
                if($tOptions["relationships"]){
                    foreach ($tOptions["relationships"] as $fieldMain => $fieldSlave){
                        echo "<p>".$fieldMain." => ".$fieldSlave."</p>";
                    }
                }else{
                    echo $this->lang_map->rel_not_set;
                }
                echo "</td>".
                    "<td>".$this->module_stat["bindTables"][$tName]["countRecords"]."</td>".
                    "</tr>";
            }
        }
        echo "</table>";
        echo "</div>".
            "</div>".
            "</div>".
            "</div>";
    }
}