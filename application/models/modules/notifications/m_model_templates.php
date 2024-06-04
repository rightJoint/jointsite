<?php
class m_model_templates extends ModuleModel
{
    public $tableName = "ntfTemplates_dt";
    public $modelAliases = array(
        "en" => "eMail templates",
        "rus" => "Шаблоны уведомлений",
    );

    function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/modules/notifications/rsf_notifications_templates.php";
        $this->recordStructureFields = new rsf_notifications_templates();
    }

    function countRecords($where = null)
    {
        $countList_qry = "select count(".
            $this->tableName.".template_id) as cnt ".
            "from ".$this->tableName." ".
            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id";
        return $this->query($countList_qry." ".$where)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }


    public function listRecords($where = null, $order = null, $limit = null, $having = NULL)
    {
        $findList_qry = "select ".
            $this->tableName.".template_id, ".
            $this->tableName.".tName, ".
            $this->tableName.".tHeader_en, ".
            $this->tableName.".tHeader_rus, ".
            $this->tableName.".tBody_en, ".
            $this->tableName.".tBody_rus, ".
            $this->tableName.".date_created, ".
            $this->tableName.".created_by, ".
            "udtcreated.accLogin as createdLogin ".
            "from ".$this->tableName." ".
            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id ".
            $where.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }

    public function copyRecord()
    {
        if(parent::copyRecord()){
            $createdLogin_qry = "select accLogin from users_dt where user_id='".$this->recordStructureFields->record["created_by"]["curVal"]."'";
            $createdLogin_res = $this->query($createdLogin_qry);
            if($createdLogin_res->rowCount()===1){
                $createdLogin_row = $createdLogin_res->fetch(PDO::FETCH_ASSOC);
                $this->recordStructureFields->record["createdLogin"]["curVal"] = $createdLogin_row["accLogin"];
                return true;
            }
            return true;
        }else{
            return false;
        }
    }
}