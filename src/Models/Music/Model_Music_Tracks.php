<?php


namespace Src\Models\Music;


use JointApp\JointAppQueryBuilder;
use JointApp\Models\Records\RecordsModel;

class Model_Music_Tracks extends RecordsModel
{
    public string $tableName = "musicTracks";

    function getRecordStructure()
    {
        $this->record = array(
            "track_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                'custom' => false,
            ),
            "track_name" => array(
                "format" => "varchar",
                'custom' => false,
            ),
            "track_artist" => array(
                "format" => "varchar",
                'custom' => false,
            ),
            "track_file" => array(
                "format" => "varchar",
                'custom' => false,
            ),
            "loadDate" => array(
                "format" => "date",
                'custom' => false,
            ),
            "created_by" => array(
                "format" => "varchar",
                'custom' => false,
            ),
        );
    }
    function getNewTracks()
    {
        $qBuilder = new JointAppQueryBuilder();
        $qBuilder->order('loadDate DESC')
            ->limit('0, 10');
        return $this->listRecords($qBuilder);
    }
}