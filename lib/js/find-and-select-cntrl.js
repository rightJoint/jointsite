$.fn["findselect"] = function (url, returnKey, findField, where_field = null) {
    var find_type = $(this).find("input[type=text]");

    var t_id = $(this).attr("id");

    var search_params = window.location.search;

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
            $.get(url, req_text, function (data){

                console.log(req_text);

                var newFill_select = "<select id='fs-"+t_id+"' name='"+t_id+"' size='5' onchange='changeTextValue(this)'>";
                if(data.result == true){
                    Object.keys(data.viewData).forEach(function(key) {
                        newFill_select += "<option value='"+data.viewData[key][returnKey]+"'>"+data.viewData[key][findField]+"</option>";
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