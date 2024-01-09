<?php
class adminSqlView extends AdminView
{
    function __construct()
    {
        $this->lang_map["admin-sql"] = array(
            "label" => array(
                "en" => "Enter query",
                "rus" => "Введите запрос",
            ),
            "placeholder" => array(
                "en" => "your query",
                "rus" => "Ваш запрос",
            ),
            "btn" => array(
                "en" => "Execute",
                "rus" => "Выполнить",
            ),
            "h2" => array(
                "en" => "Execute",
                "rus" => "Выполнить",
            ),
        );

        $this->styles[] = "/css/admin/form-option.css";
        $this->styles[] = "/css/admin/sql.css";
        $this->styles[] = "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css";

        $this->scripts[] = "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js";
        $this->scripts[] = "/js/admin/sql.js";

        parent::__construct();
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame admin'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<div class='query-block'>".
            "<form class='form-option'>".
            "<div class='form-option-line'>".
            "<label for='targetQuery'>".$this->lang_map["admin-sql"]["label"][$_SESSION["lang"]].":</label><label></label>".
            "</div>".
            "<div class='form-option-line'>".
            "<textarea name='targetQuery' id='targetQuery' rows='5' placeholder='".$this->lang_map["admin-sql"]["placeholder"][$_SESSION["lang"]]."'></textarea>".
            "</div>".
            "<div class='form-option-cntrl'>".
            "<input type='button' value='".$this->lang_map["admin-sql"]["btn"][$_SESSION["lang"]]."' onclick='mkQuery()'>".
            "</div>".
            "</form>".
            "</div>".
            "<div class='query-result'>".
            "<h2>".$this->lang_map["admin-sql"]["h2"][$_SESSION["lang"]].": </h2>".
            "<div class='result-info'>-</div>".
            "</div>".
            "</div>".
            "</div></div>";
    }
}