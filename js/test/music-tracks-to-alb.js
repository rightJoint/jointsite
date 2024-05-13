$(document).ready(function (){
    $("#album_id").findselect(exec_dir+"/test/records/musicalb", "albumName", "album_id", "albumName");
    $("#track_id").findselect(exec_dir+"/test/records/musictrackstoalb", "track_name", "track_id", "track_name");
})
