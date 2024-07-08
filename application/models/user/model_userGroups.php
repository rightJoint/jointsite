<?php
class model_userGroups extends ModuleModel
{

    public $tableName = "usersToGroups_dt";
    public $modelAliases = array(
        "en" => "Users groups",
        "rus" => "Группы пользователей",
    );


    function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/user/rsf_users_groupstousers.php";

        $this->recordStructureFields = new rsf_users_groupstousers();

        $this->recordStructureFields->editFields["group_id"]["filling"] = $this->fillGroups_name();
        $this->recordStructureFields->editFields["user_id"]["filling"] = $this->fillUser_id();
        $this->recordStructureFields->editFields["user_id"]["filling"] = $this->fillUser_id();

        $this->recordStructureFields->editFields["read_rule"]["filling"] =
        $this->recordStructureFields->listFields["read_rule"]["filling"] =
        $this->recordStructureFields->searchFields["read_rule"]["filling"] = $this->fillViewRule("read");

        $this->recordStructureFields->editFields["create_rule"]["filling"] =
        $this->recordStructureFields->listFields["create_rule"]["filling"] =
        $this->recordStructureFields->searchFields["create_rule"]["filling"] = $this->fillViewRule("create");

        $this->recordStructureFields->editFields["edit_rule"]["filling"] =
        $this->recordStructureFields->listFields["edit_rule"]["filling"] =
        $this->recordStructureFields->searchFields["edit_rule"]["filling"] = $this->fillViewRule("edit");


        $this->recordStructureFields->editFields["delete_rule"]["filling"] =
        $this->recordStructureFields->listFields["delete_rule"]["filling"] =
        $this->recordStructureFields->searchFields["edit_rule"]["filling"] = $this->fillViewRule("delete");
    }

    function load_lang_files()
    {
        parent::load_lang_files(); // TODO: Change the autogenerated stub
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/models/modules/m_lang_model_users_".$_SESSION[JS_SAIK]["lang"].".php";
        return "m_lang_model_users_".$_SESSION[JS_SAIK]["lang"];
    }

    public function copyRecord(){
        $query_text="select ".$this->tableName.".*, users_dt.accLogin as createdLogin, ".
            "usersGroups_dt.groupAlias_".$_SESSION[JS_SAIK]["lang"]." as groupAlias from ".$this->tableName.
            " left join users_dt on usersToGroups_dt.created_by = users_dt.user_id ".
            " left join usersGroups_dt on usersGroups_dt.group_id = ".$this->tableName.".group_id ".
            " where ";
        foreach ($this->recordStructureFields->record as $fieldName=>$fieldInfo) {
            if (isset($fieldInfo["indexes"]) and $fieldInfo["indexes"] == true) {
                if($fieldInfo["use_table_name"]){
                    $query_text.=$fieldInfo["use_table_name"].".";
                }
                $query_text.=$fieldName."='".$fieldInfo["curVal"]."' and " ;
            }
        }
        $query_text = substr($query_text, 0, strlen($query_text)-4);

        $query_res = $this->query($query_text);

        if($query_res->rowCount()===1){
            $result=$query_res->fetch(PDO::FETCH_ASSOC);
            foreach ($this->recordStructureFields->record as $fieldName=>$fieldInfo) {
                $this->recordStructureFields->record[$fieldName]["curVal"] = $result[$fieldName];
                $this->recordStructureFields->record[$fieldName]["fetchVal"] = $result[$fieldName];
            }
            return true;
        }
        $this->log_message = "copyRecord fail";
        return false;
    }

    public function listRecords($where = null, $order = null, $limit = null, $having = null)
    {
        $findList_qry = "select ".
            $this->tableName.".group_id, ".
            $this->tableName.".user_id, ".
            $this->tableName.".read_rule, ".
            $this->tableName.".create_rule, ".
            $this->tableName.".edit_rule, ".
            $this->tableName.".delete_rule, ".
            $this->tableName.".created_by, ".
            $this->tableName.".send_ntf, ".
            "udtcreated.accLogin as createdLogin, ".
            "udtuser.accLogin as userLogin, ".
            "usersGroups_dt.groupAlias_".$_SESSION[JS_SAIK]["lang"]." as groupAlias ".
            "from ".$this->tableName." ".
            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id ".
            "left join users_dt udtuser on ".$this->tableName.".user_id = udtuser.user_id ".
            "inner join usersGroups_dt on usersGroups_dt.group_id = ".$this->tableName.".group_id ".
            $where.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }

    public function countRecords($where = null)
    {
        $countUsers_qry = "select count(*) as cnt ".
            "from ".$this->tableName." ".
            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id ".
            "left join users_dt udtuser on ".$this->tableName.".user_id = udtuser.user_id ".
            "inner join usersGroups_dt on usersGroups_dt.group_id = ".$this->tableName.".group_id ".
            $where;

        return $this->query($countUsers_qry)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }

    function fillUser_id()
    {
        if(isset($_GET["user_id"]) and !isset($_GET["group_id"])){
            $fillUsers_qry = "select users_dt.user_id, accLogin from users_dt where user_id='".$_GET["user_id"]."'";
        }elseif (isset($_GET["group_id"]) and !isset($_GET["user_id"])){
            $fillUsers_qry = "select users_dt.user_id, accLogin, ".$this->tableName.".group_id from users_dt ".
                "left join ".$this->tableName." on ".$this->tableName.".user_id = users_dt.user_id ".
                " and ".$this->tableName.".group_id = '".$_GET["group_id"]."' ".
                "where group_id is null ".
                "order by accLogin";
        }elseif (isset($_GET["group_id"]) and isset($_GET["user_id"])){
            $fillUsers_qry = "select users_dt.user_id, accLogin from users_dt where users_dt.user_id='".$_GET["user_id"]."'";
        }
        elseif (!isset($_GET["group_id"]) and !isset($_GET["user_id"])){
            $fillUsers_qry = "select users_dt.user_id, accLogin from users_dt";
        }

        $findUsers_res = $this->query($fillUsers_qry);
        $fillUsers_id = null;
        if($findUsers_res->rowCount()){
            while ($findUsers_row = $findUsers_res->fetch(PDO::FETCH_ASSOC)){
                $fillUsers_id[$findUsers_row["user_id"]] = $findUsers_row["accLogin"];
            }
        }else{
            $fillUsers_id[""] = "";
        }
        return $fillUsers_id;
    }

    function fillGroups_name()
    {
        if(isset($_GET["group_id"]) and !isset($_GET["user_id"])){
            $fillGroups_qry = "select usersGroups_dt.group_id, usersGroups_dt.groupAlias_".$_SESSION[JS_SAIK]["lang"]." as groupAlias from usersGroups_dt where group_id='".$_GET["group_id"]."'";
        }elseif (isset($_GET["user_id"]) and !isset($_GET["group_id"])) {

            $fillGroups_qry = "select usersGroups_dt.group_id, usersGroups_dt.groupAlias_".$_SESSION[JS_SAIK]["lang"].
                " as groupAlias, ".$this->tableName.".user_id from usersGroups_dt ".
                "left join ".$this->tableName." on ".$this->tableName.".group_id = usersGroups_dt.group_id ".
                " and ".$this->tableName.".user_id = '".$_GET["user_id"]."' ".
                "where user_id is null ".
                "order by usersGroups_dt.groupAlias_".$_SESSION[JS_SAIK]["lang"];
        }elseif(isset($_GET["group_id"]) and isset($_GET["user_id"])){

            $fillGroups_qry = "select usersGroups_dt.group_id, usersGroups_dt.groupAlias_".$_SESSION[JS_SAIK]["lang"]." as groupAlias from usersGroups_dt where group_id='".$_GET["group_id"]."'";

        }elseif(!isset($_GET["group_id"]) and !isset($_GET["user_id"])){
            $fillGroups_qry = "select usersGroups_dt.group_id, usersGroups_dt.groupAlias_".$_SESSION[JS_SAIK]["lang"]." as groupAlias from usersGroups_dt";
        }

        $fillGroups_res = $this->query($fillGroups_qry);
        $fillGroups_name = null;
        if($fillGroups_res->rowCount()){
            while ($fillGroups_row = $fillGroups_res->fetch(PDO::FETCH_ASSOC)){
                $fillGroups_name[$fillGroups_row["group_id"]] = $fillGroups_row["groupAlias"];
            }
        }else{
            $fillGroups_name[""] = "";
        }

        return $fillGroups_name;
    }

    function fillViewRule($type_of_rule = null)
    {

        if($type_of_rule == "read"){
            return array(
                ""=>"",
                "any" => $this->lang_map->rules["any"],
                "own" => $this->lang_map->rules["own"],
            );
        }elseif ($type_of_rule == "create"){
            return array(
                ""=>"",
                "enable" => $this->lang_map->rules["enable"],
                "disable" => $this->lang_map->rules["disable"],
            );
        }elseif ($type_of_rule == "edit"){
            return array(
                ""=>"",
                "any" => $this->lang_map->rules["any"],
                "own" => $this->lang_map->rules["own"],
                "forbidden" => $this->lang_map->rules["forbidden"],
            );
        }elseif ($type_of_rule == "delete"){
            return array(
                ""=>"",
                "any" => $this->lang_map->rules["any"],
                "own" => $this->lang_map->rules["own"],
                "forbidden" => $this->lang_map->rules["forbidden"],
            );
        }
    }
}