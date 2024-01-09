<?php
class adminListView extends RecordsListView
{
    public function __construct()
    {
        $this->lang_map["table-selector"] =array(
            "en" => "Table selector",
            "rus" => "Выбор таблицы",
        );

        $this->scripts[] = "/js/admin/records.js";
        $this->styles[] = "/css/admin/records.css";
        parent::__construct();
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap'>".
            "<div class='table-selector'><label for='table-selector'>".$this->lang_map["table-selector"][$_SESSION["lang"]].": </label>".
            "<select name='table-selector' id='table-selector' onchange='changeTable()'>";
        if($this->view_data){
            while ($table_row = $this->view_data->fetch()){
                echo "<option value='".$table_row[0]."'";
                if($this->h2 == $table_row[0]){
                    echo " selected";
                }
                echo ">".$table_row[0]."</option>";
            }
        }
        echo "</select>".
            "</div>".
            "</div></div></div>";
        parent::print_page_content();
    }
}