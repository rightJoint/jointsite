$(document).ready(function (){
    //call_after_pg();
 $("#music-album").jointMusicPlayer();
})

var cur_track_num = 0;
var new_track_num = 0;
var next_num = 0;



$.fn["jointMusicPlayer"] = function () {
    var htmlMusicPlayer = document.getElementById("htmlMusicPlayer");

    var music_album = $(this);

    var timerId;

    var alb_length = 0;

    var nav_menu = document.getElementById("music-nav-menu");

    $(nav_menu).mouseenter(function (){
        $(this).find("ul").css("display", "inherit");
        $(this).find("span").css("text-decoration", "inherit");
    })
    $(nav_menu).mouseleave(function (){
        $(this).find("ul").css("display", "none");
        $(this).find("span").css("text-decoration", "underline");
    })


    $(this).find(".track-line .track-play input[type=button]").each(function (){
        alb_length++;
        $(this).on("click", function () {
            var track_file = $(this).parent().parent().find(".track-name a").attr("href");
            new_track_num =parseInt($(this).parent().parent().find(".track-num").html());

            if(cur_track_num != new_track_num){
                htmlMusicPlayer.src = track_file;
                $(music_album).find(".track-line:eq("+cur_track_num+") .track-play input[type=button]").val("Play");
                $(this).val("Pause");
                cur_track_num = new_track_num;
            }else{
                if($(this).val() == "Play"){
                    htmlMusicPlayer.play()
                    $(this).val("Pause");
                }else{
                    if($(this).val() == "Pause"){
                        $(this).val("Play");
                        htmlMusicPlayer.pause();
                    }
                }
            }

            next_num = cur_track_num+1;

            if(alb_length < next_num){
                next_num = 1;
            }

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

function call_after_pg()
{
    cur_track_num = 0;
    new_track_num = 0;
    next_num = 0;

    $('#musicTracks').jointMusicPlayer();
}