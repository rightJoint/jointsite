<?php

namespace JointApp\Models\Records;

use JointApp\Interfaces\RecordsModelInterface;
use JointApp\JointAppQueryBuilder;
use JointApp\Models\Model_Pdo;

class RecordsModel extends Model_Pdo implements RecordsModelInterface
{

    //modelFromParams
    public string $tableName = '';

    public $record = [];

    //modelFromBody, modelFromQuery
    public $reqParams = [];

    public function loadLangModel():string
    {
        parent::loadLangModel();
        $name = 'LangFiles_'.$this->langNs.'_RecordModel';
        require_once $this->docRoot.'/JointApp/LangFiles/Models/'.$name.'.php';
        return $name;
    }

    public function modelFromParams($modelParams = [])
    {
        if(isset($modelParams['tableName']) and !empty($modelParams['tableName'])
            and empty($this->tableName)){
            $this->tableName = $modelParams['tableName'];
        }
    }

    public function modelFromBody($bodyParams = [])
    {
        $this->reqParams = $bodyParams;
    }

    public function modelFromQuery($queryParams = [])
    {
        $this->reqParams = $queryParams;
    }

    public function getRecordStructure()
    {
        if(!$this->tableName){
            $this->logger->emergency($this->langMap->table_name_rm_err, $this->logger->logger_context);
            return false;
        }

        $replaceUrl = null;
        $replaceArr = null;
        $count_keys = 0;

        if($datatype_res  = $this->pdoQuery("SELECT * from INFORMATION_SCHEMA.COLUMNS ".
            "where table_schema = '". $this->conn_db."' and table_name = '".$this->tableName."'")){
            if($datatype_res->rowCount()){
                while ($datatype_row = $datatype_res->fetch(\PDO::FETCH_ASSOC)){

                    if(!$datatype_row["COLUMN_KEY"]){

                    }elseif($datatype_row["COLUMN_KEY"] == "PRI"){
                        $count_keys++;
                        $this->record[$datatype_row["COLUMN_NAME"]]["pri"] = 1;
                        $replaceUrl.=$datatype_row["COLUMN_NAME"]."=".$datatype_row["COLUMN_NAME"]."&";
                        $replaceArr[] = $datatype_row["COLUMN_NAME"];
                        if($datatype_row["EXTRA"] == "auto_increment"){
                            $this->record[$datatype_row["COLUMN_NAME"]]["auto_increment"] = true;
                        }
                    }else{
                        $this->logger->emergency("unknown key type in model->getRecordStructure",
                            $this->logger->logger_comtext);
                    }
                    $this->record[$datatype_row["COLUMN_NAME"]]["format"] = $datatype_row["DATA_TYPE"];
                    $this->record[$datatype_row["COLUMN_NAME"]]["custom"] = false;
                }
            }else{
                $this->logger->alert('table name "'.$this->tableName.'" not found in database "'.$this->conn_db."'", $this->logger->logger_context);
                return false;
            }
        }else{
            $this->logger->alert("RecordsModel throw err: ".$this->langMap->table_name_not_found.": db_name '".$this->sql_db_name."'".
                " table_name='".$this->tableName."'", $this->logger->logger_context);
            return false;
        }

        return true;
    }

    public function countRecords(JointAppQueryBuilder $qBuilder):int
    {
        $qBuilder
            ->select('COUNT(*) as cnt')
            ->from($this->tableName);

        if($res = $this->pdoQuery($qBuilder->buildQuery())){
            return $res->fetch(\PDO::FETCH_ASSOC)["cnt"];
        }

        return 0;
    }

    public function listRecords(JointAppQueryBuilder $qBuilder):array
    {
        foreach ($this->record as $fieldName => $fieldOptions){
            if(!$fieldOptions['custom']){
                $qBuilder->select .= $fieldName.", ";
            }
        }
        $qBuilder->select = substr($qBuilder->select, 0, strlen($qBuilder->select)-2);
        $qBuilder
            ->from($this->tableName);

        return $this->fetchToArray($qBuilder->buildQuery());
    }

    public function copyRecord():bool
    {
        $date_stamp = date("H:i:s");
        $query_text="select * from ".$this->tableName." where ";
        foreach ($this->record as $fieldName=>$fieldInfo) {
            if (isset($fieldInfo["pri"]) and $fieldInfo["pri"] == 1) {
                $query_text.=$fieldName."='".$fieldInfo["curVal"]."' and " ;
            }
        }
        $query_text = substr($query_text, 0, strlen($query_text)-4);
        if($query_res = $this->pdoQuery($query_text)){
            if($query_res->rowCount()==1){
                $result=$query_res->fetch(\PDO::FETCH_ASSOC);
                foreach ($this->record as $fieldName=>$fieldInfo) {
                    if(isset($result[$fieldName])){
                        $this->record[$fieldName]["curVal"] = $result[$fieldName];
                        $this->record[$fieldName]["fetchVal"] = $result[$fieldName];
                    }else{
                        $this->record[$fieldName]["curVal"] = null;
                        $this->record[$fieldName]["fetchVal"] = null;
                    }
                }
                return $this->copyCustomFields();
            }
        }
        $this->log_message = $this->langMap->copyRecord["fail"]." ".$date_stamp;
        return false;
    }

    function copyCustomFields():bool
    {
        return true;
    }

    function insertRecord():bool
    {
        $date_stamp = date("H:i:s");
        $queryToInsert = null;
        $queryToInsert_temp = "(";
        $queryToInsert .= "insert into ".$this->tableName." (\r";
        foreach ($this->record as $fieldName=>$fieldInfo) {

            if(isset($this->files[$fieldName]))
            {
                if($this->uploadRecordFile($fieldName, false, true)){
                    $fieldInfo["curVal"] = $this->record[$fieldName]["curVal"];
                }
            }

            if(!$fieldInfo['custom']){
                if(isset($fieldInfo["pri"]) and $fieldInfo["pri"] == true) {
                    if (!isset($fieldInfo["auto_increment"])) {
                        if (!isset($this->record[$fieldName]["curVal"]) or
                            $this->record[$fieldName]["curVal"] == null) {
                            $fieldInfo["curVal"] = $this->createGUID();
                            $this->record[$fieldName]["curVal"] = $fieldInfo["curVal"];
                        }
                    }
                }

                if (!isset($fieldInfo["curVal"]) or $fieldInfo["curVal"] == "") {
                    $queryToInsert_temp .= "null, ";
                } else {
                    $queryToInsert_temp .= "'" . $fieldInfo["curVal"]. "', ";
                }
                $queryToInsert .= $fieldName . ", ";
            }
        }
        $queryToInsert = substr($queryToInsert, 0, strlen($queryToInsert) - 2) . ")\r values \r";
        $queryToInsert_temp = substr($queryToInsert_temp, 0, strlen($queryToInsert_temp) - 2) . ")";
        $queryToInsert .= $queryToInsert_temp;


        if($this->pdoQuery($queryToInsert)){

            foreach ($this->record as $fieldName=>$fieldInfo) {
                if (isset($fieldInfo["pri"]) and $fieldInfo["pri"] == true) {
                    if(isset($fieldInfo["auto_increment"]) and $fieldInfo["auto_increment"] == true){
                        $this->record[$fieldName]["curVal"]=$this->lastInsertId($fieldName);
                    }
                }
            }
            $this->log_message = $this->langMap->insertRecord["success"].$date_stamp;
            return $this->insertCustomFields();
        }

        $this->log_message = $this->langMap->insertRecord["fail"].$date_stamp." cause: ".$this->log_message;
        return false;
    }

    function insertCustomFields()
    {
        return true;
    }

    public function updateRecord():bool
    {

        $date_stamp = date("H:i:s");
        $query_text="update ".$this->tableName." set ";
        $q_where = " where ";
        $q_fields = "";
        foreach ($this->record as $fieldName=>$fieldInfo) {
            if(!$fieldInfo['custom']){
                if(isset($this->files[$fieldName])){
                    if($this->uploadRecordFile($fieldName, false, true)){
                        $fieldInfo["curVal"] = $this->record[$fieldName]["curVal"];
                    }
                }

                if(!isset($fieldInfo["use_table_name"]) or
                    ($fieldInfo["use_table_name"] == $this->tableName)) {
                    if (isset($fieldInfo["pri"]) and $fieldInfo["pri"] == 1) {
                        $q_where .= $fieldName . "='";
                        if (isset($fieldInfo["fetchVal"])) {
                            $q_where .= $fieldInfo["fetchVal"];
                        } else {
                            $q_where .= $fieldInfo["curVal"];
                        }
                        $q_where .= "' and ";
                    }

                    if ($fieldInfo["fetchVal"] != $fieldInfo["curVal"]) {
                        if(!isset($this->editFields[$fieldName]["readonly"])){
                            $q_fields .= $fieldName . "=";
                            if ($fieldInfo["curVal"] == null) {
                                $q_fields .= "null, ";
                            } else {
                                $q_fields .= "'" . $fieldInfo["curVal"] . "', ";
                            }
                        }
                    }
                }
            }
        }

        $q_where = substr($q_where, 0, strlen($q_where)-4);
        if(strlen($q_fields) > 2){
            $q_fields = substr($q_fields, 0, strlen($q_fields)-2);
            if($this->pdoQuery($query_text.$q_fields.$q_where)){
                $this->log_message .= $this->langMap->updateRecord["success"].": ".$date_stamp;
                return $this->updateCustomFields();
            }else{
                $this->log_message .= $this->langMap->updateRecord["fail"].": ".$date_stamp;
                return false;
            }
        }else{
            $this->log_message .= $this->langMap->updateRecord["nothing"].": ".$date_stamp;
            return $this->updateCustomFields();
        }
    }

    function updateCustomFields():bool
    {
        return true;
    }

    function deleteRecord(){

        foreach ($this->record as $fieldName => $fieldOptions){
            if($fieldOptions["format"] == "file" and $fieldOptions["file_options"]["load_dir"]){
                $this->deleteRecordFetchFile($fieldName);
            }
        }

        $date_stamp = date("H:i:s");
        $q_where = null;
        foreach ($this->record as $fieldName=>$fieldInfo) {
            if (isset($fieldInfo["pri"]) and $fieldInfo["pri"] == true) {
                $q_where.=$fieldName."='".$fieldInfo["curVal"]."' and ";
            }
        }
        $q_where = substr($q_where, 0, strlen($q_where)-4);

        if($this->query("delete from ".$this->tableName." where ".$q_where)){
            $this->log_message = "deleteRecord success: ".$date_stamp;
            return true;
        }

        $this->log_message = "deleteRecord fail: ".$date_stamp;
        return false;
    }

    function uploadRecordFile(string $fieldName, $originName = false, $del_fetch_file = true){
        $file = $this->files[$fieldName];
        if($file->getError() == 0){
            $path_parts = pathinfo($file->getClientFilename());
            $file_extension = $path_parts["extension"];
            if(strpos(" ".$this->record[$fieldName]["file_options"]["accept"], $file_extension)){
                if($del_fetch_file){
                    $this->deleteRecordFetchFile($fieldName);
                }
                if($originName){
                    $file_name = $path_parts["filename"].".".$file_extension;
                }else{
                    $file_name = $this->createGUID().'.'.$file_extension;
                }

                $this->record[$fieldName]["curVal"] = $file_name;
                $imgLink = $this->linkFromReplaces($fieldName);
                $upload_dir = null;

                $f_expd = explode("/", $imgLink);
                for($i = 0; $i < count($f_expd)-1; $i++){
                    $upload_dir.= $f_expd[$i]."/";
                }

                if(!is_dir($this->docRoot.$upload_dir)){
                    mkdir($this->docRoot.$upload_dir, 0777, true);
                }
                $file->moveTo($this->docRoot.$imgLink);
                return true;
            }else{
                $this->log_message .= $this->langMap->file_err["mvf_err_extension"].": ".$file_extension."; ";
                return false;
            }
        }else{

            if($file->getError() == 4){
                if(isset($this->record[$fieldName]["fetchVal"]) and
                    $this->record[$fieldName]["fetchVal"]!= null){
                    $this->record[$fieldName]["curVal"] = $this->record[$fieldName]["fetchVal"];
                }
                return true;
            }else{
                return false;
            }
        }
    }

    function deleteRecordFetchFile($field_name)
    {
        if(isset($this->record[$field_name]["fetchVal"])){

            $fileLink = $this->linkFromReplaces($field_name, "fetchVal");
            $upload_dir = null;
            $f_expd = explode("/", $fileLink);
            for($i = 0; $i < count($f_expd)-1; $i++){
                $upload_dir.= $f_expd[$i]."/";
            }
            if(@unlink($this->docRoot.$fileLink)){
                return true;
            }else{
                $this->log_message .= $this->langMap->file_err["unlink_err"];
                return false;
            }
        }
    }

    function linkFromReplaces($fieldName, $state_val = 'curVal'):string
    {
        $file_link = '';
        if($this->record[$fieldName]['file_options']['load_dir'] and $this->record[$fieldName][$state_val]){
            if(isset($this->record[$fieldName]['file_options']['replaces'])){
                $file_link = $this->record[$fieldName]['file_options']['load_dir'];
                foreach ($this->record[$fieldName]['file_options']['replaces'] as $replace){
                    $file_link = str_replace($replace, $this->record[$replace][$state_val], $file_link);
                }
            }else{
                $file_link = $this->record[$fieldName]['file_options']['load_dir']."/".
                    $this->record[$fieldName][$state_val];
            }

        }else{
            //echo "nnn";
        }
        return $file_link;
    }
}