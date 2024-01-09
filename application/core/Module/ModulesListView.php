<?php
class ModulesListView extends View
{
    public $modules = null;
    public $logo = "/img/popimg/leverage.png";
    public $access_items = null;

    function __construct()
    {
        $this->styles[] = "/css/records.css";
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap'><div class='modules-list'>" .
            "<h2>Список модулей</h2>";
        foreach ($this->modules as $mName => $mOpt) {
            $found_item = false;
            foreach ($this->access_items as $miUrl => $miOpt){
                if($mOpt["mUrl"] == $miUrl){
                    $found_item = true;
                }
            }
            if ($mOpt["mImg"]) {
                $mImg = $mOpt["mImg"];
            } else {
                $mImg = "/data/default-img.png";
            }
            if($found_item){
                echo "<div class='modules-info'>" .
                    "<div class='modules-info-img'>" .
                    "<img src='" . $mImg . "'>" .
                    "</div>" .
                    "<div class='modules-info-name'><a href='/" . $mOpt["mUrl"] . "'>" . $mOpt["mAliases"][$_SESSION["lang"]] . "</a></div>" .
                    "</div>";
            }
        }
        echo "</div>" .
            "</div>" .
            "</div>" .
            "</div>";
    }
}