<?php
class view_admin_server extends view_admin
{

    public $sql_connection = null;
    public $list_databases = null;

    function __construct()
    {
        parent::__construct();

        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/admin/form-option.css";
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/admin/server.css";
    }

    function LoadViewLang_custom()
    {
        parent::LoadViewLang_custom();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/views/lang_view_admin_server_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_admin_server_".$_SESSION[JS_SAIK]["lang"];
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame admin'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
            "<div class='statusPanel'>".
            "<h2>".$this->lang_map->admin_server["state_txt"].":</h2><div class='lineBlock'>";
        if($this->sql_connection["connRes"] == true){
            echo "<span>".$this->lang_map->admin_server["conn_est_txt"].":</span>".
                "<span class='statusOk'>".$this->lang_map->admin_server["conn_est_stat"]."</span>";
        }else{
            echo "<span>".$this->lang_map->admin_server["conn_fail_txt"].":</span>".
                "<span class='statusFail'>".$this->lang_map->admin_server["conn_fail_stat"]."</span>".
                "<p>".$this->lang_map->admin_server["debug_txt"].": <br>".
                "<div class='result-info fail'>".$this->sql_connection["connErr"]."</div>".
                "</p>";
        }
        echo "</div>".
            "</div>".
            "<div class='settingsPanel'>".
            "<form class='form-option' enctype='multipart/form-data' method='post'>".
            "<h2>".$this->lang_map->admin_server["settings_txt"].":</h2>".
            "<p>".$this->lang_map->admin_server["settings_file"].": ".$this->sql_connection["pathToSettings"]."</p>".
            "<input type='hidden' name='saveFlag' value='y'>";
        foreach ($this->sql_connection["settings"] as $opt => $oVal) {
            echo "<div class='form-option-line'>" .
                "<label>" . $opt . ":</label>";
            if($opt == "CONN_DB"){
                echo "<input type='text' name='" . $opt . "' list='dbname' value='".$oVal."'>".
                    "<datalist id='dbname'>";
                if($this->list_databases){
                    while ($dbRow = $this->list_databases->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".$dbRow["Database"]."' ";
                        echo ">";
                    }
                }
            }elseif ($opt == "CONN_PW"){
                echo "<input type='password' name='" . $opt . "' value='" . $oVal . "'>";
            }else{
                echo "<input type='text' name='" . $opt . "' value='" . $oVal . "'>";
            }
            echo "</div>";
        }
        echo "<div class='form-option-cntrl'><input type='submit' name='saveCon' ".
            "value='".$this->lang_map->admin_server["save_btn"]."'></div>" .
            "</div>".
            "</form>".
            "</div></div></div>";
    }
}