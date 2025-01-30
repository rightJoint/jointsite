$(document).ready(function (){
    blogPg();
})

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
                filterBlog();
            }
        });
    });
}

function filterBlog()
{
    $(".blog-art-list").preloader({
        text: 'loading',
        percent: '',
        duration: '',
        zIndex: '',
        setRelative: true
    });

    $.post(jointAppLangSl+"/blog/filter",
        "filterBlog=y&"+
        "blog-filter-cat="+$("#blog-filter-cat").val()+"&"+
        "blog-filter-artName="+$("#blog-filter-artName").val()+"&"+
        "blog-cur-page="+$(".blog-pagination span.active").attr("page")+"&"+
        "blog-sort-field="+$("#blog-sort-field").val()+"&"+
        "blog-sort-order="+$("#blog-sort-order").val()+"&"+
        "blog-on-page="+$("#blog-on-page").val()+"&"+
        "blog-in-row="+$("#blog-in-row").val(),
        function (data) {

        if(data.result == true){
            $('.blog-art-list').html(data.viewData.listView);
            $('#blog-count-arts').html(data.viewData.blogCountArts);
            $('.blog-pagination').html(data.viewData.pg);
            $(".blog-art-list").preloader("remove");
            //if(data.viewData == 'undi')
            console.log(data.viewData);

            blogPg();
        }
    });
}