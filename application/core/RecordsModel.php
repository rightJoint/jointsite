<?php
require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR ."/application/recordsStructureFiles/recordStructureFields.php";
class RecordsModel extends Model_pdo
{
    public $tableName = null;
    public $modelAliases = array(
        "en" => null,
        "rus" => null,
    );

    public $recordStructureFields;

    function __construct($tableName = null)
    {
        parent::__construct();
        if($tableName and !$this->tableName){
            $this->tableName = $tableName;
        }
        if($this->tableName){
            $this->getRecordStructure();
        }else{
            jointSite::throwErr("XXX", $this->lang_map->table_name_rm_err);
        }
    }

    function load_lang_files()
    {
        parent::load_lang_files(); // TODO: Change the autogenerated stub
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/lang_files/models/lang_model_Record_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_model_Record_".$_SESSION[JS_SAIK]["lang"];
    }

    function getRecordStructure()
    {
        $this->recordStructureFields = new  recordStructureFields();

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
                    $this->recordStructureFields->record[$datatype_row["COLUMN_NAME"]]["indexes"] = 1;

                    $this->recordStructureFields->searchFields[$datatype_row["COLUMN_NAME"]]["indexes"] = 1;
                    $this->recordStructureFields->editFields[$datatype_row["COLUMN_NAME"]]["indexes"] = 1;

                    $this->recordStructureFields->viewFields[$datatype_row["COLUMN_NAME"]]["indexes"] = 1;
                    $replaceUrl.=$datatype_row["COLUMN_NAME"]."=".$datatype_row["COLUMN_NAME"]."&";
                    $replaceArr[] = $datatype_row["COLUMN_NAME"];
                    $this->recordStructureFields->listFields["btnDetail"]["replaces"][] = $datatype_row["COLUMN_NAME"];
                    $this->recordStructureFields->listFields["btnEdit"]["replaces"][] = $datatype_row["COLUMN_NAME"];
                    $this->recordStructureFields->listFields["btnDelete"]["replaces"][] = $datatype_row["COLUMN_NAME"];
                    if($datatype_row["EXTRA"] == "auto_increment"){
                        $this->recordStructureFields->editFields[$datatype_row["COLUMN_NAME"]]["readonly"] = true;
                        $this->recordStructureFields->editFields[$datatype_row["COLUMN_NAME"]]["readonly"] = true;
                        $this->recordStructureFields->record[$datatype_row["COLUMN_NAME"]]["auto_increment"] = true;
                    }
                }else{
                    jointSite::throwErr("XXX", "unknown key type in model->getRecordStructure");
                }

                $this->recordStructureFields->editFields[$datatype_row["COLUMN_NAME"]]["format"] = $datatype_row["DATA_TYPE"];

                if($datatype_row["DATA_TYPE"] == "text"){
                    $searchDataType = "varchar";
                }else{
                    $searchDataType = $datatype_row["DATA_TYPE"];
                }
                $this->recordStructureFields->searchFields[$datatype_row["COLUMN_NAME"]]["format"] = $searchDataType;
                $this->recordStructureFields->searchFields[$datatype_row["COLUMN_NAME"]]["sort"] = true;
                $this->recordStructureFields->searchFields[$datatype_row["COLUMN_NAME"]]["search"] = true;
                $this->recordStructureFields->listFields[$datatype_row["COLUMN_NAME"]]["format"] = $datatype_row["DATA_TYPE"];
                $this->recordStructureFields->listFields[$datatype_row["COLUMN_NAME"]]["maxLength"] = 20;
                $this->recordStructureFields->viewFields[$datatype_row["COLUMN_NAME"]]["format"] = $datatype_row["DATA_TYPE"];
                $this->recordStructureFields->viewFields[$datatype_row["COLUMN_NAME"]]["readonly"] = true;
                $this->recordStructureFields->record[$datatype_row["COLUMN_NAME"]]["format"] = $datatype_row["DATA_TYPE"];
            }
        }else{
            jointSite::throwErr("request", $this->lang_map->table_name_not_found.": table_name='".$this->tableName."', ".
                "/core/RecordsModel->getRecordStructure");
        }
        if($count_keys){
            $this->recordStructureFields->listFields["btnDetail"]["format"] = "link";
            $this->recordStructureFields->listFields["btnEdit"]["format"] = "link";
            $this->recordStructureFields->listFields["btnDelete"]["format"] = "link";

            $replaceUrl=substr($replaceUrl, 0, strlen($replaceUrl)-1);
            $this->recordStructureFields->listFields["btnDetail"]["url"] = $replaceUrl;
            $this->recordStructureFields->listFields["btnEdit"]["url"] = $replaceUrl;
            $this->recordStructureFields->listFields["btnDelete"]["url"] = $replaceUrl;
        }
    }

    public function countRecords($where = null)
    {
        return $this->query("SELECT COUNT(*) as cnt from ".$this->tableName." ".$where)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }

    public function listRecords($where = null, $order = null, $limit = null, $having = null)
    {
        $findList_qry = "select ";
        foreach ($this->recordStructureFields->listFields as $fieldName => $fieldOptions){
            if(!in_array($fieldName, array("btnEdit", "btnDelete", "btnDetail"))){
                $findList_qry .= $fieldName.", ";
            }
        }
        $findList_qry = substr($findList_qry, 0, strlen($findList_qry)-2);
        $findList_qry.= " from ".$this->tableName." ".$where.$having.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }

    public function fetchToArray($findList_qry)
    {
        if($findList_res = $this->pdo_query($findList_qry)){
            $return_listRecords = array();
            if($findList_res->rowCount()){
                $row_counter = 0;
                while ($findList_row = $findList_res->fetch(PDO::FETCH_ASSOC)){
                    $return_listRecords[$row_counter] = $findList_row;
                    $row_counter++;
                }
            }
            return $return_listRecords;
        }
        jointSite::throwErr("XXX", $this->log_message);
    }

    public function copyRecord(){
        $date_stamp = date("H:i:s");
        $query_text="select * from ".$this->tableName." where ";
        foreach ($this->recordStructureFields->record as $fieldName=>$fieldInfo) {
            if (isset($fieldInfo["indexes"])) {
                $query_text.=$fieldName."='".$fieldInfo["curVal"]."' and " ;
            }
        }
        $query_text = substr($query_text, 0, strlen($query_text)-4);
        $query_res = $this->query($query_text);
        if($query_res->rowCount()==1){
            $result=$query_res->fetch(PDO::FETCH_ASSOC);
            foreach ($this->recordStructureFields->record as $fieldName=>$fieldInfo) {
                if(isset($result[$fieldName])){
                    $this->recordStructureFields->record[$fieldName]["curVal"] = $result[$fieldName];
                    $this->recordStructureFields->record[$fieldName]["fetchVal"] = $result[$fieldName];
                }else{
                    $this->recordStructureFields->record[$fieldName]["curVal"] = null;
                    $this->recordStructureFields->record[$fieldName]["fetchVal"] = null;
                }
            }
            return $this->copyCustomFields();
        }

        $this->log_message = $this->lang_map->copyRecord["fail"]." ".$date_stamp;
        return false;
    }

    function copyCustomFields()
    {
        return true;
    }

    function insertRecord(){
        $date_stamp = date("H:i:s");
        $queryToInsert = null;
        $queryToInsert_temp = "(";
        $queryToInsert .= "insert into ".$this->tableName." (\r";
        foreach ($this->recordStructureFields->record as $fieldName=>$fieldInfo) {

            if(isset($_FILES[$fieldName]) and isset($this->recordStructureFields->editFields[$fieldName]["format"])
            and $this->recordStructureFields->editFields[$fieldName]["format"] == "file"){
                if($this->uploadRecordFile($fieldName, false, true)){
                    $fieldInfo["curVal"] = $this->recordStructureFields->record[$fieldName]["curVal"];
                }
            }

            if(
                !isset($fieldInfo["use_table_name"]) or
                (isset($fieldInfo["use_table_name"]) and $fieldInfo["use_table_name"] == $this->tableName)
            ){
                if(isset($fieldInfo["indexes"]) and $fieldInfo["indexes"] == true) {
                    if (!isset($fieldInfo["auto_increment"])) {
                        if (!isset($this->recordStructureFields->record[$fieldName]["curVal"]) or
                            $this->recordStructureFields->record[$fieldName]["curVal"] == null) {
                            $fieldInfo["curVal"] = $this->createGUID();
                            $this->recordStructureFields->record[$fieldName]["curVal"] = $fieldInfo["curVal"];
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


        if($this->query($queryToInsert)){

            foreach ($this->recordStructureFields->record as $fieldName=>$fieldInfo) {
                if (isset($fieldInfo["indexes"]) and $fieldInfo["indexes"] == true) {
                    if(isset($fieldInfo["auto_increment"]) and $fieldInfo["auto_increment"] == true){
                        $this->recordStructureFields->record[$fieldName]["curVal"]=$this->lastInsertId($fieldName);
                    }
                }
            }
            $this->log_message = $this->lang_map->insertRecord["success"].$date_stamp;
            return true;
        }

        $this->log_message = $this->lang_map->insertRecord["fail"].$date_stamp;
        return false;
    }

    public function updateRecord(){

        $date_stamp = date("H:i:s");
        $query_text="update ".$this->tableName." set ";
        $q_where = " where ";
        $q_fields = "";
        foreach ($this->recordStructureFields->record as $fieldName=>$fieldInfo) {

            if((isset($_FILES[$fieldName]) and isset($this->recordStructureFields->editFields[$fieldName]["format"])) and
                ($this->recordStructureFields->editFields[$fieldName]["format"] == "file" and $_FILES[$fieldName])){
                if($this->uploadRecordFile($fieldName, false, true)){
                    $fieldInfo["curVal"] = $this->recordStructureFields->record[$fieldName]["curVal"];
                }
            }

            if(!isset($fieldInfo["use_table_name"]) or
                ($fieldInfo["use_table_name"] == $this->tableName)) {
                if (isset($fieldInfo["indexes"])) {
                    $q_where .= $fieldName . "='";
                    if ($fieldInfo["fetchVal"]) {
                        $q_where .= $fieldInfo["fetchVal"];
                    } else {
                        $q_where .= $fieldInfo["curVal"];
                    }
                    $q_where .= "' and ";
                }

                if ($fieldInfo["fetchVal"] != $fieldInfo["curVal"]) {
                    if(!isset($this->recordStructureFields->editFields[$fieldName]["readonly"])){
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
        if(strlen($q_fields) > 2){
            $q_fields = substr($q_fields, 0, strlen($q_fields)-2);
            if($this->query($query_text.$q_fields.$q_where)){
                $this->log_message .= $this->lang_map->updateRecord["success"].": ".$date_stamp;
                return true;
            }else{
                $this->log_message .= $this->lang_map->updateRecord["fail"].": ".$date_stamp;
                return false;
            }
        }else{
            $this->log_message .= $this->lang_map->updateRecord["nothing"].": ".$date_stamp;
            return true;
        }
    }

    function deleteRecord(){

        foreach ($this->recordStructureFields->editFields as $fieldName => $fieldOptions){
            if($fieldOptions["format"] == "file" and $fieldOptions["file_options"]["load_dir"]){
                $this->deleteRecordFetchFile($fieldName);
            }
        }

        $date_stamp = date("H:i:s");
        $q_where = null;
        foreach ($this->recordStructureFields->record as $fieldName=>$fieldInfo) {
            if (isset($fieldInfo["indexes"]) and $fieldInfo["indexes"] == true) {
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

    function filterWhere($method = "POST", $REQ_ARR = null)
    {
        if(!$REQ_ARR){
            if($method == "GET"){
                $REQ_ARR = $_GET;
            }elseif($method == "POST" and !($REQ_ARR)){
                $REQ_ARR = $_POST;
            }
        }

        $return_where = null;
        $return_order = null;
        $return_limit = null;
        $return_having = null;

        foreach ($this->recordStructureFields->searchFields as $fName=>$fData){
            $useFieldName = $fName;
            if(isset($fData["use_table_name"])){
                $useTableName = $fData["use_table_name"];
                if(isset($fData["use_field_name"])){
                    $useFieldName = $fData["use_field_name"];
                }
            }else{
                $useTableName = $this->tableName;
            }

            if(isset($REQ_ARR[$fName]) and $REQ_ARR[$fName]!= null){

                if(isset($fData["group_by_field"])){
                    if($fData["format"]=="varchar" || $fData["format"] == "text"){
                        $return_having .= $useFieldName." like '%".$REQ_ARR[$fName]."%' and ";
                    }elseif($fData["format"]=="int"){
                        $return_having .= $useFieldName." = ".$REQ_ARR[$fName]." and ";
                    }else{
                        $return_having .= $useFieldName." = '".$REQ_ARR[$fName]."' and ";
                    }
                }elseif($fData["format"]=="checkbox" or $fData["format"]=="tinyint"){
                    if($REQ_ARR[$fName] == "on"){
                        $return_where.=$useTableName.".".$useFieldName."=true and ";
                        $this->recordStructureFields->record[$fName]["curVal"] = 1;
                    }else{
                        $return_where.=$useTableName.".".$useFieldName."=false and ";
                        $this->recordStructureFields->record[$fName]["curVal"] = 0;
                    }
                }elseif($fData["format"]=="int"){
                    $return_where.=$useTableName.".".$useFieldName." = ".$REQ_ARR[$fName]." and ";
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
        if($return_having){
            $return_having=" having ".substr($return_having, 0 , strlen($return_having)-4);
        }

        if(isset($REQ_ARR["onPage"])){
            if($REQ_ARR["curPage"]){
                $return_limit.=" limit ".(($REQ_ARR["curPage"]-1)*$REQ_ARR["onPage"]).", ".$REQ_ARR["onPage"];
            }
        }else{
            $return_limit.=" limit 10";
        }

        if(isset($REQ_ARR["sortField"])){

            if(isset($this->recordStructureFields->searchFields[$REQ_ARR["sortField"]]["use_table_name"])){
                $sort_table_name = $this->recordStructureFields->searchFields[$REQ_ARR["sortField"]]["use_table_name"].".";

                if(isset($this->recordStructureFields->searchFields[$REQ_ARR["sortField"]]["use_field_name"])){
                    $sort_field_name = $this->recordStructureFields->searchFields[$REQ_ARR["sortField"]]["use_field_name"];
                }else{
                    $sort_field_name = $REQ_ARR["sortField"];
                }

            }elseif (isset($this->recordStructureFields->searchFields[$REQ_ARR["sortField"]]["group_by_field"])){
                $sort_field_name = $REQ_ARR["sortField"];
                $sort_table_name = null;
            }else{
                $sort_field_name = $REQ_ARR["sortField"];
                $sort_table_name = $this->tableName.".";
            }
            $return_order.= " order by ".$sort_table_name.$sort_field_name;
            if($REQ_ARR["sortOrder"]){
                $return_order.=" ".$REQ_ARR["sortOrder"];
            }
        }else{
            $field_sort_default = null;
            foreach ($this->recordStructureFields->searchFields as $search_field => $sf_opt){
                if(isset($sf_opt["sort"]) and $sf_opt["format"] != "hidden"){
                    $field_sort_default = $search_field;
                    break;
                }
            }
            if($field_sort_default){
                if(isset($this->recordStructureFields->searchFields[$field_sort_default]["use_table_name"])){
                    $sort_table_name = $this->recordStructureFields->searchFields[$field_sort_default]["use_table_name"].".";

                    if(isset($this->recordStructureFields->searchFields[$field_sort_default]["use_field_name"])){
                        $sort_field_name = $this->recordStructureFields->searchFields[$field_sort_default]["use_field_name"];
                    }else{
                        $sort_field_name = $field_sort_default;
                    }

                }else{
                    $sort_field_name = $field_sort_default;
                    $sort_table_name = $this->tableName.".";
                }

                $return_order.= " order by ".$sort_table_name.$sort_field_name;
                if(isset($this->recordStructureFields->searchFields[$field_sort_default]["sortOrder"])){
                    $return_order.=" ".$this->recordStructureFields->searchFields[$field_sort_default]["sortOrder"];
                }
            }
        }

        return array(
            "where"=>$return_where,
            "limit"=>$return_limit,
            "order"=>$return_order,
            "having"=>$return_having,
        );
    }

    function copyValFromRequest($REQ_ARR = null, $method = "POST")
    {
        if(!$REQ_ARR){
            if($method == "GET"){
                $REQ_ARR = $_GET;
            }else{
                $REQ_ARR = $_POST;
            }
        }
        foreach ($this->recordStructureFields->record as $fName=>$fData){
            if(isset($this->recordStructureFields->editFields[$fName])){
                if(($fData["format"]=="checkbox") or ($fData["format"] == "tinyint")){
                    if(isset($REQ_ARR[$fName]) and $REQ_ARR[$fName] == "on"){
                        $this->recordStructureFields->record[$fName]["curVal"] = 1;
                    }else{
                        $this->recordStructureFields->record[$fName]["curVal"] = 0;
                    }
                }else{
                    if(isset($REQ_ARR[$fName])){
                        $this->recordStructureFields->record[$fName]["curVal"] = $REQ_ARR[$fName];
                    }else{
                        $this->recordStructureFields->record[$fName]["curVal"]=null;
                    }
                }
            }
        }
    }

    function uploadRecordFile($field_name, $use_file_name = false, $del_fetch_file = true){
        if(!$_FILES[$field_name]["error"]){
            $path_parts = pathinfo($_FILES[$field_name]["name"]);
            $file_extension = $path_parts["extension"];
            if(strpos(" ".$this->recordStructureFields->editFields[$field_name]["file_options"]["accept"], $file_extension)){
                if($del_fetch_file){
                    $this->deleteRecordFetchFile($field_name);
                }
                if($use_file_name){
                    $file_name = $path_parts["filename"];
                }else{
                    $file_name = $this->createGUID();
                }

                //mk upload folder when replaces
                $this->recordStructureFields->record[$field_name]["curVal"] = $file_name.".".$file_extension;
                $imgLink = $this->extract_ef_from_replaces($field_name);
                $upload_dir = null;
                $f_expd = explode("/", $imgLink);
                for($i = 0; $i < count($f_expd)-1; $i++){
                    $upload_dir.= $f_expd[$i]."/";
                }

                if(!is_dir($_SERVER["DOCUMENT_ROOT"].$upload_dir)){
                    mkdir($_SERVER["DOCUMENT_ROOT"].$upload_dir, 0777, true);
                }

                $moved = @move_uploaded_file($_FILES[$field_name]['tmp_name'], $_SERVER["DOCUMENT_ROOT"].
                    $imgLink);
                if($moved) {
                    return true;
                } else {
                    $this->log_message .= $this->lang_map->file_err["mvf_err_load"];
                    return false;
                }
            }else{
                $this->log_message .= $this->lang_map->file_err["mvf_err_extension"].": ".$file_extension."; ";
                return false;
            }
        }else{

            if($_FILES[$field_name]["error"] == 4){
                if(isset($this->recordStructureFields->record[$field_name]["fetchVal"]) and
                    $this->recordStructureFields->record[$field_name]["fetchVal"]!= null){
                    $this->recordStructureFields->record[$field_name]["curVal"] = $this->recordStructureFields->record[$field_name]["fetchVal"];
                }
                return true;
            }else{
                return false;
            }
        }
    }

    function deleteRecordFetchFile($field_name)
    {
        if(isset($this->recordStructureFields->record[$field_name]["fetchVal"])){
            $fileLink = $this->extract_ef_from_replaces($field_name, "fetchVal");
            $upload_dir = null;
            $f_expd = explode("/", $fileLink);
            for($i = 0; $i < count($f_expd)-1; $i++){
                $upload_dir.= $f_expd[$i]."/";
            }
            if(@unlink(               $_SERVER["DOCUMENT_ROOT"].$fileLink)){
                return true;
            }else{
                $this->log_message .= $this->lang_map->file_err["unlink_err"];
                return false;
            }
        }
    }

    function extract_ef_from_replaces($field_name, $state_val = "curVal")
    {
        if($this->recordStructureFields->editFields[$field_name]["file_options"]["load_dir"] and $this->recordStructureFields->record[$field_name][$state_val]){
            if(isset($this->recordStructureFields->editFields[$field_name]["replaces"])){
                $file_link = $this->recordStructureFields->editFields[$field_name]["file_options"]["load_dir"];

                foreach ($this->recordStructureFields->editFields[$field_name]["replaces"] as $replace){
                    $file_link = str_replace($replace, $this->recordStructureFields->record[$replace][$state_val], $file_link);
                }
            }else{

                $file_link = $this->recordStructureFields->editFields[$field_name]["file_options"]["load_dir"]."/".
                    $this->recordStructureFields->record[$field_name][$state_val];
            }

        }else{
            //echo "nnn";
        }
        return $file_link;
    }
}