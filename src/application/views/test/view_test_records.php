<?php
class view_test_records extends SiteView
{
    public $process_url;
    public $tableName;
    public $table_selector;

    function __construct()
    {
        parent::__construct();
        //$this->styles[] = JOINT_SITE_EXEC_DIR."/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css";

        //echo 111;
        //exit;
        //$this->styles[] = JOINT_SITE_EXEC_DIR."/css/test/test-rec.css";
    }

    function print_select_tbl_panel()
    {
        $this->table_selector = array(
            "en" => "Table selector",
            "ru" => "Выбор таблицы",
        )[JOINT_SITE_APP_LANG];

        $return_text = "<div class='contentBlock-frame'><div class='contentBlock-center'>" .
            "<div class='contentBlock-wrap'>".
            "<div class='table-selector'><label for='table-selector'>".$this->table_selector.": </label>".
            "<select name='table-selector' id='table-selector' ".
            "onchange='let new_loc_table=&quot;".JOINT_SITE_APP_REF."/test/records/&quot;+this.options[this.selectedIndex].text; 
           window.location.href = new_loc_table'>";
        if($this->view_data){
            while ($table_row = $this->view_data->fetch()){
                $return_text .= "<option value='".$table_row[0]."'";
                if($this->tableName == $table_row[0]){
                    $return_text .= " selected";
                }
                $return_text .= ">".$table_row[0]."</option>";
            }
        }
        $return_text .= "</select>".
            "</div>".
            "</div></div></div>".
            "<link rel='stylesheet' href='".JOINT_SITE_EXEC_DIR."/css/test/test-rec.css'>";
        return $return_text;
    }

   // function print_page_content()
   // {
   //     $this->print_select_tbl_panel();
   //     parent::print_page_content(); // TODO: Change the autogenerated stub
    //}
}