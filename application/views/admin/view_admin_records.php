<?php
class view_admin_records extends View
{
    function print_selet_tbl_panel()
    {
        if($this->view_data->rowCount()){
            return $this->view_data->rowCount();
        }
    }
    //function print_page_content()
}