function changeContImg(num) {
    $(".contacts-block").find(".cb-img-wrap.active").each(function () {
        $(this).find("img, div").fadeOut("slow", function () {

            $(".locPr-block img.active").removeClass("active");

            $(".contacts-block").find(".cb-img-wrap.active").removeClass("active");

            $(".contacts-block .cb-img-wrap:eq("+num+")").addClass("active");

            $(".contacts-block .cb-img-wrap:eq("+num+") img, .contacts-block .cb-img-wrap:eq("+num+") div").fadeIn("slow", function () {

            });

            $(".locPr-block img:eq("+num+")").addClass("active");
        });
    });

}