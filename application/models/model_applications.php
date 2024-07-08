<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/core/RecordsModel.php";
class model_applications extends RecordsModel
{
    public $tableName = "applList_dt";

    function checkUserEmail()
    {
        if (filter_var($this->recordStructureFields->record["clientMail"]["curVal"], FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }
    public function checkClientName()
    {
        if (preg_match('/^[a-zа-я]{1}[0-9a-zа-я-._ ]{2,15}$/imsiu', $this->recordStructureFields->record["clientName"]["curVal"]) == 0){
            return false;
        }
        return true;
    }
}