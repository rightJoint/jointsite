$(document).ready( function (){
    $('.joint-site-menu ul li').mouseenter(function (){
        $(this).find('ul:first').css('display', 'block');
    })
    $('.joint-site-menu ul li').mouseleave(function (){
        $(this).find('ul:first').css('display', 'none');
    })
})