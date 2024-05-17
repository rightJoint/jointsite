<?php
class Model_Admin extends Model_pdo
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


    function __construct($sql_db_connect_json = SQL_CONN_DEFAULT)
    {

        if(file_exists($sql_db_connect_json)){
            if($connSettings=json_decode(@file_get_contents($sql_db_connect_json), true)){
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
    function load_lang_files()
    {
        parent::load_lang_files(); // TODO: Change the autogenerated stub
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/models/lang_model_admin_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_model_admin_".$_SESSION[JS_SAIK]["lang"];
    }

    function throwErrNoConn()
    {
        return true;
    }

    function save_conn_settings()
    {
        foreach($this->sql_connection["settings"] as $key =>$value){
            $this->sql_connection["settings"][$key]=$_POST[$key];
        }
        file_put_contents(SQL_CONN_DEFAULT,
            json_encode($this->sql_connection["settings"]));
    }

    function get_admin_users()
    {
        if(file_exists(PATH_TO_USR_LIST)) {
            if ($adminUsers = json_decode(file_get_contents(PATH_TO_USR_LIST), true)) {
                return $adminUsers;
            }else{
                jointSite::throwErr("access", $this->lang_map->admin_mlm["auth_err_fnv"]);
            }
        }else{
            jointSite::throwErr("access", $this->lang_map->admin_mlm["auth_err_fnf"]);
        }
    }

    public function glob_create_tables($table_name = null)
    {
        $this->tables["result"]['log'] = null;
        $this->tables["result"]['err'] = false;
        foreach (glob(PATH_TO_TABLES_LIST."/".$table_name."*".TABLE_EXT_FILE) as $filename){
            $tableName = substr(basename($filename),0, strlen(basename($filename))-strlen(TABLE_EXT_FILE));
            if(LOWER_CASE_TABLE_NAMES){
                $this->tables["tables"][strtolower($tableName)]['list']=true;
                $this->tables["tables"][strtolower($tableName)]['glob_name']=$tableName;
            }else{
                $this->tables["tables"][$tableName]['list']=true;
                $this->tables["tables"][$tableName]["glob_name"] = $tableName;
            }
        }
    }

    public function get_tables_from_db($table_name = null)
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
                if(!$this->tables["tables"][$trimTableName]["list"]){
                    $this->tables["tables"][$trimTableName]["glob_name"] = $trimTableName;
                }
                $this->tables["tables"][$trimTableName]['exist'] = true;
                $this->tables["tables"][$trimTableName]['qty'] = $query_row['TABLE_ROWS'];
            }
        }
    }

    public function glob_load_tables()
    {
        if($this->tables["tables"]){
            foreach ($this->tables["tables"] as $tbl_name => $tbl_opt){
                foreach (glob( PATH_TO_DB_UPLOAD . "/*" . $tbl_opt["glob_name"] .
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
        require_once (PATH_TO_TABLES_LIST."/".$tableName.TABLE_EXT_FILE);
        return $this->query("create table ".$tableName." ".$query_text);
    }

    public function downloadTable($tableName)
    {
        if($queryToInsert=@file_get_contents( PATH_TO_DB_UPLOAD."/".$tableName)){
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
            $return['log'].= $this->lang_map->admin_mlm["upload_table"]["noting"]."<br>";
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



            if(!is_dir(PATH_TO_DB_UPLOAD)){
                mkdir(PATH_TO_DB_UPLOAD, 0777, true);
            }
            if(!file_put_contents(PATH_TO_DB_UPLOAD."/".$file, $queryToInsert)){
                $return['err'].= $tableName."--> ".$this->lang_map->admin_mlm["upload_table"]["write"];
            }else{
                $return['log'].= $tableName."--> ".$this->lang_map->admin_mlm["upload_table"]["success"]."<br>";
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
        $return['log'].=$this->lang_map->admin_mlm["upload_table"]["upload_all"]."<br>";
        $orderBy=null;
        $return['log'].=$this->lang_map->admin_mlm["upload_table"]["pt"]."=".$_GET['prefixTag']."<br>".
            $this->lang_map->admin_mlm["upload_table"]["dt"]."=".$_GET["dateTag"]."<br>";
        foreach ($this->tables["tables"] as $table => $value) {
            if ($this->tables["tables"][$table]['exist'] === true) {
                $query_text = "select * from " . $table . " " . $orderBy;
                $query_res = $this->query($query_text);
                if ($query_res->rowCount() == 0) {
                    $return['log'].= $table . "-->> ".$this->lang_map->admin_mlm["upload_table"]["noting"]."<br>";
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

    function glob_migration_files()
    {
        foreach (glob($_SERVER['DOCUMENT_ROOT'] . PATH_TO_MIGRATIONS . "/*". TABLE_EXT_FILE) as $mirgation_file) {
            $trimTableName = substr(basename($mirgation_file),0, strlen(basename($mirgation_file))-strlen(TABLE_EXT_FILE));
            //echo $trimTableName."<br>";
            $this->migrations["list"][basename($trimTableName)] = array();
        }
    }

    function exec_migration($migr_file)
    {
        $return=array(
            "log" => null,
            "err" => 0,
        );

        $commands = $this->parse_sql_file($_SERVER["DOCUMENT_ROOT"]."/migrations/".$migr_file);
        $return["log"].= "Exec file ".$migr_file."<br>";
        $commands_count = count($commands);
        if($commands_count){
            $return["log"].="count(".$commands_count.")<br>";
            $count_q = 0;
            $count_suss = 0;
            $count_fail = 0;
            foreach ($commands as $q_num => $q_info){
                $return["log"].= "exec No: ".$q_num."<br>";
                $return["log"].= "<p style='font-size: 16px'>".$q_info["query"]."</p>";
                if($this->query($q_info["query"])){
                    $count_suss++;
                    $return["log"].= $q_info["type"]."--->SUSSES<br>";

                }else{
                    $return["err"] = true;
                    $count_fail++;
                    $return["log"].= "--->FAIL<br>";
                }
                $count_q++;
            }

            if($return["err"]){
                $return["err"] = "cant exec all migrations";
            }
            $return["log"].= "Results: total(".$count_q."), susses(".$count_suss."), fail(".$count_fail.")";

        }else{
            $return["err"] = "no queries in ".$migr_file;
            $return["log"] = "no queries in ".$migr_file;

        }

        return $return;

    }

    function parse_sql_file($file_name)
    {
        $acceptable_queries = array(
            "insert ",
            "update ",
            "delete ",
            "replace ",
            "create table ",
        );

        $commands = file_get_contents($file_name);

        $cmd_lines = explode(";",$commands);

        $new_cmd_lines = array();

        $lines_cnt = count($cmd_lines);
        $lines_counter = 0;
        foreach ($cmd_lines as $cmd_line){

            $lines_counter++;
            $glue_flag= true;
            foreach ($acceptable_queries as $q_type){
                if(strpos("-".$cmd_line, $q_type)){
                    $new_cmd_lines[$lines_counter]["type"] = $q_type;
                    $glue_flag = false;
                    break;
                }
            }
            $new_lines_cnt = count($new_cmd_lines);
            if($glue_flag){
                if($new_lines_cnt){
                    if($lines_counter < $lines_cnt){
                        $new_cmd_lines[$new_lines_cnt-1]["query"] .= ";".$cmd_line;
                    }
                }
            }else {
                $new_cmd_lines[$new_lines_cnt]["query"] = $cmd_line;
                if ($lines_counter < $lines_cnt) {
                    $new_cmd_lines[$new_lines_cnt]["query"] .= ";";
                }
            }
        }

        return $new_cmd_lines;
    }
}