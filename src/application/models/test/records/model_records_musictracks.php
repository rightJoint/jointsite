<?php

use JointSite\Core\Records\RecordsModel;

class model_records_musictracks extends RecordsModel
{
    public $tableName = "rjt_musicTracks";

    public $tracksToAlb = "rjt_musicTracksToAlb";

   // public $modelAliases = array(
    //    "en" => "music tracks",
     //   "rus" => "мелодии"
    //);

    function getRecordStructure()
    {
        require_once JOINT_SITE_REQUIRE_DIR."/application/recordsStructureFiles/test/rsf_musictracks.php";
        //require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/recordsStructureFiles/test/rsf_musictracks.php";
        $this->recordStructureFields = new rsf_musictracks();
        $this->recordStructureFields->editFields["track_artist"]["filling"] = $this->fill_artist_list();
    }

    function fill_artist_list()
    {
        $return = array();
        $qry = "select track_artist from ".$this->tableName." group by track_artist order by track_artist";
        $res = $this->query($qry);
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $return[$row["track_artist"]] = $row["track_artist"];
            }
        }
        return $return;
    }

    function deleteRecord()
    {
        $clearTrackToAlb_qry = "delete from ".$this->tracksToAlb." where track_id='".$this->recordStructureFields->record["track_id"]["curVal"]."'";
        $this->query($clearTrackToAlb_qry);
        return parent::deleteRecord(); // TODO: Change the autogenerated stub
    }
}