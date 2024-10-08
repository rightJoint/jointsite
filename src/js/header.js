$(document).ready(function() {
    $('.modal-right .modal-close').click(function () {
        $('.modal, .overlay').css({'opacity': 0, 'visibility': 'hidden'});
    });
    $('.menuBtn span, .menuBtn img').click(function (e) {
        $('.modal.menu, .modal.menu .overlay').css({'opacity': 1, 'visibility': 'visible'});
        e.preventDefault();
    });

    $(".modal-left span.opnSubMenu").click(function () {
        if($(this).hasClass("folded")){

            $(this).parent().find("ul").slideDown("slow");
            $(this).removeClass("folded");
        }else{
            $(this).parent().find("ul").slideUp("slow");
            $(this).addClass("folded")

        }
    });

    /*goTop*/
    $("body").append("<img src='/src/img/goTop.png' class='toTop' onclick='goTop()'>");
    $(document).scroll(function () {
        var st = $(this).scrollTop();
        if (st > lastScrollTop){
            // downscroll code
            $("img.toTop").css("display", "none");
        } else {
            // upscroll code
            if ($(this).scrollTop() > $(window).height()) {
                if($("img.toTop").is(":visible")==false){
                    var timerInterval = setTimeout(function() {
                        $("img.toTop").css("display", "none");
                    }, 3000);
                }else {
                    clearInterval(timerInterval);
                }
                $("img.toTop").css("display", "block");
            } else {
                $("img.toTop").css("display", "none");
            }
        }
        lastScrollTop = st;
    });
})

var lastScrollTop = 0;

function goTop() {
    $('html,body').animate({scrollTop: 0}, 1000);
}


