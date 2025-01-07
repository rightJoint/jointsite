function tinyInit(selector)
{
    tinymce.init({
        selector: selector,
        height: '10em',
        theme: 'modern',
        plugins:             'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table contextmenu paste code',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
        ],
        content_css: [
            '//lib/js/tinymce/js/tinymce/skins/lightgray/skin.mim.css'
        ]
    });
}

$.fn["findselect"] = function (process_path, custom_name, findField, returnKey, where_field = null) {
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

        if(custom_name && findField && find_type_val && returnKey && where_field){
            var req_text = "method=fillDL&process_path="+process_path+
                "&custom_name="+custom_name+"&findField="+findField+"&returnKey="+returnKey+
                "&where={%22"+where_field+"%22:%22"+find_type_val+"%22}"+search_params;
            $.get("/siteman/jointApi", req_text, function (data){
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