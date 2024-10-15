<?php

namespace JointSite\Views\Test;

use JointSite\Views\SiteView;

class View_Test_Records extends SiteView
{
    public $process_url;
    public $tableName;
    public $table_selector;

    function printSelectTblPanel()
    {
        $this->table_selector = array(
            "en" => "Table selector",
            "ru" => "Выбор таблицы",
        )[JOINT_SITE_LW_LANG];

        $return_text = "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap'>".
            "<div class='table-selector'><label for='table-selector'>".$this->table_selector.": </label>".
            "<select name='table-selector' id='table-selector' ".
            "onchange='let new_loc_table=&quot;".JOINT_SITE_SL_LANG."/test/records/&quot;+this.options[this.selectedIndex].text; 
           window.location.href = new_loc_table'>";
        if($this->view_data){
            while ($table_row = $this->view_data->fetch()){
                $tr_key = key($table_row);
                $return_text .= "<option value='".$table_row[$tr_key]."'";
                if($this->tableName == $table_row[$tr_key]){
                    $return_text .= " selected";
                }
                $return_text .= ">".$table_row[$tr_key]."</option>";
            }
        }
        $return_text .= "</select>".
            "</div>".
            "</div></div></div>".
            "<link rel='stylesheet' href='/css/test/test-rec.css'>";
        return $return_text;
    }
}