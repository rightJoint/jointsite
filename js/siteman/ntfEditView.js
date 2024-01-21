$(document).ready(function (){
    var type_id_html = "<div class='find-select' id='type_id'>"+
        "<input type='text' id='fst-type_id'>"+
        "<div class='fss'>"+
        "<select size='5' id='fs-type_id' name='type_id'>"+
        "</select>"+
        "</div>"+
        "</div>";
    $("#type_id").before("<span class='btid' style='display: none'>y</span>");

    if($("[name=subscriber_type]").val() == "user"){
        $("#type_id").findselect("siteman/users", "users", "accAlias", "user_id", "accAlias");
    }
    if($("[name=subscriber_type]").val() == "group"){
        $("#type_id").findselect("siteman/groups", "groups", "groupAlias_en", "group_id", "groupAlias_en");
    }
    if($("[name=subscriber_type]").val() == ""){
        $("#type_id").findselect(null, null, null, null, null);
    }

    $("[name=subscriber_type]").change(function (){
        var saved_type_id = $("#fst-type_id").val();

        if($("[name=subscriber_type]").val() == "user"){
            $("#type_id").remove();
            $("span.btid").after(type_id_html);
            $("#type_id").findselect("siteman/users", "users", "accAlias", "user_id", "accAlias");
        }

        if($("[name=subscriber_type]").val() == "group"){
            $("#type_id").remove();
            $("span.btid").after(type_id_html);
            $("#type_id").findselect("siteman/groups", "groups", "groupAlias_en", "group_id", "groupAlias_en");
        }

        if($("[name=subscriber_type]").val() == ""){
            $("#type_id").remove();
            $("span.btid").after(type_id_html);
            $("#type_id").findselect(null, null, null, null, null);

        }
        $("#fst-type_id").val(saved_type_id);
    })
})