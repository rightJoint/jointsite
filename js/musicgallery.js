$(document).ready(function (){

    $("#music-album").jointMusicPlayer();
})

$.fn["jointMusicPlayer"] = function () {
    var htmlMusicPlayer = document.getElementById("htmlMusicPlayer");

    var music_album = $(this);

    var cur_track_num = 1;

    var timerId;


    $(this).find(".track-line .track-play input[type=button]").each(function (){
        $(this).on("click", function () {
            var track_file = $(this).parent().parent().find(".track-name a").attr("href");
            htmlMusicPlayer.src = track_file;

            cur_track_num =parseInt($(this).parent().parent().find(".track-num").html());

            var next_num = cur_track_num+1;

            timerId = setInterval(function() {

                if(htmlMusicPlayer.ended)
                {
                    clearInterval(timerId);
                    $(music_album).find(".track-line:eq("+next_num+") .track-play input[type=button]").trigger("click");
                }
            }, 100);
        })

    });
}