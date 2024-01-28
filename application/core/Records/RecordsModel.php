<?php
class RecordsModel extends Model
{

    public $tableName = null;
    public $modelAliases = array(
        "en" => null,
        "rus" => null,
    );
    public $record = null;

    public $editFields = null;
    public $listFields = null;
    public $searchFields = null;
    public $viewFields = null;

    public $allow_edit_indexes = true;

    function __construct()
    {
        $this->lang_map["updateRecord"] = array(
            "success" => array(
                "en" => "updateRecord query success",
                "rus" => "Обновление записи успешно",
            ),
            "fail" => array(
                "en" => "updateRecord query fail",
                "rus" => "Обновление записи неудачно",
            ),
            "nothing" => array(
                "en" => "nothing changed",
                "rus" => "Ничего не менялось",
            ),
        );
        $this->lang_map["insertRecord"] = array(
            "success" => array(
                "en" => "insertRecord success",
                "rus" => "Добавление записи успешно",
            ),
            "fail" => array(
                "en" => "insertRecord fail",
                "rus" => "Добавление записи неудачно",
            ),
        );

        parent::__construct();
    }

    function tableName_exist()
    {
        if($this->query("show tables like '".$this->tableName."'")->fetch()){
            return true;
        }else{
            return false;
        }
    }

    public function getRecordStructure(){
        $replaceUrl = null;
        $replaceArr = null;
        $count_keys = 0;

        $datatype_res  = $this->query("SELECT * from INFORMATION_SCHEMA.COLUMNS ".
            "where table_schema = '". $this->sql_db_name."' and table_name = '".$this->tableName."'");
        if($datatype_res->rowCount()){
            while ($datatype_row = $datatype_res->fetch(PDO::FETCH_ASSOC)){

                if(!$datatype_row["COLUMN_KEY"]){

                }elseif($datatype_row["COLUMN_KEY"] == "PRI"){
                    $count_keys++;
                    $this->record[$datatype_row["COLUMN_NAME"]]["indexes"] = 1;

                    $this->searchFields[$datatype_row["COLUMN_NAME"]]["indexes"] = 1;
                    $this->editFields[$datatype_row["COLUMN_NAME"]]["indexes"] = 1;

                    $this->viewFields[$datatype_row["COLUMN_NAME"]]["indexes"] = 1;
                    $replaceUrl.=$datatype_row["COLUMN_NAME"]."=".$datatype_row["COLUMN_NAME"]."&";
                    $replaceArr[] = $datatype_row["COLUMN_NAME"];
                    $this->listFields["btnDetail"]["replaces"][] = $datatype_row["COLUMN_NAME"];
                    $this->listFields["btnEdit"]["replaces"][] = $datatype_row["COLUMN_NAME"];
                    $this->listFields["btnDelete"]["replaces"][] = $datatype_row["COLUMN_NAME"];
                    if(!$this->allow_edit_indexes){
                        $this->editFields[$datatype_row["COLUMN_NAME"]]["readonly"] = true;
                    }elseif($datatype_row["EXTRA"] == "auto_increment"){
                        $this->editFields[$datatype_row["COLUMN_NAME"]]["readonly"] = true;
                        $this->editFields[$datatype_row["COLUMN_NAME"]]["readonly"] = true;
                        $this->record[$datatype_row["COLUMN_NAME"]]["auto_increment"] = true;
                    }
                }else{
                    throwErr("XXX", "unknown key type in model->getRecordStructure");
                }

                $this->editFields[$datatype_row["COLUMN_NAME"]]["format"] = $datatype_row["DATA_TYPE"];

                if($datatype_row["DATA_TYPE"] == "text"){
                    $searchDataType = "varchar";
                }else{
                    $searchDataType = $datatype_row["DATA_TYPE"];
                }
                $this->searchFields[$datatype_row["COLUMN_NAME"]]["format"] = $searchDataType;
                $this->searchFields[$datatype_row["COLUMN_NAME"]]["sort"] = true;
                $this->searchFields[$datatype_row["COLUMN_NAME"]]["search"] = true;
                $this->listFields[$datatype_row["COLUMN_NAME"]]["format"] = $datatype_row["DATA_TYPE"];
                $this->listFields[$datatype_row["COLUMN_NAME"]]["maxLength"] = 20;
                $this->viewFields[$datatype_row["COLUMN_NAME"]]["format"] = $datatype_row["DATA_TYPE"];
                $this->viewFields[$datatype_row["COLUMN_NAME"]]["readonly"] = true;
                $this->record[$datatype_row["COLUMN_NAME"]]["format"] = $datatype_row["DATA_TYPE"];
            }
        }else{
            throwErr("request", "table ".$this->tableName." not exist, model->getRecordStructure");
        }
        if($count_keys){
            $this->listFields["btnDetail"]["format"] = "link";
            $this->listFields["btnEdit"]["format"] = "link";
            $this->listFields["btnDelete"]["format"] = "link";

            $replaceUrl=substr($replaceUrl, 0, strlen($replaceUrl)-1);
            $this->listFields["btnDetail"]["url"] = $replaceUrl;
            $this->listFields["btnEdit"]["url"] = $replaceUrl;
            $this->listFields["btnDelete"]["url"] = $replaceUrl;
        }
    }

    public function countRecords($where = null)
    {
        return $this->query("SELECT COUNT(*) as cnt from ".$this->tableName." ".$where)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }

    public function listRecords($where = null, $order = null, $limit = null)
    {
        $findList_qry = "select ";
        foreach ($this->listFields as $fieldName => $fieldOptions){
            if(!in_array($fieldName, array("btnEdit", "btnDelete", "btnDetail"))){
                $findList_qry .= $fieldName.", ";
            }
        }
        $findList_qry = substr($findList_qry, 0, strlen($findList_qry)-2);
        $findList_qry.= " from ".$this->tableName." ".$where.$order.$limit;


        return $this->fetchToArray($findList_qry);
    }

    public function fetchToArray($findList_qry)
    {
        $findList_res = $this->query($findList_qry);

        $return_listRecords = null;
        if($findList_res->rowCount()){
            $row_counter = 0;
            while ($findList_row = $findList_res->fetch(PDO::FETCH_ASSOC)){
                $return_listRecords[$row_counter] = $findList_row;
                $row_counter++;
            }
        }

        return $return_listRecords;
    }

    public function copyRecord(){
        $query_text="select * from ".$this->tableName." where ";
        foreach ($this->record as $fieldName=>$fieldInfo) {
            if ($fieldInfo["indexes"]) {
                $query_text.=$fieldName."='".$fieldInfo["curVal"]."' and " ;
            }
        }
        $query_text = substr($query_text, 0, strlen($query_text)-4);
        $query_res = $this->query($query_text);
        if($query_res->rowCount()==1){
            $result=$query_res->fetch(PDO::FETCH_ASSOC);
            foreach ($this->record as $fieldName=>$fieldInfo) {
                $this->record[$fieldName]["curVal"] = $result[$fieldName];
                $this->record[$fieldName]["fetchVal"] = $result[$fieldName];
            }
            return true;
        }

        $this->log_message = "copyRecord fail";
        return false;
    }

    function insertRecord(){
        $date_stamp = date("H:i:s");
        $queryToInsert = null;
        $queryToInsert_temp = "(";
        $queryToInsert .= "insert into ".$this->tableName." (\r";
        foreach ($this->record as $fieldName=>$fieldInfo) {
            if(!$fieldInfo["use_table_name"] or
                ($fieldInfo["use_table_name"] == $this->tableName)
            ){
                if($fieldInfo["indexes"]) {
                    if (!$fieldInfo["auto_increment"]) {
                        if (!$this->record[$fieldName]["curVal"]) {
                            $fieldInfo["curVal"] = $this->createGUID();
                            $this->record[$fieldName]["curVal"] = $fieldInfo["curVal"];
                        }
                    }
                }

                if ($fieldInfo["curVal"] === null or
                    ($fieldInfo["format"] == "datetime" and !$fieldInfo["curVal"])) {
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


        if($this->query($queryToInsert)){

            foreach ($this->record as $fieldName=>$fieldInfo) {
                if ($fieldInfo["indexes"]) {
                    if($fieldInfo["auto_increment"]){
                        $this->record[$fieldName]["curVal"]=$this->lastInsertId($fieldName);
                    }
                }
            }
            $this->log_message =  $this->log_message = $this->lang_map["insertRecord"]["success"][$_SESSION["lang"]].$date_stamp;
            return true;
        }

        $this->log_message = $this->lang_map["insertRecord"]["fail"][$_SESSION["lang"]].$date_stamp;
        return false;
    }

    public function updateRecord(){

        $date_stamp = date("H:i:s");
        $query_text="update ".$this->tableName." set ";
        $q_where = " where ";
        $q_fields = null;
        foreach ($this->record as $fieldName=>$fieldInfo) {
            if(!$fieldInfo["use_table_name"] or
                ($fieldInfo["use_table_name"] == $this->tableName)) {
                if ($fieldInfo["indexes"]) {
                    $q_where .= $fieldName . "='";
                    if ($fieldInfo["fetchVal"]) {
                        $q_where .= $fieldInfo["fetchVal"];
                    } else {
                        $q_where .= $fieldInfo["curVal"];
                    }
                    $q_where .= "' and ";
                }

                if ($fieldInfo["fetchVal"] != $fieldInfo["curVal"]) {
                    if (!$fieldInfo["indexes"] or
                        ($fieldInfo["indexes"] and $this->allow_edit_indexes)
                    ) {
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

        $q_where = substr($q_where, 0, strlen($q_where)-4);
        $q_fields = substr($q_fields, 0, strlen($q_fields)-2);
        if($q_fields){
            if($this->query($query_text.$q_fields.$q_where)){
                $this->log_message .= $this->lang_map["updateRecord"]["success"][$_SESSION["lang"]].": ".$date_stamp;
                return true;
            }else{
                $this->log_message .= $this->lang_map["updateRecord"]["fail"][$_SESSION["lang"]].": ".$date_stamp;
                return false;
            }
        }else{
            $this->log_message .= $this->lang_map["updateRecord"]["nothing"][$_SESSION["lang"]].": ".$date_stamp;
            return true;
        }
    }

    function deleteRecord(){
        $date_stamp = date("H:i:s");
        $q_where = null;
        foreach ($this->record as $fieldName=>$fieldInfo) {
            if ($fieldInfo["indexes"]) {
                $q_where.=$fieldName."='".$fieldInfo["curVal"]."' and ";
            }
        }
        $q_where = substr($q_where, 0, strlen($q_where)-4);

        if($this->query("delete from ".$this->tableName." where ".$q_where)){
            return array(
                "result"=>1,
                "log"=>"deleteRecord success: ".$date_stamp,
            );
        }else{
            return array(
                "result"=>0,
                "log"=>"deleteRecord fail: ".$date_stamp,
            );
        }
    }

    function filterWhere($method = "POST", $REQ_ARR = null)
    {
        if($method == "GET"){
            $REQ_ARR = $_GET;
        }elseif(!$method){
            $REQ_ARR = $_POST;
        }

        $return_where = null;
        $return_order = null;
        $return_limit = null;
        $filed_in_arr_sort = null;
        $filed_in_arr_sortOrder = null;
        foreach ($this->searchFields as $fName=>$fData){
            if($fData["sort"] && !$filed_in_arr_sort){
                $filed_in_arr_sort = $fName;
                if($fData["sortOrder"]){
                    $filed_in_arr_sortOrder=$fData["sortOrder"];
                }
            }

            $useFieldName = $fName;
            if($fData["use_table_name"]){
                $useTableName = $fData["use_table_name"];
                if($fData["use_field_name"]){
                    $useFieldName = $fData["use_field_name"];
                }
            }else{
                $useTableName = $this->tableName;
            }



            if($REQ_ARR[$fName]){
                if($fData["format"]=="checkbox" or $fData["format"]=="tinyint"){
                    if($REQ_ARR[$fName] == "on"){
                        $return_where.=$useTableName.".".$useFieldName."=true and ";
                        $this->record[$fName]["val"] = 1;
                    }else{
                        $return_where.=$useTableName.".".$useFieldName."=false and ";
                        $this->record[$fName]["val"] = 0;
                    }
                }elseif($fData["format"]=="varchar" || $fData["format"] == "text"){
                    $return_where.=$useTableName.".".$useFieldName." like '%".$REQ_ARR[$fName]."%' and ";
                }else{
                    $return_where.=$useTableName.".".$useFieldName." = '".$REQ_ARR[$fName]."' and ";
                }
            }
        }

        if($return_where){
            $return_where=" where ".substr($return_where, 0 , strlen($return_where)-4);
        }

        if($REQ_ARR["onPage"]){
            if($REQ_ARR["curPage"]){
                $return_limit.=" limit ".(($REQ_ARR["curPage"]-1)*$REQ_ARR["onPage"]).", ".$REQ_ARR["onPage"];
            }
        }else{
            $return_limit.=" limit 10";
        }

        if($REQ_ARR["sortField"]){

            if($this->searchFields[$REQ_ARR["sortField"]]["use_table_name"]){
                $sort_table_name = $this->searchFields[$REQ_ARR["sortField"]]["use_table_name"];

                if($this->searchFields[$REQ_ARR["sortField"]]["use_field_name"]){
                    $sort_field_name = $this->searchFields[$REQ_ARR["sortField"]]["use_field_name"];
                }else{
                    $sort_field_name = $_POST["sortField"];
                }

            }else{
                $sort_field_name = $_POST["sortField"];
                $sort_table_name = $this->tableName;
            }
            $return_order.= " order by ".$sort_table_name.".".$sort_field_name;
            if($REQ_ARR["sortOrder"]){
                $return_order.=" ".$REQ_ARR["sortOrder"];
            }
        }elseif ($filed_in_arr_sort){
            $return_order.= " order by ".$filed_in_arr_sort." ".$filed_in_arr_sortOrder;
        }

        return array(
            "where"=>$return_where,
            "limit"=>$return_limit,
            "order"=>$return_order,
        );
    }

    function copyPost()
    {
        foreach ($this->record as $fName=>$fData){
            if($this->editFields[$fName]){
                //skip (dont rewrite) readonly fields
                if(!$this->editFields[$fName]["readonly"]){
                    if(($fData["format"]=="checkbox") or ($fData["format"] == "tinyint")){
                        if($_POST[$fName] == "on"){
                            $this->record[$fName]["curVal"] = 1;
                        }else{
                            $this->record[$fName]["curVal"] = 0;
                        }
                    }else{
                        if(isset($_POST[$fName])){
                            $this->record[$fName]["curVal"] = $_POST[$fName];
                        }else{
                            $this->record[$fName]["curVal"]=null;
                        }
                    }
                }
            }
        }
    }

    function copyGetId()
    {
        foreach ($this->record as $fName=>$fData){
            if(($fData["indexes"] == true) and isset($_GET[$fName])){
                $this->record[$fName]["curVal"] = $_GET[$fName];
            }
        }
    }
}