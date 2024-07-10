<?php
class m_model_groups extends ModuleModel
{
    public $tableName = "usersGroups_dt";
    public $modelAliases = array(
        "en" => "Access groups",
        "rus" => "Группы доступа",
    );
    public $module_name = "groups";

    function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/modules/groups/m_rsf_groups.php";
        $this->recordStructureFields = new m_rsf_groups();
    }

    public function listRecords($where = null, $order = null, $limit = null, $having = NULL)
    {

        $findList_qry = "select ".
            "group_id, ".
            "groupAlias_en, ".
            "groupAlias_rus, ".
            "activeFlag, ".
            "usersGroups_dt.created_by, ".
            "users_dt.accAlias ".
            "from ".$this->tableName." ".
            "left join users_dt on usersGroups_dt.created_by = users_dt.user_id ".
            $where.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }

    public function countRecords($where = null)
    {
        return $this->query("select count(*) as cnt from ".$this->tableName." ".
            "left join users_dt on usersGroups_dt.created_by = users_dt.user_id ".
            $where)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }

    public function copyRecord(){
        $query_text="select ".$this->tableName.".*, users_dt.accAlias from ".$this->tableName.
            " left join users_dt on usersGroups_dt.created_by = users_dt.user_id ".
            " where ";
        foreach ($this->recordStructureFields->record as $fieldName=>$fieldInfo) {
            if (isset($fieldInfo["indexes"]) and $fieldInfo["indexes"] == true) {
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
}