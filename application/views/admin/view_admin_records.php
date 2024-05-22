<?php
class view_admin_records extends View
{
    public $admin_process_url;
    public $tableName;
    public $table_selector;

    function print_select_tbl_panel()
    {
        $this->table_selector = array(
            "en" => "Table selector",
            "rus" => "Выбор таблицы",
        )[$_SESSION[JS_SAIK]["lang"]];

        if(LOWER_CASE_TABLE_NAMES){
            $lowercase_tableName = strtolower($this->tableName);
        }else{
            $lowercase_tableName = $this->tableName;
        }

        $return_text = "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap'>".
            "<div class='table-selector'><label for='table-selector'>".$this->table_selector.": </label>".
            "<select name='table-selector' id='table-selector' onchange='changeTable()'>";
        if($this->view_data){
            while ($table_row = $this->view_data->fetch()){
                $return_text .= "<option value='".$table_row[0]."'";
                if($lowercase_tableName == $table_row[0]){
                    $return_text .= " selected";
                }
                $return_text .= ">".$table_row[0]."</option>";
            }
        }
        $return_text .= "</select>".
            "</div>".
            "</div></div></div>".
            "<link rel='stylesheet' href='".JOINT_SITE_EXEC_DIR."/css/admin/records.css'>".
            "<script>var admin_process_url = '".$this->admin_process_url."';</script>".
            "<script src='" . JOINT_SITE_EXEC_DIR . "/js/admin/records.js'></script>";
        return $return_text;
    }
}