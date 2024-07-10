<?php
class view_admin_sql extends view_admin
{
    function __construct()
    {
        parent::__construct();

        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/admin/form-option.css";
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/admin/sql.css";

        $this->scripts[] = JOINT_SITE_EXEC_DIR."/js/admin/sql.js";

    }

    function LoadViewLang_custom()
    {
        parent::LoadViewLang_custom();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/views/lang_view_admin_sql_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_admin_sql_".$_SESSION[JS_SAIK]["lang"];
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame admin'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<div class='query-block'>".
            "<form class='form-option'>".
            "<div class='form-option-line'>".
            "<label for='targetQuery'>".$this->lang_map->admin_sql["label"].":</label><label></label>".
            "</div>".
            "<div class='form-option-line'>".
            "<textarea name='targetQuery' id='targetQuery' rows='5' placeholder='".$this->lang_map->admin_sql["placeholder"]."'></textarea>".
            "</div>".
            "<div class='form-option-cntrl'>".
            "<input type='button' value='".$this->lang_map->admin_sql["btn"]."' onclick='mkQuery()'>".
            "</div>".
            "</form>".
            "</div>".
            "<div class='query-result'>".
            "<h2>".$this->lang_map->admin_sql["h2"].": </h2>".
            "<div class='result-info'>-</div>".
            "</div>".
            "</div>".
            "</div></div>";
    }
}