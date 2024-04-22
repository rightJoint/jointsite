$(document).ready(function(){
    tinyInit();
})

function tinyInit()
{
    tinymce.init({
        selector: 'textarea.note-content',
        height: '20em',
        theme: 'modern',
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
        ],
    });
}

function addNoteTag()
{
    var tag_text = $("[name='note_tag']").val();
    if(tag_text!="") {
        $("form.note-form .tags-block").preloader({
            text: 'loading',
            percent: '',
            duration: '',
            zIndex: '',
            setRelative: true
        })

        var note_id_from_url = decodeURIComponent(window.location.pathname).split("/")[3];
        $.post("/notes/addTag", "note_id_from_url=" + note_id_from_url + "&tag_text=" + tag_text, function (data) {
            console.log(data);
            if(data == "Ok"){
                var tag_del_span = "<span class='tag-del' onclick='delTag(this)'>-del</span>";
                var append_tag = "<div class='note-tag'><span class='tag-text'>"+tag_text+"</span>"+tag_del_span+"</div>";
                $("form.note-form .tags-block .tags-list").append(append_tag);
                $("[name='note_tag']").val = "";

            }
            $("form.note-form .tags-block").preloader("remove");
        });
    }
}

function delTag(tag_del_span)
{

    $("form.note-form .tags-block").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });
    var note_id_from_url = decodeURIComponent(window.location.pathname).split("/")[3];
    var tag_text = $(tag_del_span).parent().find("span.tag-text").html();
    $.post("/notes/delTag", "note_id_from_url=" + note_id_from_url + "&tag_text=" + tag_text, function (data) {
        console.log(data);
        if(data == "Ok"){
            $(tag_del_span).parent().remove();
        }
        $("form.note-form .tags-block").preloader("remove");
    });
}
function dellNote()
{
    if (confirm('Are you sure you want to save this thing into the database?')) {
        $("form.note-form .tags-block").preloader({
            text: 'loading',
            percent: '',
            duration: '',
            zIndex: '',
            setRelative: true
        });
        var note_id_from_url = decodeURIComponent(window.location.pathname).split("/")[3];
        $.post("/notes/delNote", "note_id_from_url=" + note_id_from_url, function (data) {
            console.log(data);
            if(data == "Ok"){
                location.replace("/notes");
            }
            $("form.note-form .tags-block").preloader("remove");
        });
    } else {
        // Do nothing!
        console.log('Thing was not saved to the database.');
    }


}






$(document).ready(function (){
    var dropZone = document.getElementById('photos-form');
    console.log("y-3");
    if (dropZone) {
        console.log("y-1");
        let hoverClassName = 'hover';

        dropZone.addEventListener("dragenter", function(e) {
            e.preventDefault();
            dropZone.classList.add(hoverClassName);
        });

        dropZone.addEventListener("dragover", function(e) {
            e.preventDefault();
            dropZone.classList.add(hoverClassName);
        });

        dropZone.addEventListener("dragleave", function(e) {
            e.preventDefault();
            dropZone.classList.remove(hoverClassName);
        });

        // Это самое важное событие, событие, которое дает доступ к файлам
        dropZone.addEventListener("drop", function(e) {
            e.preventDefault();
            dropZone.classList.remove(hoverClassName);

            const files = Array.from(e.dataTransfer.files);
            console.log(files);
            // TODO что-то делает с файлами...
        });
    }else{
        console.log("n-1");
    }
})
