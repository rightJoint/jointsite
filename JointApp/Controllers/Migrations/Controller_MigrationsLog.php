<?php

namespace JointApp\Controllers\Migrations;

use JointApp\Controllers\Records\RecordsController;

class Controller_MigrationsLog extends RecordsController
{
    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Migrations_MigrationsList';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Migrations/'.$name.'.php';
        return $name;
    }

    public function prepareListFields():void
    {
        $this->listFields = Array
        (
            'btnDetail' => Array
            (
                'replaces' => Array('migration_log_id', ),
                'format' => 'link',
                'url' => 'migration_log_id=migration_log_id',
            ),
            'btnEdit' => Array
            (
                'replaces' => Array('migration_log_id', ),
                'format' => 'link',
                'url' => 'migration_log_id=migration_log_id',
            ),
            'btnDelete' => Array
            (
                'replaces' => Array('migration_log_id', ),
                'format' => 'link',
                'url' => 'migration_log_id=migration_log_id',
            ),
            'migration_log_id' => Array
            (
                'pri' => 1,
                'format' => 'varchar',
            ),
            'migration_name' => Array
            (
                'format' => 'varchar',
            ),
            'add_date' => Array
            (
                'format' => 'datetime',
            ),
        );
    }

    public function prepareViewEditFields(): void
    {
        $this->editFields = Array
        (
            'migration_log_id' => Array
            (
                'pri' => 1,
                'format' => 'varchar',
                'readonly' => true,
                'curVal' => '',
            ),
            'migration_name' => Array
            (
                'format' => 'varchar',
                'curVal' => '',
            ),

            'add_date' => Array
            (
                'format' => 'datetime',
                'curVal' => '',
            ),
            'migration_log' => Array
            (
                'format' => 'text',
                'curVal' => '',
            ),
        );
    }

    public function prepareViewFields(): void
    {
        $this->viewFields  = Array
        (
            'migration_log_id' => Array
            (
                'pri' => 1,
                'format' => 'varchar',
                'readonly' => 1,
            ),
            'migration_name' => Array
            (
                'format' => 'varchar',
                'readonly' => 1,
            ),
            'add_date' => Array
            (
                'format' => 'datetime',
                'readonly' => 1,
            ),
            'migration_log' => Array
            (
                'format' => 'JsonLog',
                'style'=> array(
                    'class'=>'wd100',
                ),
            ),
        );
    }

    public function prepareViewSearchFields(): void
    {
        $this->view->searchFields = Array
        (
            'add_date' => Array
            (
                'format' => 'datetime',
                'sort' => 1,
                'search' => 1,
                'sortOrder' => 'DESC',
            ),
            'migration_log_id' => Array
            (
                'pri' => 1,
                'format' => 'varchar',
                'sort' => 1,
                'search' => 1,
                'sortOrder' => 'DESC',
            ),
            'migration_name' => Array
            (
                'format' => 'varchar',
                'sort' => 1,
                'search' => 1,
            ),
        );
    }
}