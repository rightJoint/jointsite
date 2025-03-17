<?php


namespace Src\Models\Blog;


use JointApp\JointAppQueryBuilder;
use JointApp\Models\Records\RecordsModel;

class Model_Blog_Comments extends RecordsModel
{
    public string $tableName = 'blogComments';

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
        $qBuilder
            ->select($this->tableName.'.comment_id, '.
                $this->tableName.'.commentP_id, '.
                $this->tableName.'.art_id, '.
                $this->tableName.'.content, '.
                $this->tableName.'.created_by, '.
                $this->tableName.'.activeFlag, '.
                $this->tableName.'.addDate, '.
            'users_dt.accLogin, '.
            'users_dt.accAlias, '.
            'users_dt.photoLink, '.
            'users_dt.network'
            )
            ->from($this->tableName)
            ->join('inner join users_dt on users_dt.user_id = '.$this->tableName.'.created_by '.
            'inner join blogArts on blogArts.art_id = '.$this->tableName.'.art_id'
            )
        ->order($this->tableName.'.addDate DESC');
        return $this->fetchToArray($qBuilder->buildQuery());
    }

    public function treeRecordsRecursive(JointAppQueryBuilder $qBuilder, $commentP_id = null): array
    {
        if(isset($commentP_id)){
            $addCond = $this->tableName.'.commentP_id = "'.$commentP_id.'" and '.$this->tableName.'.activeFlag is true';
                $qBuilder->where($addCond);
            $qBuilder->limit = '';

        }else{
            $addCond = $this->tableName.'.commentP_id is NULL and '.$this->tableName.'.activeFlag is true';
            if(!empty($qBuilder->where)){
                $qBuilder->where($qBuilder->where.' and '.$addCond);
            }else{
                $qBuilder->where($addCond);
            }
        }

        if(empty($qBuilder->order)){
            $qBuilder->order($this->tableName.'.addDate DESC');
        }

        $qBuilder
            ->select($this->tableName.'.comment_id, '.
                $this->tableName.'.commentP_id, '.
                $this->tableName.'.art_id, '.
                $this->tableName.'.content, '.
                $this->tableName.'.created_by, '.
                $this->tableName.'.activeFlag, '.
                $this->tableName.'.addDate, '.
                'users_dt.accLogin, '.
                'users_dt.accAlias, '.
                'users_dt.photoLink, '.
                'users_dt.network'
            )
            ->from($this->tableName)
            ->join('inner join users_dt on users_dt.user_id = '.$this->tableName.'.created_by '.
                'inner join blogArts on blogArts.art_id = '.$this->tableName.'.art_id'
            );

        $res = $this->fetchToArray($qBuilder->buildQuery());


        foreach ($res as $num => $row){
            $res[$num]['recCm'] = self::treeRecordsRecursive($qBuilder, $row['comment_id']);
        }

        return $res;
    }

    public function countTreeRecords($appQueryBuilder): int
    {
        $appQueryBuilder->select('count('.$this->tableName.'.comment_id'.') as cnt ')
            ->from($this->tableName)
            ->join('inner join blogArts on blogArts.art_id = '.$this->tableName.'.art_id');
        $appQueryBuilder->where.=' and '.$this->tableName.'.commentP_id is NULL and '.$this->tableName.'.activeFlag is true';

        $res = $this->fetchToArray($appQueryBuilder->buildQuery());

        if(isset($res[0]['cnt'])){
            return $res[0]['cnt'];
        }
        return 0;
    }

    public function listRecordsRecursive(JointAppQueryBuilder $qBuilder, $commentP_id = null): array
    {
        if(isset($commentP_id)){
            $addCond = $this->tableName.'.comment_id = "'.$commentP_id.'" and '.$this->tableName.'.activeFlag is true';
            $qBuilder->where($addCond);
            $qBuilder->limit = '';

        }else{
            $addCond = $this->tableName.'.activeFlag is true';
            if(!empty($qBuilder->where)){
                $qBuilder->where($qBuilder->where.' and '.$addCond);
            }else{
                $qBuilder->where($addCond);
            }
        }

        $qBuilder
            ->select($this->tableName.'.comment_id, '.
                $this->tableName.'.commentP_id, '.
                $this->tableName.'.art_id, '.
                $this->tableName.'.content, '.
                $this->tableName.'.created_by, '.
                $this->tableName.'.activeFlag, '.
                $this->tableName.'.addDate, '.
                'users_dt.accLogin, '.
                'users_dt.accAlias, '.
                'users_dt.photoLink, '.
                'users_dt.network'
            )
            ->from($this->tableName)
            ->join('inner join users_dt on users_dt.user_id = '.$this->tableName.'.created_by '.
                'inner join blogArts on blogArts.art_id = '.$this->tableName.'.art_id'
            );

        if(empty($qBuilder->order)){
            $qBuilder->order($this->tableName.'.addDate DESC');
        }

        if(!empty($qBuilder->where)){
            $qBuilder->where($qBuilder->where.' and '.$addCond);
        }else{
            $qBuilder->where($addCond);
        }

        $res = $this->fetchToArray($qBuilder->buildQuery());
        foreach ($res as $num => $row){
            if(empty($row['commentP_id'])){
                $res[$num]['recCm'] = [];
            }else{
                $res[$num]['recCm'] = self::listRecordsRecursive($qBuilder, $row['commentP_id']);;
            }
        }
        return $res;
    }

    public function countListRecords($appQueryBuilder): int
    {
        $appQueryBuilder->select('count('.$this->tableName.'.comment_id'.') as cnt ')
            ->from($this->tableName)
            ->join('inner join blogArts on blogArts.art_id = '.$this->tableName.'.art_id');
        $appQueryBuilder->where.=' and '.$this->tableName.'.activeFlag is true';

        $res = $this->fetchToArray($appQueryBuilder->buildQuery());

        if(isset($res[0]['cnt'])){
            return $res[0]['cnt'];
        }
        return 0;
    }
}