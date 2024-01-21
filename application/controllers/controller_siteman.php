<?php
include "application/core/Records/RecordsController.php";
include "application/core/Module/ModuleRecordsController.php";

class Controller_Siteman extends ModuleRecordsController
{
    public $modules;

    function __construct()
    {
        $this->lang_map["menu-index-warning"] = array(
            "en" => "denied in controller siteman action index",
            "rus" => "Ошибка доступа в controller siteman action index",
        );

        $modulesInfo = null;
        require_once JOINT_CONF_DIR."/modulesInfo.php";

        $this->modules = $modulesInfo;

        parent::__construct();
    }

    function action_music()
    {
        if($this->fillDataList()){
            return true;
        }
        $this->module_process("music");
    }

    function action_groups()
    {
        $this->module_process("groups");
    }

    function action_users()
    {
        $this->module_process("users");
    }

    function action_notifications()
    {
        $this->module_process("notifications");
    }
    /*used in music*/
    function fillDataList()
    {
        global $routes;
        if($routes[2] == "music"){
            if(($_GET["fillDl"] == "yyy")
                and ($_GET["table"] == "musicTracks_dt")
                and ($_GET["album_id"])){
                $this->view = new View();
                $list_qry = "select musicTracks_dt.".$_GET["findField"].", musicTracks_dt.".$_GET["returnKey"]." from ".$_GET["table"]." ".
                    "left join musicTracksToAlb_dt on musicTracksToAlb_dt.track_id = musicTracks_dt.track_id ".
                    "and musicTracksToAlb_dt.album_id = '".$_GET["album_id"]."' ".
                    "where musicTracks_dt.".$_GET["findField"]." like '%".$_GET["findValue"]."%' ".
                    "and musicTracksToAlb_dt.album_id is null";
                $this->model = new Model();
                $list_res = $this->model->query($list_qry);
                $list_return = array("" => "");
                if($list_res->rowCount()){
                    while ($list_row = $list_res->fetch(PDO::FETCH_ASSOC)){
                        $list_return[$list_row[$_GET["returnKey"]]] = $list_row[$_GET["findField"]];
                    }
                }

                $this->view->generateJson($list_return);
                return true;
            }else{

                return parent::fillDataList();
            }

        }else{
            return parent::fillDataList();
        }
    }
}