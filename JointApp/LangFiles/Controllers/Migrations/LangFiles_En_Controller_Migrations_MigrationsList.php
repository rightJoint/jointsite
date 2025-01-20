<?php

class LangFiles_En_Controller_Migrations_MigrationsList extends LangFiles_En_Controller_Records
{
    public $fieldAliases = [];

    public function __construct()
    {
        $this->fieldAliases = array(
            'migration_log_id' => 'log_id',
            'migration_name' => 'm. name',
            'add_date' => 'add date',
            'migration_log' => 'logs',
        );
    }


}