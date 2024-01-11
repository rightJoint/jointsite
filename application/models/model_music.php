<?php
class Model_Music extends Model
{
    function getPlayAlb($albAlias = null)
    {
        if($albAlias){
            $findPlayAlb_qry = "select * from musicAlb_dt where activeFlag is true and albumAlias='".$albAlias."' order by refreshDate DESC";
            $findPlayAlb_res = $this->query($findPlayAlb_qry);

        }else{
            $findPlayAlb_qry = "select * from musicAlb_dt where activeFlag is true order by refreshDate DESC LIMIT 1";
            $findPlayAlb_res = $this->query($findPlayAlb_qry);
        }

        if($findPlayAlb_res->rowCount() == 1){
            return $findPlayAlb_res->fetch(PDO::FETCH_ASSOC);
        }else{
            throwErr("request", "album ".$albAlias." not exist or active");
        }
    }

    function getAlbumsList()
    {
        $findAlbums_qry = "select * from musicAlb_dt where activeFlag is true order by refreshDate DESC";
        return $this->query($findAlbums_qry);
    }

    function getAlbTracksList($album_id)
    {
        $findAlbTrackList_qry = "select musicTracks_dt.track_name, musicTracks_dt.track_id, ".
            "musicTracks_dt.track_file, musicTracks_dt.track_artist from musicTracksToAlb_dt ".
            "inner join musicTracks_dt on musicTracksToAlb_dt.track_id = musicTracks_dt.track_id ".
            "where musicTracksToAlb_dt.album_id = '".$album_id."' order by musicTracksToAlb_dt.sortDate DESC";
        return $this->query($findAlbTrackList_qry);
    }
}