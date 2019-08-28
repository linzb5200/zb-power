
layui.use(['layer', 'laytpl', 'form', 'element', 'upload', 'util','login'], function(exports){

    var $ = layui.jquery
        ,layer = layui.layer
        ,laytpl = layui.laytpl
        ,form = layui.form
        ,element = layui.element
        ,upload = layui.upload
        ,login = layui.login
        ,util = layui.util;


    //banner
    if($('.swiper-container').length > 0){
        var mySwiper = new Swiper('.swiper-container',{
            loop: true,
            speed:600,
            grabCursor : true,
            parallax:true,
            pagination: {
                el:'.swiper-pagination',
                clickable :true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

        })

    }

    if($('.ahref').length > 0){
        $('.ahref').click(function () {
            var href = $(this).attr('href');
            var target = $(this).attr('target');
            if(href != '' && target == '_blank') window.open(href);
            if(href != '') location.href=href;
        });
    }


});

layui.cache.page = 'case';
layui.cache.user = {
    username: '游客'
    ,uid: -1
    ,avatar: '/static/home/images/avatar/00.jpg'
    ,experience: 83
    ,sex: '男'
};
layui.config({
    version: "3.0.0"
    ,base: '/static/home/mods/' //这里实际使用时，建议改成绝对路径
}).extend({
    fly: 'index'
}).use('fly');

