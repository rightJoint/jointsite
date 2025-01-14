<?php

class LangFiles_En_Controller_Migrations_MigrationsList extends LangFiles_En_Controller_Records
{
    public $fieldAliases = [];

    public function __construct()
    {
        $this->fieldAliases = array(
            'migration_log_id' => 'лог_ид',
            'migration_name' => 'Имя',
            'add_date' => 'Добавлена',
            'migration_log' => 'Логи',
        );
    }


}