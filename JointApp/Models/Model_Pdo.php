<?php

namespace JointApp\Models;

use JointApp\Interfaces\LangWebViewInterface;
use JointApp\JointAppRequest;
use JointFramework\Logger\JointSiteLoggerFactory;
use Psr\Log;

class Model_Pdo extends \PDO
{
    use Log\LoggerAwareTrait;

    //protected JointAppRequest $request;

    private string $context = 'Model';

    //from request
    //protected string $docRoot = '';
    protected string $langNs = 'Ru';
    public string $docRoot = 'Ru';

    public string $configDir = '';
    public string $langLw = '';
    //protected string $langRef = '';
    protected string $langSl = '';
    //protected $routes_ns = [];
    protected string $langDir = '';
    protected $routes = [];

    public $langMap = array();

    public $log_message = null;

    public $conn_db = null;                //database name connected

    public $connect_server_status = false;

    public $connect_database_status = false;

    public $throw_err_no_conn = true;

    function __construct(string $docRoot, string $configDir, $modelParams = [], string $modelLang = '', )
    {
        $this->setLogger(JointSiteLoggerFactory::getLoggerContext([$this->context => get_class($this)]));

        $this->docRoot = $docRoot;
        $this->configDir = $configDir;

        //lang params
        if(!empty($modelLang)){
            $this->langNs = ucfirst(strtolower($modelLang));
            $this->langLw = strtolower($modelLang);
            $this->langSl = '/'.strtolower($modelLang);
        }
        //default lang "ru"
        else{
            $this->langNs = 'Ru';
            $this->langLw = 'ru';
            $this->langSl = '';
        }

        $langName = $this->loadLangModel();
        $this->langMap = new $langName;

        if($this->checkAccessModel()){
            $this->modelFromParams($modelParams);
            $this->connectDb($sql_db_connect_json = $this->configDir.'/db_conn.php');
        }else{
            $this->logger->warning('check-access-model __construct return false', $this->logger->logger_context);
        }
    }

    public function checkAccessModel():bool
    {
        return true;
    }

    public function loadLangModel():string
    {
        $name = 'LangFiles_'.$this->langNs.'_Model';
        require_once $this->docRoot.'/JointApp/LangFiles/Models/'.$name.'.php';
        return $name;
    }

    public function modelFromParams($modelParams = [])
    {

    }

    private function connectDb($sql_db_connect_json): bool
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
                $this->logger->alert("Model_pdo throw err cant connect:" . $this->log_message, $this->logger->logger_context);
            }
        }
        return false;
    }

    public function getRecordStructure()
    {

    }

    function selectDatabase():bool
    {
        if ($this->query("use " . $this->conn_db)) {
            $this->connect_database_status = true;
            return true;
        } else {
            $this->log_message = $this->langMap->conn_err["conn_problem"];
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
                $this->log_message = $this->langMap->conn_err["file_not_valid"].": ".
                    "PDO object is not initialized, constructor was not called";
                $this->logger->alert("Model_pdo throw err:".$this->log_message, $this->logger->logger_context);
            }
        }else{
            $this->log_message = $this->langMap->conn_err["file_not_found"].": ".
                $sql_db_connect_json.
                "PDO object is not initialized, constructor was not called";
            $this->logger->alert("Model_pdo throw err:".$this->log_message, $this->logger->logger_context);
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
                $this->logger->info("query err: ".$this->log_message, $this->logger->logger_context);
            }
        }else{
            $this->logger->alert("Model_pdo->pdo_query throw err: no-db-connection", $this->logger->logger_context);
        }
        return false;
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


    public function fetchToArray($findList_qry):array
    {
        $return_listRecords = array();
        if($findList_res = $this->pdoQuery($findList_qry)){

            if($findList_res->rowCount()){
                $row_counter = 0;
                while ($findList_row = $findList_res->fetch(\PDO::FETCH_ASSOC)){
                    $return_listRecords[$row_counter] = $findList_row;
                    $row_counter++;
                }
            }
            return $return_listRecords;
        }

        //$this->logger->alert($this->log_message, $this->logger->logger_context);

        return $return_listRecords;
    }

}