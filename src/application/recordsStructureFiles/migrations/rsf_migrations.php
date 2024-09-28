<?php
class rsf_migrations extends recordStructureFields
{

    function __construct()
    {
        $this->record["add_date"]["curVal"] = date("Y-m-d H:i:s");
    }

    public $record = Array
    (
        "migration_name" => Array
        (
            "indexes" => 1,
            "format" => "varchar",
        ),
        "status" => Array
        (
            "format" => "varchar",
            "curVal" => "new",
        ),

        "try_date" => Array
        (
            "format" => "datetime",
        ),

        "add_date" => Array
        (
            "format" => "datetime",
        ),

        "migr_file" => Array
        (
            "format" => "tinyint",
        ),
    );
    public $editFields = Array
    (
        "migration_name" => Array
        (
            "indexes" => 1,
            "format" => "varchar",
            "readonly" => true,
        ),
        "status" => Array
        (
            "format" => "varchar",
        ),

        "try_date" => Array
        (
            "format" => "datetime",
        ),

        "add_date" => Array
        (
            "format" => "datetime",
        ),

        "migr_file" => Array
        (
            "format" => "tinyint",
        ),
    );
    public $listFields = Array
    (
        "btnDetail" => Array
        (
            "replaces" => Array("migration_name", ),
            "format" => "link",
            "url" => "migration_name=migration_name",
        ),

        "btnEdit" => Array
        (
            "replaces" => Array("migration_name", ),
            "format" => "link",
            "url" => "migration_name=migration_name",
        ),

        "btnDelete" => Array
        (
            "replaces" => Array("migration_name", ),
            "format" => "link",
            "url" => "migration_name=migration_name",
        ),
        "migration_name" => Array
        (
            "indexes" => 1,
            "format" => "link",
            "replaces" => Array("migration_name", ),
            "url" => JOINT_SITE_APP_REF."/test/migrationstest/migrationsLog?migration_name=migration_name",
        ),
        "status" => Array
        (
            "format" => "varchar",
        ),

        "try_date" => Array
        (
            "format" => "datetime",
        ),

        "add_date" => Array
        (
            "format" => "datetime",
        ),

        "migr_file" => Array
        (
            "format" => "tinyint",
        ),
    );
    public $searchFields = Array
    (
        "migration_name" => Array
        (
            "indexes" => 1,
            "format" => "varchar",
            "sort" => 1,
            "search" => 1,
            "sortOrder" => "DESC",
        ),
        "status" => Array
        (
            "format" => "varchar",
            "sort" => 1,
            "search" => 1,
        ),

        "try_date" => Array
        (
            "format" => "datetime",
            "sort" => 1,
            "search" => 1,
        ),

        "add_date" => Array
        (
            "format" => "datetime",
            "sort" => 1,
            "search" => 1,
        ),

        "migr_file" => Array
        (
            "format" => "tinyint",
            "sort" => 1,
            "search" => 1,
        ),
    );
    public $viewFields = Array
    (
        "migration_name" => Array
        (
            "indexes" => 1,
            "format" => "varchar",
            "readonly" => 1,
        ),
        "status" => Array
        (
            "format" => "varchar",
            "readonly" => 1,
        ),

        "try_date" => Array
        (
            "format" => "datetime",
            "readonly" => 1,
        ),

        "add_date" => Array
        (
            "format" => "datetime",
            "readonly" => 1,
        ),
    );
}