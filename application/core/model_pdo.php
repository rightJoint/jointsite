<?php
class Model_pdo extends PDO
{
    public $lang_map = array();

    public $log_message = null;

    public $sql_db_name = null;

    function __construct($sql_db_connect_json = SQL_CONN_DEFAULT)
    {
        $lang_class = $this->load_lang_files();
        $this->lang_map = new $lang_class;

        if(file_exists($sql_db_connect_json)){
            if($connSettings=json_decode(@file_get_contents($sql_db_connect_json), true)){
                try {
                    parent::__construct('mysql:host='.$connSettings["CONN_LOC"].';',
                        $connSettings["CONN_USER"], $connSettings["CONN_PW"]);
                    if($this->query("use ".$connSettings["CONN_DB"])){
                        $this->sql_db_name = $connSettings["CONN_DB"];
                        return true;
                    }else {
                        $this->log_message = $this->lang_map->conn_err["conn_problem"];
                    }
                }catch (Exception $e) {
                    $this->log_message = $e->getMessage();
                }
            }else{
                $this->log_message = $this->lang_map->conn_err["file_not_valid"].": ".$this->sql_connection["pathToSettings"];
            }
        }else{
            $this->log_message = $this->lang_map->conn_err["file_not_found"].": ".$sql_db_connect_json;
        }

        $this->throwErrNoConn();
    }

    function load_lang_files()
    {
        require_once "application/lang_files/models/lang_model_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_model_".$_SESSION[JS_SAIK]["lang"];
    }

    function throwErrNoConn()
    {
        jointSite::throwErr("connection", $this->log_message);
    }

    public function get_data()
    {

    }

    public function createGUID()
    {
        if (function_exists('com_create_guid') === true){
            return trim(com_create_guid(), '{}');
        }
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535),
            mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535),
            mt_rand(0, 65535), mt_rand(0, 65535));
    }

}