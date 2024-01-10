<?php
class moduleMenu
{
    static function print_module_menu($module){
        global $routes;

        $mUri_exp = explode("/", $module["mUrl"]);
        $mUri_expLength = count($mUri_exp);

        if ($module["moduleTable"]) {
            $return_text = "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
                "<div class='contentBlock-wrap'>" .
                "<div class='sub-menu'>";
            $return_text .= "<a href='/" . $module["mUrl"] . "' class='home-module";
            if (($routes[$mUri_expLength] == $mUri_exp[$mUri_expLength - 1])
                and !$routes[$mUri_expLength + 1]) {
                $return_text .= " active";
            }
            $return_text .= "'>" . $module["mAliases"][$_SESSION["lang"]] . "</a>" .
                "<a href='/" . $module["mUrl"];
            if ($module["moduleTable"]["tUrl"]) {
                $custom_dir = $module["moduleTable"]["tUrl"];
            } else {
                $custom_dir = $module["moduleTable"]["tableName"];
            }
            $return_text .= "/" . $custom_dir . "' class='module-table";
            if ($routes[$mUri_expLength + 1] == $custom_dir) {
                $return_text .= " active";
            }
            $return_text .= "'> " . $module["moduleTable"]["aliases"][$_SESSION["lang"]] . "</a>";

            if ($module["bindTables"]) {
                foreach ($module["bindTables"] as $tableName => $tOption) {
                    $return_text .= "<a href='/" . $module["mUrl"] . "/";
                    if ($tOption["tUrl"]) {
                        $custom_dir = $tOption["tUrl"];
                    } else {
                        $custom_dir = $tableName;
                    }
                    $return_text .= $custom_dir . "' ";
                    if ($routes[$mUri_expLength + 1] == $custom_dir) {
                        $return_text .= "class='active' ";
                    }
                    $return_text .= "> " . $tOption["aliases"][$_SESSION["lang"]] . "</a>";
                }
            }
            $return_text .= "</div>" .
                "</div>" .
                "</div>" .
                "</div>";
        }
        return $return_text;
    }

    static function sitemanMenuAccess()
    {
        global $routes;

        $modulesInfo = null;
        include JOINT_CONF_DIR."/modulesInfo.php";

        $access_items = null;

        if($modulesInfo){
            if ($_SESSION["site_user"]["user_id"]) {
                foreach ($modulesInfo as $siteman_mod => $mod_opt) {
                    $addInMenu = false;
                    if($mod_opt["accessGroups"]){
                        if($_SESSION["site_user"]["groups"]["F84A347D-C278-4EB8-82FB-CD41ED33B3E0"] //all menu for Admin group
                        ){
                            $addInMenu = true;
                        }else{
                            foreach ($mod_opt["accessGroups"] as $accessGroup){
                                if($_SESSION["site_user"]["groups"][$accessGroup]){
                                    $addInMenu = true;
                                    break;
                                }
                            }
                        }
                    }else{
                        $addInMenu = true;
                    }

                    if($addInMenu){
                        $access_items[$mod_opt["mUrl"]]["mAlias"] = $mod_opt["mAliases"][$_SESSION["lang"]];
                        if ($routes[2] == $siteman_mod) {
                            $access_items[$mod_opt["mUrl"]]["active"] = true;
                        }
                    }
                }
            }
        }
        return $access_items;
    }
}