<?php
class rsf_migrations extends recordStructureFields
{
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
        "content" => Array
        (
            "format" => "text",
            "use_table_name" => "non-db",
        ),
        /*
        "show_name" => Array
        (
            "format" => "varchar",
            "use_table_name" => "non-db",
        ),*/
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
            "format" => "varchar",
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