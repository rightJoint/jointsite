<?php
class ModulesStatView extends View
{
    public $modules = null;

    function __construct()
    {
        $this->styles[] = "/css/records.css";
        $this->styles[] = "/css/module.css";

        $this->lang_map["rel_not_set"] = array(
            "en" => "relationships not set",
            "rus" => "связи не заданы",
        );
        $this->lang_map["fCaption"] = array(
            "Name" => array(
                "en" => "Name",
                "rus" => "Имя",
            ),
            "table" => array(
                "en" => "table",
                "rus" => "Таблица",
            ),
            "relationship" => array(
                "en" => "relationships",
                "rus" => "Связи",
            ),
            "Count" => array(
                "en" => "Count",
                "rus" => "К-во",
            ),
        );
    }

    function print_page_content()
    {
        $this->modulesSubMenu();
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<div class='module-stat'>";

        if($this->modules["mAliases"][$_SESSION["lang"]]){
            echo "<h2>".$this->modules["mAliases"][$_SESSION["lang"]]."</h2>";
        }

        echo "<table>".
            "<tr class='fCaption'>".
            "<td>".$this->lang_map["fCaption"]["Name"][$_SESSION["lang"]]."</td>".
            "<td>".$this->lang_map["fCaption"]["table"][$_SESSION["lang"]]."</td>".
            "<td>".$this->lang_map["fCaption"]["relationship"][$_SESSION["lang"]]."</td>".
            "<td>".$this->lang_map["fCaption"]["Count"][$_SESSION["lang"]]."</td>".
            "</tr>";
        echo "<tr class='mst'>".
            "<td>".$this->modules["moduleTable"]["aliases"][$_SESSION["lang"]]."</td>".
            "<td>".$this->modules["moduleTable"]["tableName"]."</td>".
            "<td>master</td>".
            "<td>".$this->modules["moduleTable"]["countRecords"]."</td>".
            "</tr>";

        if($this->modules["bindTables"]){
            foreach ($this->modules["bindTables"] as $tName => $tOptions){
                echo "<tr class='mst'>".
                    "<td>".$tOptions["aliases"][$_SESSION["lang"]]."</td>".
                    "<td>".$tName."</td>".
                    "<td>";
                if($tOptions["relationships"]){
                    foreach ($tOptions["relationships"] as $fieldMain => $fieldSlave){
                        echo "<p>".$fieldMain." => ".$fieldSlave."</p>";
                    }
                }else{
                    echo $this->lang_map["rel_not_set"][$_SESSION["lang"]];
                }
                echo "</td>".
                    "<td>".$tOptions["countRecords"]."</td>".
                    "</tr>";
            }
        }
        echo "</table>";
        echo "</div>".
            "</div>".
            "</div>".
            "</div>";
    }

    function modulesSubMenu()
    {

        global $routes;

        $mUri_exp = explode("/", $this->modules["mUrl"]);
        $mUri_expLength = count($mUri_exp);

        if ($this->modules["moduleTable"]) {
            $return_ajax .= "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
                "<div class='contentBlock-wrap'>" .
                "<div class='sub-menu'>";
            $return_ajax .= "<a href='/" . $this->modules["mUrl"] . "' class='home-module";
            if (($routes[$mUri_expLength] == $mUri_exp[$mUri_expLength - 1])
                and !$routes[$mUri_expLength + 1]) {
                $return_ajax .= " active";
            }
            $return_ajax .= "'>" . $this->modules["mAliases"][$_SESSION["lang"]] . "</a>" .
                "<a href='/" . $this->modules["mUrl"];
            if ($this->modules["moduleTable"]["tUrl"]) {
                $custom_dir = $this->modules["moduleTable"]["tUrl"];
            } else {
                $custom_dir = $this->modules["moduleTable"]["tableName"];
            }
            $return_ajax .= "/" . $custom_dir . "' class='module-table";
            if ($routes[$mUri_expLength + 1] == $custom_dir) {
                $return_ajax .= " active";
            }
            $return_ajax .= "'> " . $this->modules["moduleTable"]["aliases"][$_SESSION["lang"]] . "</a>";

            if ($this->modules["bindTables"]) {
                foreach ($this->modules["bindTables"] as $tableName => $tOption) {
                    $return_ajax .= "<a href='/" . $this->modules["mUrl"] . "/";
                    if ($tOption["tUrl"]) {
                        $custom_dir = $tOption["tUrl"];
                    } else {
                        $custom_dir = $tableName;
                    }
                    $return_ajax .= $custom_dir . "' ";
                    if ($routes[$mUri_expLength + 1] == $custom_dir) {
                        $return_ajax .= "class='active' ";
                    }
                    $return_ajax .= "> " . $tOption["aliases"][$_SESSION["lang"]] . "</a>";
                }
            }
            $return_ajax .= "</div>" .
                "</div>" .
                "</div>" .
                "</div>";
        }
        echo $return_ajax;
    }
}