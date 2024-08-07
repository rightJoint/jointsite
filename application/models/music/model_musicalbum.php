<?php
class model_musicalbum extends RecordsModel
{
    public $tableName = "musicTracksToAlb";

    public $albTable = "musicAlb";
    public $tracksTable = "musicTracks";


    public $modelAliases = array(
        "en" => "music tracks to albums",
        "rus" => "мелодии в альбом"
    );

    function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/music/rsf_musictracktoalb.php";
        $this->recordStructureFields = new rsf_musictracktoalb();
    }

    function copyCustomFields()
    {
        $albName_qry = "select albumName from ".$this->albTable." where album_id = '".$this->recordStructureFields->record["album_id"]["curVal"]."'";
        $albName_res = $this->query($albName_qry);
        if($albName_res->rowCount() == 1){
            $this->recordStructureFields->record["albumName"]["curVal"] = $albName_res->fetch(self::FETCH_ASSOC)["albumName"];
        }

        $trackName_qry = "select track_name from ".$this->tracksTable." where track_id = '".$this->recordStructureFields->record["track_id"]["curVal"]."'";
        $trackName_res = $this->query($trackName_qry);
        if($trackName_res->rowCount() == 1){
            $this->recordStructureFields->record["track_name"]["curVal"] = $trackName_res->fetch(self::FETCH_ASSOC)["track_name"];
        }

        return true;
    }

    public function listRecords($where = null, $order = null, $limit = null, $having = null)
    {
        $findList_qry = "select ".$this->tableName.".track_id, 
".$this->tableName.".album_id, 
".$this->tableName.".comment,
".$this->tableName.".mActive,
".$this->tableName.".sortDate, 
".$this->tracksTable.".track_name, 
".$this->tracksTable.".track_artist, 
".$this->tracksTable.".loadDate, 
".$this->albTable.".albumName, 
".$this->albTable.".albumImg, 
".$this->albTable.".created_by,   
".$this->tracksTable.".track_file  
from ".$this->tableName." 
left join ".$this->tracksTable." on ".$this->tracksTable.".track_id = ".$this->tableName.".track_id 
left join ".$this->albTable." on ".$this->tableName.".album_id = ".$this->albTable.".album_id  ".
            $where.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }

    public function countRecords($where = null)
    {
        return $this->query("SELECT COUNT(*) as cnt from ".$this->tableName." ".
            "left join ".$this->tracksTable." on ".$this->tracksTable.".track_id = ".$this->tableName.".track_id 
left join ".$this->albTable." on ".$this->tableName.".album_id = ".$this->albTable.".album_id  ".
            $where)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }
}