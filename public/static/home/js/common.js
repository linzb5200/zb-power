;!function(){
    var layer = layui.layer,form = layui.form;

    //幻灯片
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

    });

    //登录
    var floatlogin = window.float_login = function() {
        var title = '登录';
        var url = '/member/floatLogin?t='+new Date().getTime();
        var area = {width:500,height:500};
        var option = {content: [url]};
        layerBox(title,url,'',area,option);
    };
    $("#float-login").click(function() {
        floatlogin();
    });
    //注册
    var floatregister = function() {
        var title = '登录';
        var url = '/member/register?t='+new Date().getTime();
        var area = {width:500,height:560};
        var option = {content: [url]};
        layerBox(title,url,'',area,option);
    };
    $("#float-register").click(function() {
        floatregister();
    });

}();