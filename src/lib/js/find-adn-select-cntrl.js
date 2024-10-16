$.fn["findselect"] = function (url, findField, returnKey, where_field = null) {
    var find_type = $(this).find("input[type=text]");

    var t_id = $(this).attr("id");

    var search_params = window.location.search;

    var api_action = url+"/filldatalist";

    if(search_params != ""){
        search_params = "&"+search_params.substring(1);
    }

    $(find_type).keyup(function (){
        $("#"+t_id).find(".fss").html("");

        var find_type_val = $(find_type).val();

        $(this).find("#fs-"+$(this).attr("id")).remove();

        if(findField && find_type_val && returnKey && where_field){
            var req_text = "findField="+findField+"&returnKey="+returnKey+
                "&where={%22"+where_field+"%22:%22"+find_type_val+"%22}"+search_params;
            $.get(api_action, req_text, function (data){
                var newFill_select = "<select id='fs-"+t_id+"' name='"+t_id+"' size='5' onchange='changeTextValue(this)'>";
                if(data){
                    var options = JSON.parse(data);
                    Object.keys(options).forEach(function(key) {
                        newFill_select += "<option value='"+key+"'>"+options[key]+"</option>";
                    });

                }else{

                }
                newFill_select+="</select>";
                $("#"+t_id).find(".fss").html(newFill_select);
            });
        }
    })
}

function changeTextValue(em)
{
    var opt = $(em).find("option:selected").html();
    var fst = "fst-"+$(em).attr("name");
    $("#"+fst).val(opt);
}