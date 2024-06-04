<?php
class m_model_ntfusers extends RecordsModel
{
    public $tableName = "ntfRead_dt";
    public $modelAliases = array(
        "en" => "Users notifications",
        "rus" => "Уведомления пользователей",
    );

    function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/modules/notifications/rsf_notifications_users.php";
        $this->recordStructureFields = new rsf_notifications_users();
    }

    function copyCustomFields()
    {
        $ntfList_qry = "select * from ntfList_dt where ntf_id='".$this->recordStructureFields->record["ntf_id"]["curVal"]."'";
        $ntfList_res = $this->query($ntfList_qry);
        if($ntfList_res->rowCount() === 1){
            $ntfList_row = $ntfList_res->fetch(PDO::FETCH_ASSOC);
            $template_qry = "select * from ntfTemplates_dt where template_id = '".$ntfList_row["template_id"]."'";
            $template_res = $this->query($template_qry);

            if($template_res->rowCount() == 1){
                $template_row = $template_res->fetch(PDO::FETCH_ASSOC);
                $this->recordStructureFields->record["tHeader"]["curVal"] = $template_row["tHeader_".$_SESSION[JS_SAIK]["lang"]];
                $template_params = json_decode($ntfList_row["template_params"], true);
                $replaced_text = $template_row["tBody_".$_SESSION[JS_SAIK]["lang"]];

                if($template_params){
                    foreach ($template_params as $tp_key => $tp_val){
                        $replaced_text = str_replace("$^".$tp_key, $tp_val, $replaced_text);
                    }
                }

                $this->recordStructureFields->record["tBody"]["curVal"] = $replaced_text;
            }else{

            }
        }
        return true;
    }


    function countRecords($where = null)
    {
        $countList_qry = "select count(".
            $this->tableName.".ntf_id) as cnt ".
            "from ".$this->tableName." ".
            "inner join users_dt on ".$this->tableName.".user_id = users_dt.user_id ".
            "inner join ntfList_dt on ntfList_dt.ntf_id = ".$this->tableName.".ntf_id ".
            "inner join ntfTemplates_dt on ntfTemplates_dt.template_id = ntfList_dt.template_id ";

        return $this->query($countList_qry." ".$where)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }

    public function listRecords($where = null, $order = null, $limit = null, $having = NULL)
    {
        $findList_qry = "select ".
            $this->tableName.".ntf_id, ".
            $this->tableName.".user_id, ".
            $this->tableName.".read_date, ".
            $this->tableName.".put_date, ".
            $this->tableName.".send_flag, ".
            $this->tableName.".del_flag, ".
            "users_dt.accAlias as accAlias, ".
            "ntfList_dt.subscriber_type, ".
            "ntfTemplates_dt.tName, ".
            "ntfTemplates_dt.tHeader_en ".
            "from ".$this->tableName." ".
            "inner join users_dt on ".$this->tableName.".user_id = users_dt.user_id ".
            "inner join ntfList_dt on ntfList_dt.ntf_id = ".$this->tableName.".ntf_id ".
            "inner join ntfTemplates_dt on ntfTemplates_dt.template_id = ntfList_dt.template_id ".
            $where.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }
}