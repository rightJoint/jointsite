<?php


namespace Src\Models\Music;


use JointApp\JointAppQueryBuilder;
use JointApp\Models\Records\RecordsModel;

class Model_Music_Albums extends RecordsModel
{

    public string $tableName = 'musicAlb';
    public $tracksToAlb = 'musicTracksToAlb';

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
                'format' => 'text',
                'custom' => false,
            ),
            'dateOfCr' => array(
                'format' => 'date',
                'custom' => false,
            ),
            'albumImg' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
                'curVal' => 1,
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


    function getNewAlbums()
    {
        $qBuilder = new JointAppQueryBuilder();

        $qBuilder
            ->select($this->tableName.'.*, count('.$this->tracksToAlb.'.album_id) as countRec, users_dt.accAlias as alb_created')
            ->from($this->tableName)
            ->join(
                'left join '.$this->tracksToAlb.' on '.$this->tableName.'.album_id = '.$this->tracksToAlb.'.album_id '.
                'left join users_dt on '.$this->tableName.'.created_by = users_dt.user_id '
            )
            ->groupBy($this->tableName.'.album_id')
            ->order('dateOfCr DESC, albumName')
            ->having('countRec > 0')
            ->limit('0, 3');

        return $this->fetchToArray($qBuilder->buildQuery());
    }

    public function listRecords(JointAppQueryBuilder $qBuilder): array
    {
        $qBuilder
            ->select($this->tableName.'.*, count('.$this->tracksToAlb.'.album_id) as countRec, users_dt.accAlias as alb_created')
            ->from($this->tableName)
            ->join(
                'left join '.$this->tracksToAlb.' on '.$this->tableName.'.album_id = '.$this->tracksToAlb.'.album_id '.
                'left join users_dt on '.$this->tableName.'.created_by = users_dt.user_id '
            )
            ->groupBy($this->tableName.'.album_id')
            ->having('countRec > 0');
        return $this->fetchToArray($qBuilder->buildQuery());
    }

    public function countRecords(JointAppQueryBuilder $qBuilder):int
    {
        $qBuilder
            ->select('count(*) as cnt, count('.$this->tracksToAlb.'.album_id) as countRec')
            ->from($this->tableName)
            ->join(
                'left join '.$this->tracksToAlb.' on '.$this->tableName.'.album_id = '.$this->tracksToAlb.'.album_id '
            )
            ->groupBy($this->tableName.'.album_id')
            ->having('countRec > 0');
        if($res = $this->pdoQuery($qBuilder->buildQuery())){
            return $res->fetch(\PDO::FETCH_ASSOC)["cnt"];
        }

        return 0;
    }
}