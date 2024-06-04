<?php
class moduleMenu
{
    static function print_module_menu($module_alias, $module_info, $m_process_url){
        global $request;

        $mUri_exp = explode("/", $m_process_url);
        $mUri_expLength = count($mUri_exp);

        if ($module_info["moduleTable"]) {
            $return_text = "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
                "<div class='contentBlock-wrap'>" .
                "<div class='sub-menu'>";
            if($module_alias){

                $return_text .= "<a href='" . $m_process_url . "' class='home-module";
                if (($request["routes"][$mUri_expLength-1] == $mUri_exp[$mUri_expLength - 1])
                    and !$request["routes"][$mUri_expLength]) {
                    $return_text .= " active";
                }
                $return_text .= "'>" . $module_alias . "</a>";

            }

            $return_text .= "<a href='" . $m_process_url;
            if ($module_info["moduleTable"]["tUrl"]) {
                $custom_dir = $module_info["moduleTable"]["tUrl"];
            } else {
                $custom_dir = $module_info["moduleTable"]["tableName"];
            }
            $return_text .= "/" . $custom_dir . "' class='module-table";
            if ($request["routes"][$mUri_expLength] == $custom_dir) {
                $return_text .= " active";
            }
            $return_text .= "'> " . $module_info["moduleTable"]["aliases"][$_SESSION[JS_SAIK]["lang"]] . "</a>";

            if ($module_info["bindTables"]) {
                foreach ($module_info["bindTables"] as $tableName => $tOption) {
                    $return_text .= "<a href='" . $m_process_url . "/";
                    if ($tOption["tUrl"]) {
                        $custom_dir = $tOption["tUrl"];
                    } else {
                        $custom_dir = $tableName;
                    }
                    $return_text .= $custom_dir . "' ";
                    if ($request["routes"][$mUri_expLength] == $custom_dir) {
                        $return_text .= "class='active' ";
                    }
                    $return_text .= "> " . $tOption["aliases"][$_SESSION[JS_SAIK]["lang"]]."</a>";
                }
            }
            $return_text .= "</div>" .
                "</div>" .
                "</div>" .
                "</div>";
        }
        return $return_text;
    }
}