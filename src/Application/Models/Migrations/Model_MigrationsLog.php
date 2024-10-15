<?php

namespace JointSite\Models\Migrations;

use JointSite\Core\Records\RecordsModel;
use JointSite\Models\RecordsStructureFiles\Migrations\Rsf_MigrationsLog;

class Model_MigrationsLog extends RecordsModel
{
    public $tableName = "migrations_log";

    function getRecordStructure()
    {
        //require_once JOINT_SITE_REQUIRE_DIR."/application/recordsStructureFiles/migrations/rsf_migrations_log.php";
        $this->recordStructureFields = new  Rsf_MigrationsLog();
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