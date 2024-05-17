<?php
class view_admin_tables extends view_admin
{
    public $tables = null;

    function __construct()
    {
        parent::__construct();

        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/admin/tables.css";
        $this->styles[] = JOINT_SITE_EXEC_DIR."/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css";

        $this->scripts[] = JOINT_SITE_EXEC_DIR."/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js";
        $this->scripts[] = JOINT_SITE_EXEC_DIR."/js/admin/tables.js";
    }

    function LoadViewLang_custom()
    {
        parent::LoadViewLang_custom();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/views/lang_view_admin_tables_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_admin_tables_".$_SESSION[JS_SAIK]["lang"];
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame admin'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
            "<div class='optionsPanel'><div class='uploadOptions'>".
            "<label for='prefixTag'>".$this->lang_map->admin_tables["pefix"]."</label><input type='text' id='prefixTag' name='prefixTag'>".
            "<label for='dateTag'>".$this->lang_map->admin_tables["dateTag"]."</label>".
            "<input type='checkbox' id='dateTag' name='dateTag' checked>".
            "</div>".
            "<div class='btnPanel'>".
            "<input type='button' class='uploadAll' value='".$this->lang_map->admin_tables["btn_upLoadAll"]."' onclick='upLoadAll()'>".
            "<input type='button' class='refresh' value='".$this->lang_map->admin_tables["btn_refresh"]."' onclick='refreshTables()'>".
            "<input type='button' class='showLog' value='".$this->lang_map->admin_tables["btn_log"]."' onclick='showLog()'>".
            "</div></div>".
            "</div></div></div>".
            "<div class='contentBlock-frame'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
            "<div class='tablesList'>";

        $this->tables_list();

        echo "</div></div></div></div>".
            "<div class='modal tablesLog'><div class='overlay'></div><div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='modal-right'><img src='".JOINT_SITE_EXEC_DIR."/img/admin/closeModal.png' title='закрыть'></div>".
            "<div class='logPanel'><h3>".$this->lang_map->admin_tables["h3"].":</h3></div>".
            "</div></div></div>";
    }

    function tables_list()
    {
        echo "<div class='table-line caption'><div class='table-cell tblName'>".
            $this->lang_map->admin_tables["t_cap"]["table"].
            "</div>".
            "<div class='table-cell tblLst'>".
            $this->lang_map->admin_tables["t_cap"]["Lst"].
            "</div>".
            "<div class='table-cell tblExt'>".
            $this->lang_map->admin_tables["t_cap"]["Ext"].
            "</div>".
            "<div class='table-cell tblAct'>".
            $this->lang_map->admin_tables["t_cap"]["action"].
            "</div><div class='table-cell tblDwlTag'>".
            $this->lang_map->admin_tables["t_cap"]["tgt"].
            "</div></div>";
        if(is_array($this->tables)){
            foreach ($this->tables as $table_name=>$table_data) {
                echo "<div class='table-line'>";
                echo $this->table_cell($table_data["glob_name"], $table_data);
                echo "</div>";
            }
        }
    }

    function table_cell($table_name, $table_data)
    {
        $return = "<div class='table-cell tblName'><a href='";
        if ($table_data['exist']) {
            $return .= $this->admin_process_url."/records?table=".$table_name;
        }else{
            $return .= "#";
        }
        $return .= "'>" . $table_name . "</a></div>";
        $td_list = "<div class='table-cell tblLst'>";
        $td_exist = "<div class='table-cell tblExt'>";
        $td_create = "<div class='table-cell action-icon'>";
        $td_drop = "<div class='table-cell action-icon'>";
        $td_clear = "<div class='table-cell action-icon a-clear'>";
        $td_upload = "<div class='table-cell action-icon'>";
        $td_download = "<div class='table-cell action-icon'>";
        $td_select = "<div class='table-cell tblDwlTag'>";
        $option_text = null;
        $countArchives = 0;
        if(is_array($table_data["load"])){
            foreach ($table_data["load"] as $tableToLoad) {
                $option_text .= "<option value='" . $tableToLoad . "'>" .
                    basename($tableToLoad);
                "</option>";
                $countArchives++;
            }
        }
        if ($countArchives == 0) {
            $td_select .= " - ";
        } else {
            $td_select .= "<select>" . $option_text . "</select>";
        }
        $td_list .= "<input type='checkbox' ";
        $td_exist .= "<input type='checkbox' ";
        if ($table_data['exist']) {
            $td_exist .= "checked";
            $td_drop .= "<img src='".JOINT_SITE_EXEC_DIR."/img/popimg/drop-icon.png' action='drop' onclick='tables(this)'>";
            if ($table_data['qty'] > 0) {
                $td_clear.="<img src='".JOINT_SITE_EXEC_DIR."/img/admin/clear-icon.png' action='clear' onclick='tables(this)'>";
                $td_clear .= "<span>" .
                    " (" . $table_data['qty'] . ")</span>";
                $td_upload .= "<img src='".JOINT_SITE_EXEC_DIR."/img/admin/upLoad-icon.png' action='upLoad' onclick='tables(this)'>";
            } else {
                $td_clear .= " 0 ";
                $td_upload .= " - ";
            }
            if ($countArchives > 0) {
                $td_download .= "<img src='".JOINT_SITE_EXEC_DIR."/img/admin/downLoad-icon.png' action='download'  onclick='tables(this)'>";
            } else {
                $td_download .= " - ";
            }
            if ($table_data['list']) {
                $td_list .= "checked";
            }
            $td_create .= " - ";
        } else {
            $td_clear .= " - ";
            $td_upload .= " - ";
            $td_drop .= " - ";
            $td_download .= " - ";
            if ($table_data['list']) {
                $td_create .= "<img src='".JOINT_SITE_EXEC_DIR."/img/admin/create-icon.png' action='create' onclick='tables(this)'>";
                $td_list .= "checked";
            }
        }
        $td_exist .= " disabled>";
        $td_list .= " disabled>";
        $td_list .= "</div>";
        $td_exist .= "</div>";
        $td_create .= "</div>";
        $td_drop .= "</div>";
        $td_clear .= "</div>";
        $td_upload .= "</div>";
        $td_download .= "</div>";
        $td_select .= "</div>";
        return $return. $td_list . $td_exist . $td_create . $td_drop . $td_clear . $td_upload . $td_download . $td_select;

    }

    static function print_date_stamp()
    {
        global $mct;
        $lead_time = array(
            "en" => "lead time",
            "rus" => "время выполнения",
        );
        $end_time = microtime(true);
        return date( 'Y-m-d H:i:s').'</br>'.
            $lead_time[$_SESSION[JS_SAIK]["lang"]].": ".($end_time-$mct['start_time']);
    }
}