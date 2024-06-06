<?php
class model_user_email extends Model_User
{

    function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/user/rsf_user_changeMail.php";
        $this->recordStructureFields = new rsf_user_changeMail();
    }


    function copyRecord()
    {
        $eMail_qry = "select eMail from users_dt where user_id='".$_SESSION[JS_SAIK]["site_user"]["user_id"]."'";
        $eMail_res = $this->query($eMail_qry);
        $eMail_row = $eMail_res->fetch(PDO::FETCH_ASSOC);

        $this->recordStructureFields->record["eMail"]["curVal"] = $eMail_row["eMail"];
        $this->recordStructureFields->record["eMail"]["fetchVal"] = $eMail_row["eMail"];

        return true;
    }

    function updateRecord()
    {
        $eMail_qry = "update users_dt set eMail='".$this->recordStructureFields->record["eMail"]["curVal"]."' ".
            "where user_id='".$_SESSION[JS_SAIK]["site_user"]["user_id"]."'";
        $this->query($eMail_qry);
        $this->recordStructureFields->record["eMail"]["fetchVal"] = $this->recordStructureFields->record["eMail"]["curVal"];

        return true;
    }
}