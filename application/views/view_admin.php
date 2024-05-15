<?php
class view_admin extends SiteView
{
    public $shortcut_icon = "/img/popimg/admin-logo.png";
    public $logo = "/img/popimg/admin-logo.png";

    public $img_for_modules = array(
        "server" => "/img/admin/server_logo.png",
        "users" => "/img/admin/user_logo.png",
        "sql" => "/img/admin/sql_logo.png",
        "printquery" => "/img/admin/queryPrint_logo.png",
        "tables" => "/img/admin/tables_logo.png",
        "records" => "/img/admin/editRecords.png",
        );

    public $robot_no_index = true;
    public $metrik_block = false;

    function __construct()
    {
        parent::__construct();

        global $routes;

        if(!$routes[2]){
            $this->logo = "/img/popimg/admin-logo.png";
        }else{
            $this->lang_map->head["h1"] = $this->lang_map->adminblock["modules_list"][$routes[2]]["aliasMenu"];
            $this->lang_map->head["title"] = $this->lang_map->adminblock["modules_list"][$routes[2]]["aliasMenu"];
            $this->lang_map->head["description"] = $this->lang_map->adminblock["modules_list"][$routes[2]]["altText"];
            $this->logo = $this->img_for_modules[$routes[2]];
        }
    }

    function load_lang_files()
    {
        parent::load_lang_files();
        require_once "application/lang_files/views/admin/lang_view_admin_main_".$_SESSION["lang"].".php";
        return "lang_view_admin_main_".$_SESSION["lang"];
    }
}