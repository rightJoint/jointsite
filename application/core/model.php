<?php
class Model extends PDO
{
    public $lang_map = array(
        "conn_err" => array(
            "file_not_found" => array(
                "en" => "file settings conn not found",
                "rus" => "файл настроек БД не найден",
            ),
            "file_not_valid" => array(
                "en" => "file settings conn not valid",
                "rus" => "Файл настроек неправильного формата или пустой",
            ),
            "conn_problem" => array(
                "en" => "cant connect DB with settings",
                "rus" => "Нет подключения к БД с такими настройками",
            ),
        ),
    );

    public $log_message = null;

    public $sql_db_name = null;


    function __construct($sql_db_connect_json = SQL_CONN_DEFAULT)
    {
        if(file_exists($_SERVER["DOCUMENT_ROOT"].$sql_db_connect_json)){
            if($connSettings=json_decode(@file_get_contents($_SERVER["DOCUMENT_ROOT"].$sql_db_connect_json), true)){
                try {
                    parent::__construct('mysql:host='.$connSettings["CONN_LOC"].';',
                        $connSettings["CONN_USER"], $connSettings["CONN_PW"]);
                    if($this->query("use ".$connSettings["CONN_DB"])){
                        $this->sql_db_name = $connSettings["CONN_DB"];
                        return true;
                    }else {
                        $this->log_message = $this->lang_map["conn_err"]["conn_problem"][$_SESSION["lang"]];
                    }
                }catch (Exception $e) {
                    $this->log_message = $e->getMessage();
                }
            }else{
                $this->log_message = $this->lang_map["conn_err"]["file_not_valid"][$_SESSION["lang"]].": ".$this->sql_connection["pathToSettings"];
            }
        }else{
            $this->log_message = $this->lang_map["conn_err"]["file_not_found"][$_SESSION["lang"]].": ".$this->sql_connection["pathToSettings"];
        }

        $this->throwErrNoConn();
    }

    function throwErrNoConn()
    {
        throwErr("connection", $this->log_message);
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