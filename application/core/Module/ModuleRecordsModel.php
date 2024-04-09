<?php
class ModuleRecordsModel extends RecordsModel
{
    public $access_groups = null;
    public $access_rules = array(
        "read_rule" => 0,
        "create_rule" => 0,
        "edit_rule" => 0,
        "delete_rule" => 0,
    );

    function __construct()
    {
        parent::__construct();
        $this->lang_map["file_err"] = array(
            "unlink_err" => array(
                "en" => "unlink error in ModuleRecordsModel.php",
                "rus" => "ошибка при удалении в ModuleRecordsModel.php",
            ),
            "mvf_err_extension" => array(
                "en" => "cant move extension",
                "rus" => "невозможно загрузить расширение",
            ),
            "mvf_err_load" => array(
                "en" => "load error in ModuleRecordsModel.php",
                "rus" => "ошибка при загрузке в ModuleRecordsModel.php",
            ),
            "form_h2" => array(
                "en" => "main info",
                "rus" => "основная информация",
            ),
        );
    }

    function checkAccessModel()
    {

        if($_SESSION["site_user"]["is_admin"]){
            $this->access_rules = array(
                "read_rule" => 7,
                "create_rule" => 7,
                "edit_rule" => 7,
                "delete_rule" => 7,
            );
            return true;
        }
        $access_key_val = array(
            "any" => 7,
            "own" => 2,
            "enable" => 7,
            "disable" => 0,
            "forbidden" => 0,
            "" => 0,
            null => 0,
        );

        if($this->access_groups){
            if($_SESSION["site_user"]["groups"]){
                foreach ($_SESSION["site_user"]["groups"] as $group_id => $access_rules){
                    if(in_array($group_id, $this->access_groups)){
                        foreach ($this->access_rules as $return_u_rule => $return_u_val){
                            if($access_key_val[$access_rules[$return_u_rule]] > $return_u_val){
                                $this->access_rules[$return_u_rule] = $access_key_val[$access_rules[$return_u_rule]];
                            }
                        }
                    }
                }
            }
        }else{
            $this->access_rules = array(
                "read_rule" => 7,
                "create_rule" => 7,
                "edit_rule" => 7,
                "delete_rule" => 7,
            );
        }
        if(!$this->access_rules["read_rule"]){
            throwErr("access", "access denied in ModuleRecordsModel");
        }

    }

    function filterWhere($method = "POST", $REQ_ARR = null)
    {
        $filter_where = parent::filterWhere($method, $REQ_ARR);
        if($this->access_rules["read_rule"] > 2){
            return $filter_where;
        }elseif($this->access_rules["read_rule"] == 2){
            if($filter_where["where"]){
                $filter_where["where"].= " and ";
            }else{
                $filter_where["where"].= " where ";
            }
            $filter_where["where"] .= $this->tableName.".created_by = '".$_SESSION["site_user"]["user_id"]."'";
            return $filter_where;
        }else{
            throwErr("access", "access denied in ModuleRecordsModel filterWhere");
        }
    }

    function fetchToArray($findList_qry){
        $return_access_listRecords = parent::fetchToArray($findList_qry);

        if($this->access_rules["edit_rule"] > 2 and $this->access_rules["delete_rule"] > 2){
            return $return_access_listRecords;
        }else{
            if($return_access_listRecords){
                foreach ($return_access_listRecords as $row_num => $row){
                    if ($this->access_rules["edit_rule"] < 3) {
                        if ($this->access_rules["edit_rule"] == 2) {
                            if ($row["created_by"] != $_SESSION["site_user"]["user_id"]) {
                                $return_access_listRecords[$row_num]["btnEdit"] = "disabled";
                            }

                        } else {
                            $return_access_listRecords[$row_num]["btnEdit"] = "disabled";
                        }

                    }
                    if ($this->access_rules["delete_rule"] < 3) {
                        if ($this->access_rules["delete_rule"] == 2) {
                            if ($row["created_by"] != $_SESSION["site_user"]["user_id"]) {
                                $return_access_listRecords[$row_num]["btnDelete"] = "disabled";
                            }

                        } else {
                            $return_access_listRecords[$row_num]["btnDelete"] = "disabled";
                        }

                    }
                }
            }

            return $return_access_listRecords;
        }
    }

    function copyRecord()
    {
        if(parent::copyRecord()){
            if($this->access_rules["read_rule"]<3){
                if ($this->access_rules["edit_rule"] == 2) {
                    if($this->record["created_by"]["curVal"] == $_SESSION["site_user"]["user_id"]){
                        return true;
                    }else{
                        throwErr("access", "access denied in ModuleRecordsModel copyRecord on user_id");
                    }
                }else{
                    throwErr("access", "access denied in ModuleRecordsModel copyRecord on edit_rule");
                }
            }
            $this->copyCustomFields();
            return true;
        }else{
            return false;
        }
    }

    function copyCustomFields()
    {
        return true;
    }

    function insertRecord()
    {
        if($this->access_rules["create_rule"] == 7){
            if($_FILES){
                foreach ($_FILES as $file_field => $file_info){
                    if($this->editFields[$file_field]["format"] == "file"){
                        $this->uploadRecordFile($file_field, false, false);
                    }
                }
            }
            return parent::insertRecord(); // TODO: Change the autogenerated stub
        }else{
            throwErr("access", "access denied in ModuleRecordsModel insertRecord");
        }
    }

    function uploadRecordFile($field_name, $use_file_name = false, $del_fetch_file = true){

        if(!$_FILES[$field_name]["error"]){
            $path_parts = pathinfo($_FILES[$field_name]["name"]);
            $file_extension = $path_parts["extension"];

            if(strpos(" ".$this->editFields[$field_name]["file_options"]["accept"], $file_extension)){

                if($del_fetch_file){
                    $this->deleteRecordFetchFile($field_name);
                }

                if($use_file_name){
                    $file_name = $path_parts["filename"];
                }else{
                    $file_name = $this->createGUID();
                }

                //mk upload folder when replaces
                $this->record[$field_name]["curVal"] = $file_name.".".$file_extension;
                $imgLink = $this->extract_ef_from_replaces($field_name);
                $upload_dir = null;
                $f_expd = explode("/", $imgLink);
                for($i = 0; $i < count($f_expd)-1; $i++){
                    $upload_dir.= $f_expd[$i]."/";
                }
                if(!is_dir($_SERVER["DOCUMENT_ROOT"].$upload_dir)){
                    mkdir($_SERVER["DOCUMENT_ROOT"].$upload_dir);
                }

                //echo $_SERVER["DOCUMENT_ROOT"].
                //    $imgLink;
               // exit;

                $moved = @move_uploaded_file($_FILES[$field_name]['tmp_name'], $_SERVER["DOCUMENT_ROOT"].
                    $imgLink);
                if($moved) {
                    return true;
                } else {
                    $this->log_message .= $this->lang_map["file_err"]["mvf_err_load"][$_SESSION["lang"]];
                    return false;
                }
            }else{
                $this->log_message .= $this->lang_map["file_err"]["mvf_err_extension"][$_SESSION["lang"]].": ".$file_extension."; ";
                return false;
            }
        }else{

            if($_FILES[$field_name]["error"] == 4){
                $this->record[$field_name]["curVal"] = $this->record[$field_name]["fetchVal"];
                return true;
            }else{
                return false;
            }

        }

    }

    function deleteRecordFetchFile($field_name)
    {
        if($this->record[$field_name]["fetchVal"]){
            $fileLink = $this->extract_ef_from_replaces($field_name);
            $upload_dir = null;
            $f_expd = explode("/", $fileLink);
            for($i = 0; $i < count($f_expd)-1; $i++){
                $upload_dir.= $f_expd[$i]."/";
            }
            if(@unlink($_SERVER["DOCUMENT_ROOT"].
                $upload_dir."/".$this->record[$field_name]["fetchVal"])){
                $this->record[$field_name]["curVal"] = null;
                return true;
            }else{
                $this->log_message .= $this->lang_map["file_err"]["unlink_err"][$_SESSION["lang"]];
                return false;
            }
        }
    }

    function deleteRecord()
    {
        foreach ($this->editFields as $fieldName => $fieldOptions){
            if($fieldOptions["format"] == "file" and $fieldOptions["file_options"]["load_dir"]){
                $this->deleteRecordFetchFile($fieldName);
            }
        }
        return parent::deleteRecord(); // TODO: Change the autogenerated stub
    }

    function extract_ef_from_replaces($field_name)
    {
        if($this->editFields[$field_name]["file_options"]["load_dir"] and $this->record[$field_name]["curVal"]){
            //if($this->editFields[$field_name]["file_options"]["file_type"] == "img"){
                if($this->editFields[$field_name]["replaces"]){
                    $imgLink = $this->editFields[$field_name]["file_options"]["load_dir"];
                    foreach ($this->editFields[$field_name]["replaces"] as $replace){
                        $imgLink = str_replace($replace, $this->record[$replace]["curVal"], $imgLink);
                    }
                }else{
                    $imgLink = $this->editFields[$field_name]["file_options"]["load_dir"]."/".$this->record[$field_name]["curVal"];
                }
            //}
        }else{
            //echo "nnn";
        }
        return $imgLink;
    }
}