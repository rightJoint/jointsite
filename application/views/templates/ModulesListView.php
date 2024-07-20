<?php
class ModulesListView extends SiteView
{
    public $logo = JOINT_SITE_EXEC_DIR."/img/popimg/leverage.png";
    public $sm_process_url = JOINT_SITE_EXEC_DIR."/siteman";
    public $metrik_block = false;

    function __construct()
    {
        parent::__construct();
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/records.css";
    }

    function set_head_array()
    {
        parent::set_head_array();
        if(!$this->lang_map->menu_blocks["modules_menu"]["menu_items"]){
            jointSite::throwErr("access", "no modules to display in ModulesListView");
        }
    }

    function LoadViewLang_custom()
    {
        parent::LoadViewLang_custom();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/views/templates/lang_view_ModulesList_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_ModulesList_".$_SESSION[JS_SAIK]["lang"];
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap'><div class='modules-list'>" .
            "<h2>Список модулей</h2>";
        foreach ($this->lang_map->menu_blocks["modules_menu"]["menu_items"] as $mName => $mOpt) {
            if ($mOpt["mImg"]) {
                $mImg = $mOpt["mImg"];
            } else {
                $mImg = JOINT_SITE_EXEC_DIR."/img/popimg/avatar-default.png";
            }
            echo "<div class='modules-info'>" .
                "<div class='modules-info-img'>" .
                "<img src='" . $mImg . "'>" .
                "</div>" .
                "<div class='modules-info-name'><a href='".$this->sm_process_url."/" . $mName . "' ".
                "title='".$mOpt["altText"]."'>" .
                $mOpt["aliasMenu"] . "</a></div>" .
                "</div>";
        }
        echo "</div>" .
            "</div>" .
            "</div>" .
            "</div>";
    }
}