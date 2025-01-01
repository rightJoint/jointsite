<?php


namespace JointApp\Models\Components;


use JointApp\Models\ModuleModel;

class Model_Components_MusicTracks extends ModuleModel
{
    public string $moduleName = 'musictracks';
    public string $tableName = 'musicTracks';

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
                'format' => 'file',
                'custom' => false,
                'file_options' => array(
                    'accept' => 'mp3',
                    'load_dir' => '/ddd-test/tracks/track_file',
                    'replaces' => ['track_file'],
                ),
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
            'created_alias' => array(
                'format' => 'varchar',
                'custom' => true,
            ),
        );
    }

    public function copyCustomFields(): bool
    {
        $findCreatedAlias_qry = 'select accAlias from users_dt where created_by="'.$this->record['created_by']['curVal'].'"';
        $findCreatedAlias_arr = $this->fetchToArray($findCreatedAlias_qry);
        if(count($findCreatedAlias_arr)){
            $this->record['created_alias']['curVal'] = $findCreatedAlias_arr[0]['accAlias'];
        }
        return true;
    }
}