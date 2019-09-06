
layui.use(['layer', 'login'], function(exports){

    var $ = layui.jquery
        ,login = layui.login


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

