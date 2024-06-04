<?php
class m_model_ntflist extends ModuleModel
{
    public $tableName = "ntfList_dt";
    public $modelAliases = array(
        "en" => "Notification list",
        "rus" => "Список уведомлений",
    );

    function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/modules/notifications/rsf_notifications_list.php";
        $this->recordStructureFields = new rsf_notifications_list();
        $this->recordStructureFields->editFields["template_id"]["filling"] = $this->fillTemplateId();
        $this->recordStructureFields->viewFields["template_id"]["filling"] = $this->fillTemplateId();
    }

    function fillTemplateId()
    {
        $fill_qry = "select template_id, tName from ntfTemplates_dt order by tName";
        $fill_res = $this->query($fill_qry);
        $fill_return = array("" => "",);
        if($fill_res->rowCount()){
            while($fill_row = $fill_res->fetch(PDO::FETCH_ASSOC)){
                $fill_return[$fill_row["template_id"]] = $fill_row["tName"];
            }
        }
        return $fill_return;
    }

    function countRecords($where = null)
    {
        $countList_qry = "select count(".
            $this->tableName.".ntf_id) as cnt ".
            "from ".$this->tableName." ".
            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id ".
            "left join ntfTemplates_dt on ntfTemplates_dt.template_id = ".$this->tableName.".template_id ";
        return $this->query($countList_qry." ".$where)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }

    function copyCustomFields()
    {
        $findUType_qry = "(select user_id as utype_id, accAlias as uName from users_dt where user_id = '".$this->recordStructureFields->record["type_id"]["curVal"]."') union ".
            "(select group_id as utype_id, groupAlias_en as uName from usersGroups_dt where group_id = '".$this->recordStructureFields->record["type_id"]["curVal"]."')";

        $findUType_res = $this->query($findUType_qry);
        if($findUType_res->rowCount() == 1){
            $this->recordStructureFields->record["uName"]["curVal"] = $findUType_res->fetch(self::FETCH_ASSOC)["uName"];
        }else{
            $this->recordStructureFields->record["uName"]["curVal"] = "";
        }

        $findUCreated_qry = "select user_id, accAlias from users_dt where user_id = '".$this->recordStructureFields->record["created_by"]["curVal"]."'";
        $findUCreated_res = $this->query($findUCreated_qry);
        if($findUCreated_res->rowCount() == 1){
            $this->recordStructureFields->record["createdLogin"]["curVal"] = $findUCreated_res->fetch(self::FETCH_ASSOC)["accAlias"];
        }else{
            $this->recordStructureFields->record["createdLogin"]["curVal"] = "";
        }
        return true;
    }

    public function listRecords($where = null, $order = null, $limit = null, $having = NULL)
    {
        $findList_qry = "select ".
            $this->tableName.".ntf_id, ".
            $this->tableName.".template_id, ".
            $this->tableName.".subscriber_type, ".
            $this->tableName.".type_id, ".
            $this->tableName.".add_date, ".
            $this->tableName.".template_params, ".
            $this->tableName.".send_params, ".
            $this->tableName.".send_date, ".
            $this->tableName.".created_by, ".
            $this->tableName.".send_res, ".
            $this->tableName.".send_log, ".
            "udtcreated.accAlias as createdLogin, ".
            "ntfTemplates_dt.tName, ".
            "unionId.uName as uName ".
            "from ".$this->tableName." ".
            "left join ((select user_id as utype_id, accAlias as uName from users_dt) union (select group_id as utype_id, groupAlias_en as uName from usersGroups_dt) ) unionId ".
            "on ".$this->tableName.".type_id = unionId.utype_id ".


            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id ".
            "left join ntfTemplates_dt on ntfTemplates_dt.template_id = ".$this->tableName.".template_id ".
            $where.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }


}