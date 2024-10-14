<?php
namespace jointSite\Core;
class Model_pdo extends \PDO
{
    public $lang_map = array();

    public $log_message = null;

    public $conn_db = null;                //database name connected

    public $connect_server_status = false;

    public $connect_database_status = false;

    public $throw_err_no_conn = true;

    function __construct()
    {
        $lang_class = $this->loadLangModel();
        $this->lang_map = new $lang_class;
        $this->connectDb($sql_db_connect_json = JOINT_SITE_CONF_DIR . "/db_conn.php");
    }

    private function connectDb($sql_db_connect_json = JOINT_SITE_CONF_DIR . "/db_conn.php"): bool
    {
        if(getenv('DOCKER_RUN') == "Y"){
            $connSettings = $this->setUpConnectDocker();
        }else{
            $connSettings = $this->setUpConnectConfig($sql_db_connect_json);
        }

        $this->conn_db = $connSettings["CONN_DB"];
        try {
            parent::__construct('mysql:host=' . $connSettings["CONN_LOC"] . ';',
                $connSettings["CONN_USER"], $connSettings["CONN_PW"]);
            $this->connect_server_status = true;
            if($this->selectDatabase()){

                //echo $this->conn_db;
                //exit;
                //$this->query("drop database js_db");
                //exit;
                $this->getRecordStructure();
                return true;
            }
        } catch (\Exception $e) {
            $this->log_message = $e->getMessage();
            if($this->throw_err_no_conn){
                jointSite::throwErr("connection", "Model_pdo throw err cant connect:" . $this->log_message);
            }
        }
        return false;
    }

    public function getRecordStructure()
    {

    }

    function selectDatabase():bool
    {
        if ($this->pdoQuery("use " . $this->conn_db)) {
            $this->connect_database_status = true;
            return true;
        } else {
            $this->log_message = $this->lang_map->conn_err["conn_problem"];
        }
        return false;
    }

    private function setUpConnectConfig($sql_db_connect_json = JOINT_SITE_CONF_DIR."/db_conn.php"):array
    {
        $connSettings = array(
            "CONN_LOC" => "",
            "CONN_DB" => "",
            "CONN_PW" => "",
            "CONN_USER" => "",
        );
        if(file_exists($sql_db_connect_json)) {
            if ($try_connSettings = json_decode(@file_get_contents($sql_db_connect_json), true)) {
                $connSettings = $try_connSettings;
            }else{
                $this->log_message = $this->lang_map->conn_err["file_not_valid"].": ".
                    "PDO object is not initialized, constructor was not called";
                jointSite::throwErr("connection", "Model_pdo throw err:".$this->log_message);
            }
        }else{
            $this->log_message = $this->lang_map->conn_err["file_not_found"].": ".
                $sql_db_connect_json.
                "PDO object is not initialized, constructor was not called";
            jointSite::throwErr("connection", "Model_pdo throw err:".$this->log_message);
        }
        return $connSettings;
    }

    private function setUpConnectDocker():array
    {
        $password_file_path = getenv('PASSWORD_FILE_PATH');
        $db_pass = trim(file_get_contents($password_file_path));
        $connSettings = array(
            "CONN_LOC" => getenv('DB_HOST'),
            "CONN_DB" => getenv('DB_NAME'),
            "CONN_PW" => $db_pass,
            "CONN_USER" => getenv('DB_USER'),
        );
        return $connSettings;
    }

    /*
     * return PDO or false
     */
    function pdoQuery($statement, $mode = \PDO::FETCH_ASSOC, $arg3 = null, array $ctorargs = array())
    {
        if($this->connect_database_status){
            try{
                return $this->query($statement, $mode);
            }catch (\Exception $e) {
                $this->log_message = $e->getMessage();
                jointSite::throwErr("connection", "query wrong format: ".$statement);
            }
        }else{
            jointSite::throwErr("connection", "Model_pdo->pdo_query throw err: no-db-connection");
        }
        return false;
    }

    function loadLangModel():string
    {
        require_once JOINT_SITE_REQ_LANG."/Models/LangFiles_Ru_Models_Model.php";
        return "LangFiles_".JOINT_SITE_APP_LANG."_Models_Model";
    }

    public function getData()
    {

    }

    public function createGUID():string
    {
        if (function_exists('com_create_guid') === true){
            return trim(com_create_guid(), '{}');
        }
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535),
            mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535),
            mt_rand(0, 65535), mt_rand(0, 65535));
    }

}