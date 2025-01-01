<?php


namespace JointApp\Models\Components;


use JointApp\Models\ModuleModel;

class Model_Components_MusicTracks extends ModuleModel
{
    public string $moduleName = 'musictracks';
    public string $tableName = 'musictracks';

    public function getRecordStructure()
    {
        $this->record = array(
            'track_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'custom' => false,
            ),
            'track_name' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'track_artist' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'track_file' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'loadDate' => array(
                'format' => 'date',
                'custom' => false,
            ),
            'sortDate' => array(
                'format' => 'date',
                'custom' => false,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
        );
    }
}