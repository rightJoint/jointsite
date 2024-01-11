$(document).ready(function (){
    $("#album_id").findselect("/siteman/music", "musicAlb_dt", "albumName", "album_id", "albumName");
    $("#track_id").findselect("/siteman/music", "musicTracks_dt", "track_name", "track_id", "track_name");
})
