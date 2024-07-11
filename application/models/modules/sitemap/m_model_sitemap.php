<?php

//require_once "application/recordsStructureFiles/siteman/sitemap/rsf_siteman_sitemap.php";
class m_model_sitemap extends ModuleModel
{
    public $tableName = "siteMap_dt";
    public $modelAliases = array(
        "en" => "Site map",
        "rus" => "Карта сайта",
    );

    public $module_name = "sitemap";

    function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/modules/sitemap/m_rsf_sitemap.php";
        $this->recordStructureFields = new m_rsf_sitemap();
        $this->recordStructureFields->listFields["changefreq"]["filling"] =
        $this->recordStructureFields->searchFields["changefreq"]["filling"] =
        $this->recordStructureFields->editFields["changefreq"]["filling"] = $this->fillChangefreq("y");
    }

    public function listRecords($where = null, $order = null, $limit = null, $having = null)
    {
        $findList_qry = "select ".
            $this->tableName.".maploc, ".
            $this->tableName.".lastmod, ".
            $this->tableName.".changefreq, ".
            $this->tableName.".priority, ".
            $this->tableName.".comment, ".
            $this->tableName.".use_flag, ".
            $this->tableName.".date_created, ".
            $this->tableName.".created_by, ".
            "udtcreated.accLogin as createdLogin ".
            "from ".$this->tableName." ".
            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id ".
            $where.$order;

        return $this->query($findList_qry);
    }

    function countRecords($where = null)
    {
        $countList_qry = "select count(".
            $this->tableName.".maploc) as cnt ".
            "from ".$this->tableName." ".
            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id ";

        if($where){
            $where=" where ".$where;
        }

        return $this->query($countList_qry." ".$where)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }

    function copyCustomFields()
    {
        $findUType_qry = "select accLogin as createdLogin from users_dt where user_id = '".$this->recordStructureFields->record["created_by"]["curVal"]."'";
        $findUType_res = $this->query($findUType_qry);
        if($findUType_res->rowCount() == 1){
            $this->recordStructureFields->record["createdLogin"]["curVal"] = $findUType_res->fetch(self::FETCH_ASSOC)["createdLogin"];
        }else{
            $this->recordStructureFields->record["createdLogin"]["curVal"] = "";
        }
        return true;
    }

    function fillChangefreq($nullVall = "n")
    {
        $return_arr = null;
        if($nullVall == "y"){
            $return_arr[""] = "";
        }

        $return_arr["monthly"] = "Ежемесячно";
        $return_arr["weekly"] = "Еженедельно";
        $return_arr["daily"] = "Ежедневно";
        $return_arr["always"] = "Всегда";
        $return_arr["hourly"] = "Ежечасно";
        $return_arr["yearly"] = "Ежегодно";
        $return_arr["never"] = "Никогда";
        return $return_arr;
    }

}