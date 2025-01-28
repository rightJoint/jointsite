function lBasketAddPop(em) {
    $(em).parent().parent().preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });

    $.get(jointAppLangSl+"/basket/add", "lBasketAdd="+$(em).attr("prod-alias"), function (response) {
        $(em).parent().parent().preloader('remove');
        $(".modal-line-text.basket span").html(response.viewData.total);
        $(".modal-basket-list").html(response.viewData.basket)
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
    $.post(jointAppLangSl+"/applications", $("form.order").serialize(), function (data) {
        if(data.viewData.fbfa == 1){
            location.replace(data.viewData.redirectUrl);
        }else{
            for(var apllFiedl in data.viewData) {
                if(data.viewData[apllFiedl].err == 1){
                    $("form.order [name="+apllFiedl+"]").parent().parent().find(".modal-line-err").html(data.viewData[apllFiedl].info);
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
    $.get("/basket/drop");
}