<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/core/RecordsModel.php";
class model_music extends RecordsModel
{

    public $tableName = "musicAlb";
    public $tracksToAlb = "musicTracksToAlb";

    function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/music/rsf_musicalb.php";
        $this->recordStructureFields = new rsf_musicalb();
    }


    function getNewAlbums()
    {
        return $this->listRecords(null, " order by dateOfCr DESC, albumName ", " limit 0, 3", " having countRec > 0");


    }
    function listRecords($where = null, $order = null, $limit = null, $having = null)
    {
        $findList_qry = "select ".$this->tableName.".*, count(".$this->tracksToAlb.".album_id) as countRec, users_dt.accAlias as alb_created   ";

        $findList_qry = substr($findList_qry, 0, strlen($findList_qry)-2);
        $findList_qry.= " from ".$this->tableName." ".
            "left join ".$this->tracksToAlb." on ".$this->tableName.".album_id = ".$this->tracksToAlb.".album_id ".
            "left join users_dt on ".$this->tableName.".created_by = users_dt.user_id ".
            $where.
            "group by ".$this->tableName.".album_id".
            " having countRec>0 ".$order.$limit;

        $result = $this->fetchToArray($findList_qry);
        if($result){
            return $this->fetchToArray($findList_qry);
        }
    }

    function countRecords($where = null)
    {
        return count($this->listRecords(null, null, null, " having countRec>0"));
    }

    function getAlbumsList()
    {
        return $this->listRecords();
    }

    function getAlbTracksList($album_id)
    {
        $findAlbTrackList_qry = "select musicTracks.track_name, musicTracks.track_id, ".
            "musicTracks.track_file, musicTracks.track_artist from musicTracksToAlb ".
            "inner join musicTracks on musicTracksToAlb.track_id = musicTracks.track_id ".
            "where musicTracksToAlb.album_id = '".$album_id."' order by musicTracksToAlb.sortDate DESC";
        return $this->query($findAlbTrackList_qry);
    }
}