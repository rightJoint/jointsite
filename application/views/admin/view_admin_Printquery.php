<?php
class view_admin_printquery extends view_admin
{
    public $query_result = null;

    function __construct()
    {
        parent::__construct();

        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/admin/form-option.css";
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/admin/sql.css";
        $this->styles[] = JOINT_SITE_EXEC_DIR."/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css";

        $this->scripts[] = JOINT_SITE_EXEC_DIR."/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js";
        $this->scripts[] = JOINT_SITE_EXEC_DIR."/js/admin/queryPrint.js";
    }

    function LoadViewLang_custom()
    {
        parent::LoadViewLang_custom();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/views/lang_view_admin_Printquery_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_admin_Printquery_".$_SESSION[JS_SAIK]["lang"];
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame admin'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<div class='query-block'>".
            "<form class='form-option'>".
            "<div class='form-option-line'>".
            "<label for='targetQuery'>".$this->lang_map->admin_prq["label"].":</label>"."<label></label>".
            "</div>".
            "<div class='form-option-line'>".
            "<textarea name='targetQuery' id='targetQuery' rows='5' placeholder='select...'></textarea>".
            "</div>".
            "<div class='form-option-line'>".
            "<label for='targetQuery'>limit </label>".
            "<input type='number' name='qp-limit' min='1' max='100' value='10'>".
            "</div>".
            "<div class='form-option-cntrl'>".
            "<input type='button' value='".$this->lang_map->admin_prq["btn"]."' onclick='queryPrint()'>".
            "</div>".
            "</form>".
            "</div>".
            "<div class='query-result'>".
            "<h2>".$this->lang_map->admin_prq["h2"].": </h2>".
            "<div class='result-info'>-</div>".
            "<div class='query-result-table'></div>".
            "</div>".
            "</div>".
            "</div></div>";
    }

    function print_sql_results()
    {
        $return = array(
            "log" => null,
            "table" => null,
            "result" => true,
        );
        if($this->query_result->rowCount() > 0){
            $return['log']= $this->lang_map->admin_prq["success"].": (".$this->query_result->rowCount().") ".
                $this->lang_map->admin_prq["row"];
            $return['table'].= "<table>";
            $queryPosting_row = $this->query_result->fetch(PDO::FETCH_ASSOC);
            $return['table'].="<tr class='caption'>";
            foreach ($queryPosting_row as $key=>$value){
                $return['table'].="<td>".$key."</td>";
            }
            $return['table'].="</tr><tr>";
            foreach ($queryPosting_row as $key=>$value){
                $return['table'].="<td>".$value."</td>";
            }
            $return['table'].="</tr>";
            if($this->query_result->rowCount() >1){
                while ($queryPosting_row = $this->query_result->fetch(PDO::FETCH_ASSOC)){
                    $return['table'].="<tr>";
                    foreach ($queryPosting_row as $key=>$value){
                        $return['table'].="<td>".$value."</td>";
                    }
                    $return['table'].="</tr>";
                }
            }
            $return['table'].= "</table>";
        }else{
            $return['log']= $this->lang_map->admin_prq["success_no_rows"];
        }
        return $return;
    }
}