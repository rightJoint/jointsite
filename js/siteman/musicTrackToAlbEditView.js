$(document).ready(function (){
    $("#album_id").findselect("siteman/music", "albums", "albumName", "album_id", "albumName");
    $("#track_id").findselect("siteman/music", "musictracks", "track_name", "track_id", "track_name");
})
