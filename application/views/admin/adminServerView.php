<?php
class AdminServerView extends AdminView
{

    public $sql_connection = null;
    public $list_databases = null;

    function __construct()
    {
        $this->lang_map["admin-server"] = array(
            "state_txt" => array(
                "en" => "State",
                "rus" => "Состояние",
            ),
            "conn_est_txt" => array(
                "en" => "Connection to SQL - database",
                "rus" => "Подключение к SQL базе данных"
            ),
            "conn_est_stat" => array(
                "en" => "Established",
                "rus" => "Установлено"
            ),
            "conn_fail_txt" => array(
                "en" => "Problem to connect SQL - database",
                "rus" => "Проблема с подключением к SQL базе данных"
            ),
            "conn_fail_stat" => array(
                "en" => "FAIL",
                "rus" => "НЕУДАЧНО"
            ),
            "debug_txt" => array(
                "en" => "debug info",
                "rus" => "отладочная информация"
            ),
            "settings_txt" => array(
                "en" => "Settings",
                "rus" => "Настройки"
            ),
            "settings_file" => array(
                "en" => "use settings file",
                "rus" => "используемый файл настроек"
            ),
            "save_btn" => array(
                "en" => "Save",
                "rus" => "Сохранить"
            ),

        );

        $this->styles[] = "/css/admin/form-option.css";
        $this->styles[] = "/css/admin/server.css";

        parent::__construct();
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame admin'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
            "<div class='statusPanel'>".
            "<h2>".$this->lang_map["admin-server"]["state_txt"][$_SESSION["lang"]].":</h2><div class='lineBlock'>";
        if($this->is_db_conn == true){
            echo "<span>".$this->lang_map["admin-server"]["conn_est_txt"][$_SESSION["lang"]].":</span>".
                "<span class='statusOk'>".$this->lang_map["admin-server"]["conn_est_stat"][$_SESSION["lang"]]."</span>";
        }else{
            echo "<span>".$this->lang_map["admin-server"]["conn_fail_txt"][$_SESSION["lang"]].":</span>".
                "<span class='statusFail'>".$this->lang_map["admin-server"]["conn_fail_stat"][$_SESSION["lang"]]."</span>".
                "<p>".$this->lang_map["admin-server"]["debug_txt"][$_SESSION["lang"]].": <br>".
                "<div class='result-info fail'>".$this->sql_connection["connErr"]."</div>".
                "</p>";
        }
        echo "</div>".
            "</div>".
            "<div class='settingsPanel'>".
            "<form class='form-option' enctype='multipart/form-data' action='/admin/server' method='post'>".
            "<h2>".$this->lang_map["admin-server"]["settings_txt"][$_SESSION["lang"]].":</h2>".
            "<p>".$this->lang_map["admin-server"]["settings_file"][$_SESSION["lang"]].": ".$this->sql_connection["pathToSettings"]."</p>".
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
            }else{
                echo "<input type='text' name='" . $opt . "' value='" . $oVal . "'>";
            }
            echo "</div>";
        }
        echo "<div class='form-option-cntrl'><input type='submit' name='saveCon' ".
            "value='".$this->lang_map["admin-server"]["save_btn"][$_SESSION["lang"]]."'></div>" .
            "</div>".
            "</form>".
            "</div></div></div>";
    }
}