<?php


namespace JointApp\Models\Components;


use JointApp\Models\ModuleModel;
use JointApp\JointAppQueryBuilder;

class Model_Components_BlogComments extends ModuleModel
{
    public string $tableName = 'blogComments';

    public string $moduleName = 'blogcomments';

    const ART_COVERS = '/userdata/blog/covers';

    public function getRecordStructure()
    {

        $this->record = array(
            'comment_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'custom' => false,
            ),
            'commentP_id' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'art_id' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'content' => array(
                'format' => 'text',
                'custom' => false,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'addDate' => array(
                'format' => 'datetime',
                'custom' => false,
            ),
        );

    }

    public function listRecords(JointAppQueryBuilder $qBuilder): array
    {

        $qBuilder = $this->createdByListWhere($qBuilder);


        $qBuilder->select(
            $this->tableName.'.comment_id, '.
            $this->tableName.'.commentP_id, '.
            $this->tableName.'.art_id, '.
            //$this->tableName.'.content, '.
            $this->tableName.'.created_by, '.
            $this->tableName.'.activeFlag, '.
            $this->tableName.'.addDate, '.
            'users_dt.accAlias, '.
            'blogArts.artName_'.$this->langLw.' as artName'
        )
            ->from($this->tableName)
            ->join(
                'inner join users_dt on '.$this->tableName.'.created_by = users_dt.user_id '.
                'inner join blogArts on blogArts.art_id = '.$this->tableName.'.art_id'
            );

        return $this->checkListButtons($this->fetchToArray($qBuilder->buildQuery()));
    }

    //cause have having field
    public function countRecords(JointAppQueryBuilder $qBuilder): int
    {
        $qBuilder
            ->select($this->tableName.'.comment_id, '.
                'blogArts.artName_'.$this->langLw.' as artName, '.
                'users_dt.accAlias'
            )
            ->from($this->tableName)
            ->join(
                'inner join users_dt on '.$this->tableName.'.created_by = users_dt.user_id '.
                'inner join blogArts on blogArts.art_id = '.$this->tableName.'.art_id'
            );

        if($res = $this->pdoQuery($qBuilder->buildQuery())){
            return $res->rowCount();
        }

        return 0;
    }
}