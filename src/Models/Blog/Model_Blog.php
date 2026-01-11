<?php


namespace Src\Models\Blog;


use JointApp\JointAppQueryBuilder;
use JointApp\Models\Records\RecordsModel;

class Model_Blog extends RecordsModel
{
    public string $tableName = 'blogArts';

    const ART_COVERS = '/userdata/blog/covers';

    public function getRecordStructure()
    {
        $this->record = array(
            'art_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'custom' => false,
            ),
            'artCat' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'artRef' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'artName_en' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'artName_ru' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'artMeta_en' => array(
                'format' => 'text',
                'custom' => false,
            ),
            'artMeta_ru' => array(
                'format' => 'text',
                'custom' => false,
            ),
            'artImg' => array(
                'format' => 'file',
                'file_options' => array(
                    'accept' => '.jpg, .jpeg, .bmp, .git, .png',
                    'load_dir' => self::ART_COVERS.'/artImg',
                    'replaces' => ['artImg'],
                ),
                'custom' => false,
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'indexFlag' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'popFlag' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'pubDate' => array(
                'format' => 'date',
                'custom' => false,
            ),
            'refreshDate' => array(
                'format' => 'date',
                'custom' => false,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
        );
    }

    public function listRecords(JointAppQueryBuilder $qBuilder): array
    {
        $qBuilder->select(
            $this->tableName.'.art_id, '.
            $this->tableName.'.artCat, '.
            $this->tableName.'.artRef, '.
            $this->tableName.'.artName_'.$this->langLw.' as artName, '.
            $this->tableName.'.artMeta_'.$this->langLw.' as artMeta, '.
            $this->tableName.'.artImg, '.
            $this->tableName.'.activeFlag, '.
            $this->tableName.'.popFlag, '.
            $this->tableName.'.pubDate, '.
            $this->tableName.'.refreshDate, '.
            $this->tableName.'.created_by'
        )
            ->from($this->tableName)
            ->where('artRef not in ("censored", "looking-for-php-fullstack-job-in-2025", 
        "test-task-alvasar", "polygraph-exam", "right-joint-updated")');

        return $this->fetchToArray($qBuilder->buildQuery());
    }

    public function countRecords(JointAppQueryBuilder $qBuilder):int
    {
        $qBuilder
            ->select($this->tableName.'.artName_'.$this->langLw.' as artName ')
            ->from($this->tableName);

        if($res = $this->pdoQuery($qBuilder->buildQuery())){
            return $res->rowCount();
        }

        return 0;
    }
}