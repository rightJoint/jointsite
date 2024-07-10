<?php
class m_model_users extends ModuleModel
{

    public $tableName = "users_dt";
    public $modelAliases = array(
        "en" => "Users list",
        "rus" => "Список пользователей",
    );

    public $module_name = "users";

    function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/modules/users/m_rsf_users.php";
        $this->recordStructureFields = new m_rsf_users();
    }

    function load_lang_files()
    {
        parent::load_lang_files();
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/models/modules/m_lang_model_users_".$_SESSION[JS_SAIK]["lang"].".php";
        return "m_lang_model_users_".$_SESSION[JS_SAIK]["lang"];
    }

    public function listRecords($where = null, $order = null, $limit = null, $having = NULL)
    {
        $findList_qry = "select ".
            $this->tableName.".user_id, ".
            $this->tableName.".accLogin, ".
            $this->tableName.".accAlias, ".
            $this->tableName.".pw_hash, ".
            $this->tableName.".vldCode, ".
            $this->tableName.".regDate, ".
            $this->tableName.".netWork, ".
            $this->tableName.".validDate, ".
            $this->tableName.".photoLink, ".
            $this->tableName.".eMail, ".
            $this->tableName.".birthDay, ".
            $this->tableName.".socProf, ".
            $this->tableName.".blackList, ".
            $this->tableName.".created_by, ".
            $this->tableName.".send_ntf, ".
            $this->tableName.".is_admin, ".
            "udtcreated.accLogin as createdLogin ".
            "from ".$this->tableName." ".
            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id ".
            $where.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }

    function copyCustomFields()
    {
        $createdLogin_qry = "select accLogin from users_dt where user_id='".$this->recordStructureFields->record["created_by"]["curVal"]."'";
        $createdLogin_res = $this->query($createdLogin_qry);
        if($createdLogin_res->rowCount()===1){
            $createdLogin_row = $createdLogin_res->fetch(PDO::FETCH_ASSOC);
            $this->recordStructureFields->record["createdLogin"]["curVal"] = $createdLogin_row["accLogin"];
            return true;
        }
        return true;
    }

    function fillNetworkSelect()
    {
        return array("site" => $this->lang_map->network_select["site"]);
    }
}