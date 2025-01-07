function lBasketAddPop(em) {
    $(em).parent().parent().preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });

    $.get("/", "lBasketAdd="+$(em).attr("prod-alias"), function (data) {
        console.log(data);
        var response = JSON.parse(data);
        $(em).parent().parent().preloader('remove');
        $(".modal-line-text.basket span").html(response.total);
        $(".modal-basket-list").html(response.basket)
        $(".modal-line-text.basket").parent().show();
        $("#pop-"+$(em).attr("prod-alias")).addClass("active");
        if($(em).parent().parent().parent().parent().find("a").attr("data-lang")=="en"){
            $(em).find(".buy-btn-txt  div:first-child").html("Buy one more ");
        }else{
            $(em).find(".buy-btn-txt div:first-child").html("Купить еще ");
        }
        $(".orderBtn span").addClass("buy");
    });
}

function mkApplication() {
    $("form.order").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    })
    $.post("/applications", $("form.order").serialize(), function (data) {
        console.log(data);
        //alert(data);
        //return;
        var applResponse = JSON.parse(data);
        if(applResponse.fbfa == 1){
            location.replace(applResponse.redirectUrl);
        }else{
            for(var apllFiedl in applResponse) {
                if(applResponse[apllFiedl].err == 1){
                    $("form.order [name="+apllFiedl+"]").parent().parent().find(".modal-line-err").html(applResponse[apllFiedl].info);
                }else{
                    $("form.order [name="+apllFiedl+"]").parent().parent().find(".modal-line-err").html("");
                }
            }
            $("form.order").preloader("remove");
        }
    })
}

function basketDrop() {
    $(".modal-line-text.basket").parent().hide();
    $(".modal-basket-list").html("");
    $(".orderBtn span").removeClass("buy");
    $.get("/", "basket-clear=1");
}