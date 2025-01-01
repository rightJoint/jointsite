<?php


namespace JointApp\Models\Components;


use JointApp\Models\ModuleModel;
use JointApp\Models\Records\RecordsModel;

class Model_Components_MusicAlb extends ModuleModel
{
    public string $tableName = 'musicAlb';
    public string $moduleName = 'musicalb';

    public function getRecordStructure()
    {
        $this->record = array(
            'album_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'custom' => false,
            ),
            'albumName' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'albumAlias' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'metaDescr' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'dateOfCr' => array(
                'format' => 'date',
                'custom' => false,
            ),
            'albumImg' => array(
                'format' => 'file',
                'file_options' => array(
                    'accept' => '.jpg, .jpeg, .bmp, .git, .png',
                    'load_dir' => '/ddd-test/albCovers/albumImg',
                    'replaces' => ['albumImg'],
                ),
                'custom' => false,
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'refreshDate' => array(
                'format' => 'date',
                'custom' => false,
            ),
            'robIndex' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
        );
    }
}