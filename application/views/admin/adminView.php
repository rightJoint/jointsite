<?php
class AdminView extends View
{
    public $shortcut_icon = "/img/popimg/admin-favicon.png";
    public $logo = "/img/popimg/admin-logo.png";

    public $img_for_modules = array(
        "server" => "/img/admin/server_logo.png",
        "users" => "/img/admin/user_logo.png",
        "sql" => "/img/admin/sql_logo.png",
        "printquery" => "/img/admin/queryPrint_logo.png",
        "tables" => "/img/admin/tables_logo.png",
        "records" => "/img/admin/editRecords.png",
        );


    function __construct()
    {
        global $routes;

        if(!$routes[2]){
            $this->lang_map["head"]["h1"] = array(
                "en" => "Admin",
                "rus" => "Админка",
            );
            $this->lang_map["head"]["title"] = array(
                "en" => "Admin",
                "rus" => "Админка",
            );
            $this->lang_map["head"]["title"] = array(
                "en" => "Admin for mysql",
                "rus" => "Админка для mysql",
            );
            $this->logo = "/img/popimg/admin-logo.png";
        }else{
            $this->lang_map["head"]["h1"] = $this->lang_map["admin_block"]["modules_list"][$routes[2]]["aliasMenu"];
            $this->lang_map["head"]["title"] = $this->lang_map["admin_block"]["modules_list"][$routes[2]]["aliasMenu"];
            $this->lang_map["head"]["description"] = $this->lang_map["admin_block"]["modules_list"][$routes[2]]["altText"];
            $this->logo = $this->img_for_modules[$routes[2]];
        }

    }
}