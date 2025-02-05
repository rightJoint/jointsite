$(document).ready(function(){
    tinyInit();
    blogPg();
    $("#art-comments-options-sort").change(function (){
        $("#art-comments-respond-new").trigger("click");
        filterBlog();
        $("form.form-comments [name=sort]").val($(this).val());
    })
    $("#art-comments-options-onPage").change(function (){
        $("#art-comments-respond-new").trigger("click");
        filterBlog();
        $("form.form-comments [name=onPage]").val($(this).val());
    })
})
function tinyInit()
{
    tinymce.init({
        selector: '#form-comments-content',
        height: '15em',
        theme: 'modern',
        plugins:             'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table contextmenu paste code',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
        ],
    });
}

function commentRespond(el)
{
    let comment_id = $(el).attr('comment-id');
    console.log('commentRespond='+comment_id);
    $("form.form-comments [name='commentP_id']").val(comment_id);
    tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'form-comments-content');
    var formComment = $('form.form-comments');
    $(el).parent().after(formComment);
    tinyInit();
    if(comment_id == 'new'){
        $("#form-comments-submit-new").css("display", "inherit");
        $("#form-comments-submit-answer").css("display", "none");
    }else{
        $("#form-comments-submit-new").css("display", "none");
        $("#form-comments-submit-answer").css("display", "inherit");
        $(".art-comments-new").addClass('active');
    }
}
function blogPg()
{
    $(".blog-pagination").find("span.p_num, span.p_btn").each(function () {
        $(this).on("click", function () {
            if ($(this).hasClass("active")) {
                //  alert("nothing");
            } else {
                $(".blog-pagination span.p_num").removeClass("active");
                $(".blog-pagination span.p_btn").removeClass("active");
                $(this).addClass("active");
                $(".art-comments-new").removeClass("active");
                $("#art-comments-respond-new").trigger("click");
                filterBlog();
                $("form.form-comments [name=curPage]").val($(this).attr("page"));
            }
        });
    });
}

function filterBlog()
{

    $(".art-comments").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });

    $.post(jointAppLangSl+"/blog/filter-comments",
        "filterComments=y&"+
        "artRef="+$("#blog-art-ref").val()+"&"+
        "curPage="+$(".blog-pagination span.active").attr("page")+"&"+
        "sort="+$("#art-comments-options-sort").val()+"&"+
        "onPage="+$("#art-comments-options-onPage").val(),
        function (data) {

            if(data.result == true){
                $('.blog-pagination').html(data.viewData.pg);
                $('#blog-count-comments').html(data.viewData.count);
                $('.art-comments-list').html(data.viewData.listView);
                //$('.art-comments-list').html('zhopa');
                blogPg();
            }

            if(data.result == true){
                $('.blog-art-list').html(data.viewData.listView);
                $('#blog-count-arts').html(data.viewData.blogCountArts);
                $('.blog-pagination').html(data.viewData.pg);
                $(".blog-art-list").preloader("remove");

                blogPg();

                $(".art-comments").preloader("remove");
            }


        });
}
