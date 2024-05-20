<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/core/RecordsModel.php";
class model_migrations_log extends RecordsModel
{
    public $tableName = "migrations_log";

    function getRecordStructure()
    {

        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/migrations/rsf_migrations_log.php";
        $this->recordStructureFields = new  rsf_migrations_log();
    }


}