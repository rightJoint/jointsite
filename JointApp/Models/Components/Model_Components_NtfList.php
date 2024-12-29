<?php


namespace JointApp\Models\Components;


use JointApp\Models\ModuleModel;
use JointApp\Models\Records\RecordsModel;

class Model_Components_NtfList extends ModuleModel
{
    public string $tableName = 'ntfList_dt';
    public string $moduleName = 'ntflist';

    public function getRecordStructure()
    {
        $this->record = array(
            'ntf_id' => array(
                'pri' => true,
                'format' => 'varchar',
                'custom' => false,
            ),
            'template_id' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'subscriber_type' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'type_id' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'add_date' => array(
                'format' => 'datetime',
                'custom' => false,
            ),
            'template_params' => array(
                'format' => 'text',
                'custom' => false,
            ),
            'send_params' => array(
                'format' => 'text',
                'custom' => false,
            ),
            'send_date' => array(
                'format' => 'datetime',
                'custom' => false,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'send_res' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'send_log' => array(
                'format' => 'text',
                'custom' => false,
            ),
        );
    }
}