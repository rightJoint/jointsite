<?php


namespace JointApp\Models\Components;


use JointApp\Models\ModuleModel;
use JointApp\JointAppQueryBuilder;

class Model_Components_MusicAlb extends ModuleModel
{
    public string $tableName = 'musicAlb';
    public string $moduleName = 'musicalb';

    const MUSIC_ALB_DIR = '/userdata/music/covers';

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
                    'load_dir' => self::MUSIC_ALB_DIR.'/albumImg',
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
            'accAlias' => array(
                'format' => 'varchar',
                'curVal' => '',
                'custom' => true,
            ),
        );
    }

    public function listRecords(JointAppQueryBuilder $qBuilder): array
    {
        $qBuilder->select = $this->tableName.'.album_id, '.$this->tableName.'.albumName, '.
            $this->tableName.'.albumAlias, '.$this->tableName.'.dateOfCr, '.$this->tableName.'.albumImg, '.
            $this->tableName.'.activeFlag, '.$this->tableName.'.refreshDate, '.$this->tableName.'.robIndex, '.
            'users_dt.accAlias ';
        $qBuilder
            ->from($this->tableName)
            ->join('left join users_dt on '.$this->tableName.'.created_by = users_dt.user_id');
        return $this->fetchToArray($qBuilder->buildQuery());
    }

    public function copyCustomFields(): bool
    {
        $findCreatedAlias_qry = 'select accAlias from users_dt where created_by="'.$this->record['created_by']['curVal'].'"';
        $findCreatedAlias_arr = $this->fetchToArray($findCreatedAlias_qry);
        if(count($findCreatedAlias_arr)){
            $this->record['accAlias']['curVal'] = $findCreatedAlias_arr[0]['accAlias'];
        }
        return true;
    }
}