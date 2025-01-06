$(document).ready(function(){
    $('.modal-right').click(function (){
        $('.modal, .overlay').css({'opacity': 0, 'visibility': 'hidden'});
    });
})

function tables(el){
    var tableName=null;
    if($(el).parent().parent().find("div:first").html()!==undefined){
        tableName=$(el).parent().parent().find("div:first a").html();
    }
    var action = $(el).attr("action");
    $(el).parent().preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    })
    var dwlTable=null;
    if(action=='download'){
        dwlTable=($(el).parent().parent().find("option:selected").val());
    }
    console.log("/test/tables/"+action+"?tableName="+tableName+"&dwlTable="+dwlTable+
        "&prefixTag="+$(".optionsPanel [name='prefixTag']").val()+"&dateTag="+$(".optionsPanel [name='dateTag']").prop("checked"));
    $.get( "/test/tables/"+action+"?tableName="+tableName+"&dwlTable="+dwlTable+
        "&prefixTag="+$(".optionsPanel [name='prefixTag']").val()+"&dateTag="+$(".optionsPanel [name='dateTag']").prop("checked") )
        .done(function( response ) {


            $(el).parent().preloader("remove");
            if(response.viewData.err==0){
                $('.logPanel h3').after("<div class='success'>"+response.viewData.log+response.timeStamp.runTime+"</div>");
            }else{
                $('.logPanel h3').after("<div class='fail'>"+response.viewData.log+"<span>"+response.viewData.err+
                    response.timeStamp.runTime+"</span></div>");
            }
            $(el).parent().parent().html(response.viewData.row);
        }
        );
}

function upLoadAll() {
    $(".optionsPanel").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    })
    $.get( "/test/tables/upLoadAll?prefixTag="+$(".optionsPanel [name='prefixTag']").val()+
        "&dateTag="+$(".optionsPanel [name='dateTag']").prop("checked") )
        .done(function( response ) {
            $(".optionsPanel").preloader("remove");
            if(response.viewData.err==0){
                $('.logPanel h3').after("<div class='success'>"+response.viewData.log+response.timeStamp.runTime+"</div>");
            }else{
                $('.logPanel h3').after("<div class='fail'>"+response.log+"<span>"+response.viewData.err+
                    +response.timeStamp.runTime+"</span></div>");
            }
        });
    refreshTables();
}

function refreshTables(){

    $('.tablesList').preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    $.get( "/test/tables/refreshtables", {action: "refreshTables"} )
        .done(function( data ) {
            $('.tablesList').html(data.viewData.tablesList);
            $('.tablesList').preloader('remove');
        });
}

function showLog(){
    $('.modal.tablesLog, .modal .overlay').css({'opacity': 1, 'visibility': 'visible'});
}