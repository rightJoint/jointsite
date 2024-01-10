$(document).ready(function() {
    $('.modal-right .modal-close').click(function () {
        $('.modal, .overlay').css({'opacity': 0, 'visibility': 'hidden'});
    });
    $('.menuBtn span, .menuBtn img').click(function (e) {
        $('.modal.menu, .modal.menu .overlay').css({'opacity': 1, 'visibility': 'visible'});
        e.preventDefault();
    });

    $(".modal-left span.opnSubMenu").click(function () {
        if($(this).html()=='+'){
            $(this).parent().find("ul").slideDown("slow");
            $(this).html("-");
        }else{
            $(this).parent().find("ul").slideUp("slow");
            $(this).html("+");
        }
    });
    $("a.title").click(function (){


        if($(this).attr("href") == "#siteSignUp"){
            $("form.auth-form.signUp").removeClass("disp-none");
            $("form.auth-form.signIn").addClass("disp-none");
        }
        if($(this).attr("href") == "#siteSignIn"){
            $("form.auth-form.signUp").addClass("disp-none");
            $("form.auth-form.signIn").removeClass("disp-none");
        }

    });
})


