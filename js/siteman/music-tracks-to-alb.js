$(document).ready(function (){
    $("#album_id").findselect(exec_dir+"/siteman/music/musicalb", "albumName", "album_id", "albumName");
    $("#track_id").findselect(exec_dir+"/siteman/music/musictracks", "track_name", "track_id", "track_name");
})
