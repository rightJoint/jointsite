<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/recordsStructureFiles/test/rsf_musictrackstoalb.php";
class model_records_musictrackstoalb extends RecordsModel
{
    public $tableName = "musicTracksToAlb_dt";
    public $modelAliases = array(
        "en" => "music tracks to albums",
        "rus" => "мелодии в альбом"
    );

    function getRecordStructure()
    {
        $this->recordStructureFields = new rsf_musictrackstoalb();
    }

    function copyCustomFields()
    {
        $albName_qry = "select albumName from musicAlb_dt where album_id = '".$this->recordStructureFields->record["album_id"]["curVal"]."'";
        $albName_res = $this->query($albName_qry);
        if($albName_res->rowCount() == 1){
            $this->recordStructureFields->record["albumName"]["curVal"] = $albName_res->fetch(self::FETCH_ASSOC)["albumName"];
        }

        $trackName_qry = "select track_name from musicTracks_dt where track_id = '".$this->recordStructureFields->record["track_id"]["curVal"]."'";
        $trackName_res = $this->query($trackName_qry);
        if($trackName_res->rowCount() == 1){
            $this->recordStructureFields->record["track_name"]["curVal"] = $trackName_res->fetch(self::FETCH_ASSOC)["track_name"];
        }

        return true;
    }

    public function listRecords($where = null, $order = null, $limit = null)
    {
        $findList_qry = "select musicTracksToAlb_dt.track_id, 
musicTracksToAlb_dt.album_id, 
musicTracksToAlb_dt.comment,
musicTracksToAlb_dt.mActive,
musicTracksToAlb_dt.sortDate, 
musicTracks_dt.track_name, 
musicTracks_dt.track_artist, 
musicTracks_dt.loadDate, 
musicAlb_dt.albumName, 
musicAlb_dt.albumImg 
from musicTracksToAlb_dt 
left join musicTracks_dt on musicTracks_dt.track_id = musicTracksToAlb_dt.track_id 
left join musicAlb_dt on musicTracksToAlb_dt.album_id = musicAlb_dt.album_id  ".
            $where.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }

    public function countRecords($where = null)
    {
        return $this->query("SELECT COUNT(*) as cnt from ".$this->tableName." ".
            "left join musicTracks_dt on musicTracks_dt.track_id = musicTracksToAlb_dt.track_id 
left join musicAlb_dt on musicTracksToAlb_dt.album_id = musicAlb_dt.album_id  ".
            $where)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }

    function copyGetId()
    {
        parent::copyGetId();
        $this->copyCustomFields();
    }

    function insertRecord()
    {
        if(!$this->recordStructureFields->record["album_id"]["curVal"]){

        }elseif (!$this->recordStructureFields->record["album_id"]["curVal"]){

        }else{
            return parent::insertRecord(); // TODO: Change the autogenerated stub
        }
    }
}