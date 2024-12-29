<?php

namespace JointApp\Models\Migrations;

use JointApp\Models\Records\RecordsModel;

class Model_MigrationsLog extends RecordsModel
{
    public string $tableName = "migrations_log";

    function getRecordStructure()
    {
        $this->record = Array
        (
            "migration_log_id" => Array
            (
                "pri" => 1,
                "format" => "varchar",
                'custom' => false,
            ),
            "migration_name" => Array
            (
                "format" => "varchar",
                'custom' => false,
            ),

            "add_date" => Array
            (
                "format" => "datetime",
                'custom' => false,
            ),

            "migration_log" => Array
            (
                "format" => "text",
                'custom' => false,
            ),
        );
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