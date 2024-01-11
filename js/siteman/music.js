$(document).ready(function (){
    $("[name=file_type]").change(function (){
        var old_em = $("[name=track_file]");

        var new_el_text = "<input type='text' name='track_file'>";
        var new_el_file = "<input type='file' name='track_file'>";

        if($(this).val() == "file_type-ref"){
            $(old_em).after(new_el_text);
        }
        if($(this).val() == "file_type-ftp-load"){
            $(old_em).after(new_el_file);
        }
        if($(this).val() == "file_type-html-load"){
            $(old_em).after(new_el_file);
        }
        $(old_em).remove();
    })
})