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

    function filterWhere($method = "POST", $REQ_ARR = null)
    {
        $return_where = parent::filterWhere($method, $REQ_ARR);
        if(isset($_GET["migration_name"])){
            if($return_where["where"]){
                $return_where["where"].=" and migrations_log.migration_name='".$_GET["migration_name"]."'";
            }else{
                $return_where["where"].="where migrations_log.migration_name='".$_GET["migration_name"]."'";
            }
        }
        return $return_where;
    }

}