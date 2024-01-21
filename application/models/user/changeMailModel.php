<?php
class changeMailModel extends Model_User
{

    function getRecordStructure()
    {
        $this->record = array(
            "eMail" => array(
                "format" => "varchar",
            )
        );

        $this->editFields = array(
            "eMail" => array(
                "format" => "varchar",
            )
        );
    }


    function copyRecord()
    {
        $eMail_qry = "select eMail from users_dt where user_id='".$_SESSION["site_user"]["user_id"]."'";
        $eMail_res = $this->query($eMail_qry);
        $eMail_row = $eMail_res->fetch(PDO::FETCH_ASSOC);

        $this->record["eMail"]["curVal"] = $eMail_row["eMail"];
        $this->record["eMail"]["fetchVal"] = $eMail_row["eMail"];

        return true;
    }

    function updateRecord()
    {
        $eMail_qry = "update users_dt set eMail='".$this->record["eMail"]["curVal"]."' where user_id='".$_SESSION["site_user"]["user_id"]."'";
        $this->query($eMail_qry);
        $this->record["eMail"]["fetchVal"] = $this->record["eMail"]["curVal"];

        return true;
    }
}