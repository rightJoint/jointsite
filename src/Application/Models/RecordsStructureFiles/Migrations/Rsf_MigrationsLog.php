<?php

namespace JointSite\Models\RecordsStructureFiles\Migrations;

use JointSite\Models\RecordsStructureFiles\RecordStructureFields;

class Rsf_MigrationsLog extends RecordStructureFields
{
    public $record = Array
    (
        "migration_log_id" => Array
        (
            "indexes" => 1,
            "format" => "varchar",
        ),
        "migration_name" => Array
        (
            "format" => "varchar",
        ),

        "add_date" => Array
        (
            "format" => "datetime",
        ),

        "migration_log" => Array
        (
            "format" => "text",
        ),
    );
    public $editFields = Array
    (
        "migration_log_id" => Array
        (
            "indexes" => 1,
            "format" => "varchar",
            "readonly" => true,
        ),
        "migration_name" => Array
        (
            "format" => "varchar",
        ),

        "add_date" => Array
        (
            "format" => "datetime",
        ),

        "migration_log" => Array
        (
            "format" => "text",
        ),
    );
    public $listFields = Array
    (
        "btnDetail" => Array
        (
            "replaces" => Array("migration_log_id", ),
            "format" => "link",
            "url" => "migration_log_id=migration_log_id",
        ),

        "btnDelete" => Array
        (
            "replaces" => Array("migration_log_id", ),
            "format" => "link",
            "url" => "migration_log_id=migration_log_id",
        ),
        "migration_log_id" => Array
        (
            "indexes" => 1,
            "format" => "varchar",
        ),
        "migration_name" => Array
        (
            "format" => "varchar",
        ),

        "add_date" => Array
        (
            "format" => "datetime",
        ),
    );
    public $searchFields = Array
    (
        "add_date" => Array
        (
            "format" => "datetime",
            "sort" => 1,
            "search" => 1,
            "sortOrder" => "desc",
        ),
        "migration_log_id" => Array
        (
            "indexes" => 1,
            "format" => "varchar",
            "sort" => 1,
            "search" => 1,
            "sortOrder" => "DESC",
        ),
        "migration_name" => Array
        (
            "format" => "varchar",
            "sort" => 1,
            "search" => 1,
        ),
    );
    public $viewFields = Array
    (
        "migration_log_id" => Array
        (
            "indexes" => 1,
            "format" => "varchar",
            "readonly" => 1,
        ),
        "migration_name" => Array
        (
            "format" => "varchar",
            "readonly" => 1,
        ),
        "add_date" => Array
        (
            "format" => "datetime",
            "readonly" => 1,
        ),
        "migration_log_html" => Array
        (
            "format" => "log_html",
        ),
    );
}