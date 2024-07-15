<?php
class model_music extends Model_pdo
{
    function getPlayAlb($albAlias = null)
    {
        if($albAlias){
            $findPlayAlb_qry = "select * from musicAlb where activeFlag is true and albumAlias='".$albAlias."' order by refreshDate DESC";
            if(!$findPlayAlb_res = $this->pdo_query($findPlayAlb_qry)){
                jointSite::throwErr("connection", $this->log_message);
            }

        }else{
            $findPlayAlb_qry = "select * from musicAlb where activeFlag is true order by refreshDate DESC LIMIT 1";
            if(!$findPlayAlb_res = $this->pdo_query($findPlayAlb_qry)){
                jointSite::throwErr("connection", $this->log_message);
            }
        }

        if($findPlayAlb_res->rowCount() == 1){
            return $findPlayAlb_res->fetch(PDO::FETCH_ASSOC);
        }else{
            jointSite::throwErr("request", "album ".$albAlias." not exist or active");
        }
    }

    function getAlbumsList()
    {
        $findAlbums_qry = "select * from musicAlb where activeFlag is true order by refreshDate DESC";
        return $this->query($findAlbums_qry);
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