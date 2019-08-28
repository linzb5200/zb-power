/**

 @Name: 登录

 */

layui.define(['laypage', 'fly'], function(exports){

    var $ = layui.jquery;
    var layer = layui.layer;
    var util = layui.util;
    var laytpl = layui.laytpl;
    var form = layui.form;
    var laypage = layui.laypage;
    var upload = layui.upload;
    var fly = layui.fly;
    var device = layui.device();

    //登录注册表单
    var active = {
        //登录
        login: function(div){
            layer.open({
                type: 1
                ,id: 'LAY_login'
                ,title: '快速登录 ( 免注册 )'
                ,area: (device.ios || device.android) ? ($(window).width() + 'px') : '550px'
                ,content: ['<ul class="layui-row fly-third-login" style="margin: 50px 20px;">'
                    ,'<li class="layui-form-item">'
                    ,'<div class="layui-input-block">'
                    ,'<button type="button" lay-filter="thirdLogin" class="layui-btn wechat"> <i class="fa fa-wechat"></i> 微信登录</button>'
                    ,'</div>'
                    ,'</li>'
                    ,'<li class="layui-form-item">'
                    ,'<label class="layui-form-label"></label>'
                    ,'<div class="layui-input-block">'
                    ,'<button type="button" lay-filter="thirdLogin" class="layui-btn qq"><i class="fa fa-qq"></i> QQ登录</button>'
                    ,'</div>'
                    ,'</li>'
                    ,'<li class="layui-form-item">'
                    ,'<label class="layui-form-label"></label>'
                    ,'<div class="layui-input-block">'
                    ,'<div class="extra mobile-login" lay-filter="thirdLogin">手机验证码登录</div>'
                    ,'</div>'
                    ,'</li>'
                    ,'</ul>'].join('')
                ,success: function(layero, index){

                    layero.find('.wechat').on('click', function() {
                        return layer.msg('微信登录');
                    });

                    layero.find('.qq').on('click', function() {
                        return layer.msg('QQ登录');
                    });

                    layero.find('.mobile-login').on('click', function() {
                        layer.close(index);
                        var type = 'mobileLogin';
                        active[type] && active[type].call(this, div);
                    });

                }
            });
        }

        //手机号码登录
        ,mobileLogin: function(div){
            layer.open({
                type: 1
                ,id: 'LAY_mobileLogin'
                ,title: '登录'
                ,area: (device.ios || device.android) ? ($(window).width() + 'px') : '550px'
                ,content: ['<ul class="layui-row fly-login-area" lay-filter="mobileLogin" style="margin: 50px 20px;">'
                    ,'<li class="layui-form-item">'
                    ,'<div class="layui-input-block">'
                    ,'<input required name="mobile" lay-verify="required" placeholder="手机号" value="" class="layui-input" autocomplete="off">'
                    ,'</div>'
                    ,'</li>'
                    ,'<li class="layui-form-item">'
                    ,'<label class="layui-form-label send">获取</label>'
                    ,'<div class="layui-input-block">'
                    ,'<input required name="code" lay-verify="required" placeholder="手机验证码" value="" class="layui-input" autocomplete="off">'
                    ,'</div>'
                    ,'</li>'
                    ,'<li class="layui-form-item">'
                    ,'<label class="layui-form-label"></label>'
                    ,'<div class="layui-input-block">'
                    ,'<button type="button" class="layui-btn login">登录</button>'
                    ,'</div>'
                    ,'</li>'
                    ,'<li class="layui-form-item">'
                    ,'<label class="layui-form-label"></label>'
                    ,'<div class="layui-input-block">'
                    ,'<div class="extra other" >其他登录方式</div>'
                    ,'</div>'
                    ,'</li>'
                    ,'</ul>'].join('')
                ,success: function(layero, index){

                    layero.find('.send').on('click', function() {
                        return layer.msg('发送验证码');
                    });

                    layero.find('.login').on('click', function() {
                        return layer.msg('登录');
                    });

                    layero.find('.other').on('click', function() {
                        layer.close(index);
                        var type = 'login';
                        active[type] && active[type].call(this, div);
                    });

                }
            });
        }

        //退出登录
        ,logout: function(othis){
            return layer.msg('退出成功');
        }

    };

    //登录
    $('body').on('click', '.fly-login', function(){
        var othis = $(this), type = 'login';
        active[type] && active[type].call(this, othis);
    });
    //退出
    $('body').on('click', '.fly-logout', function(){
        var othis = $(this), type = 'logout';
        active[type] && active[type].call(this, othis);

    });

    exports('login', {});
});