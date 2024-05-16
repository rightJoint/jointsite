<?php
class view_admin extends SiteView
{
    public $admin_process_url;

    public $shortcut_icon = JOINT_SITE_EXEC_DIR."/img/popimg/admin-logo.png";
    public $logo = JOINT_SITE_EXEC_DIR."/img/popimg/admin-logo.png";

    public $img_for_modules = array(
        "server" => JOINT_SITE_EXEC_DIR."/img/admin/server_logo.png",
        "users" => JOINT_SITE_EXEC_DIR."/img/admin/user_logo.png",
        "sql" => JOINT_SITE_EXEC_DIR."/img/admin/sql_logo.png",
        "printquery" => JOINT_SITE_EXEC_DIR."/img/admin/queryPrint_logo.png",
        "tables" => JOINT_SITE_EXEC_DIR."/img/admin/tables_logo.png",
        "records" => JOINT_SITE_EXEC_DIR."/img/admin/editRecords.png",
        );

    public $robot_no_index = true;
    public $metrik_block = false;

    function __construct()
    {
        parent::__construct();
    }

    function LoadViewLang_custom()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/views/lang_view_admin_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_admin_".$_SESSION[JS_SAIK]["lang"];
    }

    function set_head_array()
    {
        $apurl_expl = explode("/", $this->admin_process_url);
        $apurl_cnt = count($apurl_expl);

        global $request;

        if(!$request["routes"][$apurl_cnt]){
            $this->logo = JOINT_SITE_EXEC_DIR."/img/popimg/admin-logo.png";
        }else{
            $this->lang_map->head["h1"] = $this->lang_map->menu_blocks["admin"]["menu_items"][$request["routes"][$apurl_cnt]]["aliasMenu"];
            $this->lang_map->head["title"] = $this->lang_map->menu_blocks["admin"]["menu_items"][$request["routes"][$apurl_cnt]]["aliasMenu"];
            $this->lang_map->head["description"] = $this->lang_map->menu_blocks["admin"]["menu_items"][$request["routes"][$apurl_cnt]]["altText"];
            $this->logo = $this->img_for_modules[$request["routes"][$apurl_cnt]];
        }
    }
}