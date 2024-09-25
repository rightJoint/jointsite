<?php
class Model_pdo extends PDO
{
    public $lang_map = array();

    public $log_message = null;

    public $sql_db_name = null;

    public $db_connect_status = false;

    function __construct($sql_db_connect_json = JOINT_SITE_CONF_DIR."/db_conn.php")
    {
        $lang_class = $this->load_lang_files();
        $this->lang_map = new $lang_class;

        if(file_exists($sql_db_connect_json)){
            if($connSettings=json_decode(@file_get_contents($sql_db_connect_json), true)){
                try {
                    parent::__construct('mysql:host='.$connSettings["CONN_LOC"].';',
                        $connSettings["CONN_USER"], $connSettings["CONN_PW"]);
                    $this->sql_db_name = $connSettings["CONN_DB"];
                    if($this->query("use ".$connSettings["CONN_DB"])){
                        $this->db_connect_status = true;
                    }else {
                        $this->log_message = $this->lang_map->conn_err["conn_problem"];
                    }
                }catch (Exception $e) {
                    $this->log_message = $e->getMessage();
                    jointSite::throwErr("connection", "Model_pdo throw err cant connect:".$this->log_message);
                }
            }else{
                $this->log_message = $this->lang_map->conn_err["file_not_valid"].": ".
                    $this->sql_connection["pathToSettings"].
                    "PDO object is not initialized, constructor was not called";
                jointSite::throwErr("connection", "Model_pdo throw err:".$this->log_message);
            }
        }else{

            $this->log_message = $this->lang_map->conn_err["file_not_found"].": ".
                $sql_db_connect_json.
                "PDO object is not initialized, constructor was not called";
            jointSite::throwErr("connection", "Model_pdo throw err:".$this->log_message);
            return false;
        }
    }

    /*
     * return PDO or false
     */
    function pdo_query($statement, $mode = PDO::FETCH_ASSOC, $arg3 = null, array $ctorargs = array())
    {
        if($this->throwErrNoConn()){
            try{
                return $this->query($statement, $mode);
            }catch (Exception $e) {
                $this->log_message = $e->getMessage();
            }
        }
        return false;
    }

    function load_lang_files():string
    {
        require_once JOINT_SITE_REQ_LANG."/models/lang_model.php";
        return "lang_model";
    }

    function throwErrNoConn():bool
    {
        if(!$this->db_connect_status){
            //return true;
            return jointSite::throwErr("connection", "Model_pdo throwErrNoConn add err: ".$this->log_message);
        }
        return true;
    }

    public function get_data()
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