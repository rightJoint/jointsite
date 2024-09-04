<?php
class ModuleModel extends RecordsModel
{
    public $access_groups = null;
    public $access_rules = array(
        "read_rule" => 0,
        "create_rule" => 0,
        "edit_rule" => 0,
        "delete_rule" => 0,
    );

    public $module_name;

    public $bind_models;

    function __construct($tableName = null)
    {
        $this->get_access_groups();
        $this->checkAccessModel();
        parent::__construct($tableName);

    }

    function load_lang_files()
    {
        parent::load_lang_files();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/models/lang_model_Module_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_model_Module_".$_SESSION[JS_SAIK]["lang"];
    }

    function get_access_groups()
    {
        if(isset($this->module_name)){
            include JOINT_SITE_CONF_DIR.
                "/modules/access_groups.php";
            $this->access_groups = $module_access_groups[$this->module_name];
        }
    }

    function checkAccessModel()
    {
        if(isset($_SESSION[JS_SAIK]["site_user"]["is_admin"]) and $_SESSION[JS_SAIK]["site_user"]["is_admin"] == true){
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
            if(isset($_SESSION[JS_SAIK]["site_user"]["groups"])){
                foreach ($_SESSION[JS_SAIK]["site_user"]["groups"] as $group_id => $access_rules){
                    if(in_array($group_id, $this->access_groups)){
                        foreach ($this->access_rules as $return_u_rule => $return_u_val){
                            if($access_key_val[$access_rules[$return_u_rule]] > $this->access_rules[$return_u_rule]){
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
            jointSite::throwErr("access", "access denied in ModuleModel");
        }

    }


    function filterWhere($REQ_ARR)
    {
        $filter_where = parent::filterWhere($REQ_ARR);
        if($this->access_rules["read_rule"] > 2){
            return $filter_where;
        }elseif($this->access_rules["read_rule"] == 2){
            if($filter_where["where"]){
                $filter_where["where"].= " and ";
            }else{
                $filter_where["where"].= " where ";
            }
            $filter_where["where"] .= $this->tableName.".created_by = '".$_SESSION[JS_SAIK]["site_user"]["user_id"]."'";
            return $filter_where;
        }else{
            jointSite::throwErr("access", "access denied in ModuleRecordsModel filterWhere");
        }
    }

    function fetchToArray($findList_qry){
        $return_access_listRecords = parent::fetchToArray($findList_qry);

        if($this->access_rules["edit_rule"] > 2 and $this->access_rules["delete_rule"] > 2){
            return $return_access_listRecords;
        }else{
            if($return_access_listRecords){
                foreach ($return_access_listRecords as $row_num => $row){
                    $check_read = true;
                    if ($this->access_rules["read_rule"] < 3) {
                        if ($this->access_rules["read_rule"] == 2) {
                            if ($row["created_by"] != $_SESSION[JS_SAIK]["site_user"]["user_id"]) {
                                $check_read = false;
                            }
                        }
                    }

                    if($check_read == true){
                        if ($this->access_rules["edit_rule"] < 3) {
                            if ($this->access_rules["edit_rule"] == 2) {
                                if ($row["created_by"] != $_SESSION[JS_SAIK]["site_user"]["user_id"]) {
                                    $return_access_listRecords[$row_num]["btnEdit"] = "disabled";
                                }

                            } else {
                                $return_access_listRecords[$row_num]["btnEdit"] = "disabled";
                            }

                        }
                        if ($this->access_rules["delete_rule"] < 3) {
                            if ($this->access_rules["delete_rule"] == 2) {
                                if ($row["created_by"] != $_SESSION[JS_SAIK]["site_user"]["user_id"]) {
                                    $return_access_listRecords[$row_num]["btnDelete"] = "disabled";
                                }

                            } else {
                                $return_access_listRecords[$row_num]["btnDelete"] = "disabled";
                            }

                        }
                    }else{
                        unset($return_access_listRecords[$row_num]);
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
                if ($this->access_rules["read_rule"] == 2) {
                    if($this->recordStructureFields->record["created_by"]["curVal"] == $_SESSION[JS_SAIK]["site_user"]["user_id"]){
                        return true;
                    }else{
                        jointSite::throwErr("access", "access denied in ModuleRecordsModel copyRecord on user_id");
                    }
                }else{
                    jointSite::throwErr("access", "access denied in ModuleRecordsModel copyRecord on edit_rule: ".$this->access_rules["read_rule"]);
                }
            }
            return true;
        }else{
            return false;
        }
    }

    function insertRecord()
    {
        if($this->access_rules["create_rule"] == 7){
            $this->recordStructureFields->record["created_by"]["curVal"] = $_SESSION[JS_SAIK]["site_user"]["user_id"];
            return parent::insertRecord(); // TODO: Change the autogenerated stub
        }else{
            jointSite::throwErr("access", "access denied in ModuleRecordsModel insertRecord: create_rule = ".$this->access_rules["create_rule"]);
        }
    }

    function deleteRecord()
    {
        if($this->access_rules["delete_rule"]<3){
            if ($this->access_rules["delete_rule"] == 2) {
                if($this->recordStructureFields->record["created_by"]["fetchVal"] != $_SESSION[JS_SAIK]["site_user"]["user_id"]){
                    jointSite::throwErr("access",
                        "access denied in ModuleRecordsModel copyRecord on user_id delete_rule: ".$this->access_rules["delete_rule"].
                        " ".$this->recordStructureFields->record["created_by"]["curVal"]." vs ".$_SESSION[JS_SAIK]["site_user"]["user_id"]);
                }
            }else{
                jointSite::throwErr("access", "access denied in ModuleRecordsModel deleteRecord on delete_rule: ".$this->access_rules["delete_rule"]);
            }
        }


        if($this->bind_models){
            if(count($this->bind_models)){
                foreach ($this->bind_models as $bind_model_name => $relationships){
                    $bind_model = new $bind_model_name();
                    $rel_where = null;

                    foreach ($relationships as $master_field => $slave_field){
                        $rel_where.= $bind_model->tableName.".".$slave_field."='".
                            $this->recordStructureFields->record[$master_field]["curVal"]."' and";
                    }
                    if($rel_where){
                        $rel_where = substr($rel_where, 0, strlen($rel_where)-4);
                    }
                    $bind_list = $bind_model->listRecords("where ".$rel_where);

                    foreach ($bind_list as $rec_num => $rec_fields){
                        $del_bind_record = new $bind_model_name();
                        foreach ($bind_model->recordStructureFields->record as $field_name => $field_info){
                            if(isset($field_info["indexes"]) and $field_info["indexes"] == true){
                                $del_bind_record->recordStructureFields->record[$field_name]["curVal"] = $rec_fields[$field_name];
                            }
                        }

                        if($del_bind_record->copyRecord()){
                           $del_bind_record->deleteRecord();
                        }
                    }
                }
            }
        }
        return parent::deleteRecord();
    }
}