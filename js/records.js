$.fn["recordsSortBlock"] = function () {
    var pagination = $(this).find(".pagination");
    var onPage = $(this).find("select[name=onPage]");
    var sortField = $(this).find("select[name=sortField]");
    var sortOrder = $(this).find("select[name=sortOrder]");

    $(onPage).on("change", function () {
        changeOptions()
    });
    $(sortField).on("change", function () {
        changeOptions()
    });
    $(sortOrder).on("change", function () {
        changeOptions()
    });
    function changeOptions()
    {
        var activePage = $(pagination).find("span.p_num:eq(0)");
        activePage.removeClass("active");
        activePage.attr("page", 1);
        activePage.trigger("click");
    }

};
$.fn["recordsPgBlock"] = function (url, slave_req) {
    var pagination = $(this).find(".pagination");
    var list_table = $(this).find(".list_table");

    var onPage = $(this).find("select[name=onPage]");
    var sortField = $(this).find("select[name=sortField]");
    var sortOrder = $(this).find("select[name=sortOrder]");

    pg(pagination);

    function pg(pagination) {
        $(pagination).find("span.p_num, span.p_btn").each(function () {
            $(this).on("click", function () {
                if ($(this).hasClass("active")) {
                    //  alert("nothing");
                } else {
                    var formSerialized = null;

                    if($("form.filterForm").length == 1){
                        formSerialized =$("form.filterForm").serialize()+"&";
                    }else{
                        formSerialized = "applyFilterRec=1&";
                    }
                    if(slave_req){
                        formSerialized += slave_req+"&";
                    }
                    var filterSerialazed = formSerialized + "curPage=" + $(this).attr("page") + "&return=json" +
                        "&onPage=" + onPage.val() + "&sortField=" + sortField.val() +
                        "&sortOrder=" + sortOrder.val();

                    $(list_table).preloader({
                        text: 'loading',
                        percent: '',
                        duration: '',
                        zIndex: '',
                        setRelative: true
                    });

                    console.log(filterSerialazed)
                    console.log(url+"/listview")

                    $.post(url+"/listview", filterSerialazed, function (data) {
                        console.log(data)
                        var responce = JSON.parse(data);
                        $(list_table).html(responce.listView);
                        $(pagination).html(responce.pgView);
                        $(list_table).preloader("remove");

                        call_after_pg();

                        pg(pagination);
                    });
                }
            });
        });
    }
}

function call_after_pg()
{

}

function applyFilterForm()
{
    var filterSerialazed =$("form.filterForm").serialize()+
        "&onPage="+$("select[name=onPage]").val()+"&sortField="+$("select[name=sortField]").val()+
        "&sortOrder="+$("select[name=sortOrder]").val()+
        "&curPage=1&return=json";

    $(".list_table").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.post("", filterSerialazed, function (data) {
        var responce=JSON.parse(data);
        $(".list_table").html(responce.listView);
        $(".pagination").html(responce.pgView);
         $(".list_table").preloader("remove");
        $(".list_table").after(responce.jsCtrlPanel);
        call_after_FilterForm();
    });

}

function call_after_FilterForm()
{

}

function clearSearchInputs()
{
    $(".search_frame form.filterForm input[type=text]").val("");
    $(".search_frame form.filterForm input[type=number]").val(0);
    $(".search_frame form.filterForm input[type=date]").val(0);
}