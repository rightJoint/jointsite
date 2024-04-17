$(document).ready(function(){
    tinyInit();
})

function tinyInit()
{
    tinymce.init({
        selector: 'textarea.note-content',
        height: '20em',
        theme: 'modern',
        /*
        plugins:             'advlist autolink lists link image charmap print preview '+
            'anchor searchreplace visualblocks code fullscreen insertdatetime media contextmenu paste code',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,

         */
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
            //{ title: 'Test template 2', content: 'Test 2' }
        ],
    });
}

function addNoteTag()
{
    $("form.note-form .tags-block").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    })/*
    $.post("/applications", $("form.order").serialize(), function (data) {
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
    });*/
    const queryString = window.location;
    //var params = queryString.split('/');
    var note_id_from_url = decodeURIComponent(window.location.pathname).split("/")[3];

    //let arr = decodeURIComponent(window.location.pathname).split("/");
    console.log(note_id_from_url);
    $("form.note-form .tags-block").preloader("remove");
   // console.log(decodeURIComponent(window.location.pathname));
    //const urlParams = new URLSearchParams(queryString);

    //alert(params[1]);
//    alert($("[name='note_tag']").val());
}