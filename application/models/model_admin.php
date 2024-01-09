<?php
class Model_Admin extends Model
{
    public $tables = array(
        "tables" => null,
        "result" => array(
            "log" => null,
            "err" => null,
        ),
    );

    public $sql_connection = array(
        "settings" => array(
            "CONN_LOC" => null,
            "CONN_USER" => null,
            "CONN_PW" => "",
            "CONN_DB" => null,
        ),
        "connRes" => false,
        "connErr" => false,
        "err_no_conn" => true,
    );


    function __construct()
    {

        $this->lang_map["admin_mlm"] = array(
            "auth_err_fnv"=> array(
                "en" => "file with admin users not valid or is empty",
                "rus" => "файл с пользователями неправильного формата или пустой"
            ),
            "auth_err_fnf"=> array(
                "en" => "file with admin users list not found",
                "rus" => "файл с пользователями не найден"
            ),
            "upload_table" => array(
                "noting" => array(
                    "en" => "empty - no records",
                    "rus" => "пустая - нет записей"
                ),
                "write" => array(
                    "en" => "cant write file",
                    "rus" => "не сохраняется в файл"
                ),
                "success" => array(
                    "en" => "success",
                    "rus" => "успешно"
                ),
                "upload_all" => array(
                    "en" => "Action: upLoadAll",
                    "rus" => "Действие: выгрузить все",
                ),
                "pt" => array(
                    "en" => "prefixTag",
                    "rus" => "Приставка",
                ),
                "dt" => array(
                    "en" => "date stamp",
                    "rus" => "Дт.штамп",
                )

            )
        );

        if(file_exists($_SERVER["DOCUMENT_ROOT"].SQL_CONN_DEFAULT)) {
            if ($connSettings = json_decode(@file_get_contents($_SERVER["DOCUMENT_ROOT"] . SQL_CONN_DEFAULT), true)) {
                foreach ($this->sql_connection["settings"] as $conn_opt => $conn_val) {
                    if ($connSettings[$conn_opt]) {
                        $this->sql_connection["settings"][$conn_opt] = $connSettings[$conn_opt];
                    }
                }
            }
        }

        if(parent::__construct()){
            $this->sql_connection["connRes"] = true;
        }

        $this->sql_connection["connErr"] = $this->log_message;
    }

    function throwErrNoConn()
    {
        return false;
    }

    function save_conn_settings()
    {
        foreach($this->sql_connection["settings"] as $key =>$value){
            $this->sql_connection["settings"][$key]=$_POST[$key];
        }
        file_put_contents($_SERVER["DOCUMENT_ROOT"].SQL_CONN_DEFAULT,
            json_encode($this->sql_connection["settings"]));
    }

    function get_admin_users()
    {
        $result = array(
            "list" => null,
            "status" => false,
            "err" => null,
        );
        if(file_exists($_SERVER["DOCUMENT_ROOT"].PATH_TO_USR_LIST)) {
            if ($adminUsers = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . PATH_TO_USR_LIST), true)) {
                $result["list"] = $adminUsers;
                $result["status"] = true;
            }else{
                $result["status"] = true;
                $result["err"] = $this->lang_map["admin_mlm"]["auth_err_fnv"][$_SESSION["lang"]];
            }
        }else{
            $result["status"] = true;
            $result["err"] = $this->lang_map["admin_mlm"]["auth_err_fnf"][$_SESSION["lang"]];
        }
        return $result;
    }

    public function glob_create_tables()
    {
        $this->tables["result"]['log'] = null;
        $this->tables["result"]['err'] = false;
        foreach (glob($_SERVER["DOCUMENT_ROOT"].PATH_TO_TABLES_LIST."*".TABLE_EXT_FILE) as $filename){
            $trimTableName = substr(basename($filename),0, strlen(basename($filename))-strlen(TABLE_EXT_FILE));
            if(LOWER_CASE_TABLE_NAMES){
                $this->tables["tables"][strtolower($trimTableName)]['list']=true;
            }else{
                $this->tables["tables"][$trimTableName]['list']=true;
            }
        }
    }

    public function dbCompare($table_name = null)
    {
        $query_text = "SELECT TABLE_NAME, TABLE_ROWS FROM `information_schema`.`tables` WHERE
    `table_schema` = '".$this->sql_connection["settings"]['CONN_DB']."'";
        if($table_name){
            $query_text .= " and TABLE_NAME='".$table_name."'";
        }
        if($query_res = @$this->query($query_text)){
            while ($query_row = $query_res->fetch(PDO::FETCH_ASSOC)) {
                $trimTableName = $query_row['TABLE_NAME'];
                if(LOWER_CASE_TABLE_NAMES){
                    $trimTableName = strtolower($trimTableName);
                }
                if($this->tables["tables"][$trimTableName]["list"]){
                    $this->tables["tables"][$trimTableName]['exist'] = true;
                    $this->tables["tables"][$trimTableName]['qty'] = $query_row['TABLE_ROWS'];
                }else{
                    $this->tables["tables"][$query_row['TABLE_NAME']]["list"] = false;
                    $this->tables["tables"][$query_row['TABLE_NAME']]['exist'] = true;
                    $this->tables["tables"][$query_row['TABLE_NAME']]['qty'] = $query_row['TABLE_ROWS'];
                }
            }
        }


    }

    public function glob_load_tables()
    {
        if($this->tables["tables"]){
            foreach ($this->tables["tables"] as $tbl_name => $tbl_opt){
                foreach (glob($_SERVER['DOCUMENT_ROOT'] . PATH_TO_DB_UPLOAD . "*" . $tbl_name .
                    "*" . TABLE_EXT_FILE) as $tableToInsert) {
                    $this->tables["tables"][$tbl_name]["load"][] = basename($tableToInsert);
                }
            }
        }
    }

    public function dropTable($tableName)
    {
        return $this->query("drop table ".$tableName);
    }

    public function clearTable($tableName)
    {
        return $this->query("delete from ".$tableName);
    }

    public function createTable($tableName){
        require_once ($_SERVER["DOCUMENT_ROOT"].PATH_TO_TABLES_LIST.$tableName.TABLE_EXT_FILE);
        return $this->query("create table ".$tableName." ".$query_text);
    }

    public function downloadTable($tableName)
    {
        if($queryToInsert=@file_get_contents( $_SERVER["DOCUMENT_ROOT"].PATH_TO_DB_UPLOAD.$tableName)){
            if($stmt = $this->prepare($queryToInsert)){
                if($stmt->execute()){
                    return true;
                }
            }
        }
        return false;
    }

    public function uploadTable($tableName, $prefixTag, $dateTag, $extension = ".php"){

        $orderBy=null;

        $return=array(
            "log" => null,
            "err" => 0,
        );

        $query_text = "select * from ".$tableName." ".$orderBy;
        $query_res = $this->query($query_text);
        if ($query_res->rowCount() == 0){
            $return['log'].= $this->lang_map["admin_mlm"]["upload_table"]["noting"][$_SESSION["lang"]]."<br>";
        }else
        {
            $queryToInsert = null;
            $queryToInsert_temp = "(";
            $queryToInsert .= "insert into ".$tableName." (\r";
            $query_row = $query_res->fetch(PDO::FETCH_ASSOC);
            foreach ($query_row as $key => $value) {
                if ($value == null) {
                    $queryToInsert_temp .= "null, ";
                } else {
                    $queryToInsert_temp .= "'" . $value . "', ";
                }
                $queryToInsert .= $key . ", ";
            }
            $queryToInsert = substr($queryToInsert, 0, strlen($queryToInsert) - 2) . ")\r values \r";
            $queryToInsert_temp = substr($queryToInsert_temp, 0, strlen($queryToInsert_temp) - 2) . "), \r";
            $queryToInsert .= $queryToInsert_temp;
            while ($query_row = $query_res->fetch(PDO::FETCH_ASSOC)) {
                $queryToInsert .= "(";
                foreach ($query_row as $key => $value) {
                    if ($value == null) {
                        $queryToInsert .= "null, ";
                    } else {
                        $queryToInsert .= "'" . $value  . "', ";
                    }
                }
                $queryToInsert = substr($queryToInsert, 0, strlen($queryToInsert) - 2) . "), \r";
            }
            $queryToInsert = substr($queryToInsert, 0, strlen($queryToInsert) - 3);
            if($prefixTag){
                $file = htmlspecialchars($prefixTag)."-".$tableName;
            }else{
                $file = $tableName;
            }
            if($dateTag=='true'){
                $file .="_".date( 'Ymd_His');
            }
            $file.=$extension;
            if(!file_put_contents($_SERVER["DOCUMENT_ROOT"]."/".PATH_TO_DB_UPLOAD.$file, $queryToInsert)){
                $return['err'].= $tableName."--> ".$this->lang_map["admin_mlm"]["upload_table"]["write"][$_SESSION["lang"]];
            }else{
                $return['log'].= $tableName."--> ".$this->lang_map["admin_mlm"]["upload_table"]["success"][$_SESSION["lang"]]."<br>";
            }
        }
        return $return;
    }

    public function uploadAllTables()
    {
        $return = array(
            "log" => null,
            "err" => false,
        );
        $return['log'].=$this->lang_map["admin_mlm"]["upload_table"]["upload_all"][$_SESSION["lang"]]."<br>";
        $orderBy=null;
        $return['log'].=$this->lang_map["admin_mlm"]["upload_table"]["pt"][$_SESSION["lang"]]."=".$_GET['prefixTag']."<br>".
            $this->lang_map["admin_mlm"]["upload_table"]["dt"][$_SESSION["lang"]]."=".$_GET["dateTag"]."<br>";
        foreach ($this->tables["tables"] as $table => $value) {
            if ($this->tables["tables"][$table]['exist'] === true) {
                $query_text = "select * from " . $table . " " . $orderBy;
                $query_res = $this->query($query_text);
                if ($query_res->rowCount() == 0) {
                    $return['log'].= $table . "-->> ".$this->lang_map["admin_mlm"]["upload_table"]["noting"][$_SESSION["lang"]]."<br>";
                } else {

                    $result = $this->uploadTable($table, $_GET['prefixTag'], $_GET["dateTag"], TABLE_EXT_FILE);
                    $return['log'].=$result["log"];
                }
            }
        }
        return $return;
    }

    function checkAdminPassword($user_password)
    {
        if (preg_match('/^[a-z]{1}[0-9a-z-._]{2,15}$/imsiu', $user_password) == 0){
            return false;
        }else{
            return true;
        }
    }

    function checkAdminLogin($user_login)
    {
        if (preg_match('/^[a-z]{1}[0-9a-z-._]{2,15}$/imsiu', $user_login) == 0){
            return false;
        }
        return true;

    }
}