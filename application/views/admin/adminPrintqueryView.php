<?php
class adminPrintqueryView extends AdminView
{
    public $query_result = null;

    function __construct()
    {
        $this->lang_map["admin_prq"] = array(
            "label" => array(
                "en" => "Enter query",
                "rus" => "Введите запрос",
            ),
            "btn" => array(
                "en" => "print",
                "rus" => "Печать",
            ),
            "h2" => array(
                "en" => "Result",
                "rus" => "Результаты",
            ),
            "susses" => array(
                "en" => "SUSSES",
                "rus" => "Успенно",
            ),
            "row" => array(
                "en" => "row(s)",
                "rus" => "запись(ей)",
            ),
            "susses_no_rows" => array(
                "en" => "SUSSES: no row(s)",
                "rus" => "Успенно: нет записей",
            ),
        );

        $this->styles[] = "/css/admin/form-option.css";
        $this->styles[] = "/css/admin/sql.css";
        $this->styles[] = "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css";

        $this->scripts[] = "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js";
        $this->scripts[] = "/js/admin/queryPrint.js";

        parent::__construct();
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame admin'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<div class='query-block'>".
            "<form class='form-option'>".
            "<div class='form-option-line'>".
            "<label for='targetQuery'>".$this->lang_map["admin_prq"]["label"][$_SESSION["lang"]].":</label>"."<label></label>".
            "</div>".
            "<div class='form-option-line'>".
            "<textarea name='targetQuery' id='targetQuery' rows='5' placeholder='select...'></textarea>".
            "</div>".
            "<div class='form-option-line'>".
            "<label for='targetQuery'>limit </label>".
            "<input type='number' name='qp-limit' min='1' max='100' value='10'>".
            "</div>".
            "<div class='form-option-cntrl'>".
            "<input type='button' value='".$this->lang_map["admin_prq"]["btn"][$_SESSION["lang"]]."' onclick='queryPrint()'>".
            "</div>".
            "</form>".
            "</div>".
            "<div class='query-result'>".
            "<h2>".$this->lang_map["admin_prq"]["h2"][$_SESSION["lang"]].": </h2>".
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
            $return['log']= $this->lang_map["admin_prq"]["susses"][$_SESSION["lang"]].": (".$this->query_result->rowCount().") ".
                $this->lang_map["admin_prq"]["row"][$_SESSION["lang"]];
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
            $return['log']= $this->lang_map["admin_prq"]["susses_no_rows"][$_SESSION["lang"]];
        }
        return $return;
    }
}