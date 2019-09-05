/**
 @Name: 用户模块
 */
 
layui.define(['laypage', 'fly', 'element', 'flow'], function(exports){

  var $ = layui.jquery
      ,layer = layui.layer
      ,form = layui.form
      ,fly = layui.fly
      ,element = layui.element
      ,upload = layui.upload;

    //显示当前tab
    if(location.hash){
        element.tabChange('user', location.hash.replace(/^#/, ''));
    }

    element.on('tab(user)', function(){
        var othis = $(this), layid = othis.attr('lay-id');
        if(layid){
            location.hash = layid;
        }
    });

    element.on('tab(mine)', function(){
        var url = $(this).attr('data-url');
        if(url){
            location.href = url;
        }
    });

    var sms_interval = 90;
    var code_interval = null;
    var smsTime = function(obj){
        var time = sms_interval;
        obj.html(sms_interval+"秒后重发");
        obj.timer = setInterval(function(){
            if(time <= 1){
                clearInterval(obj.timer);
                obj.timer=null;
                obj.html("获取验证码");
                obj.removeClass("identify-disable");
            }else{
                time--;
                obj.html(time+"秒后重发");
            }
        },1000);
    };
    //修改密码
    form.on('submit(F_repass)', function(data){
        fly.json('/user/pwd/', data.field, function(res){
            if(res.status === 0){
                layer.msg(res.msg, {icon: 1,time: 1E3}, function(){location.reload();})
            }
        });
        return false;
    });
    //修改昵称
    $(".edit_nickname").click(function() {
        layer.open({
            type: 1,
            area: ['400px'],
            shade: 0.4,
            title: '修改昵称',
            content: '<form class="layui-form layui-form-pane layer-open"><div class="layui-form-item"><label class="layui-form-label">昵称</label><div class="layui-input-block"><input type="text" name="nickname" required="" lay-verify="required" value="'+$('#info_nickname').val()+'" autocomplete="off" class="layui-input"></div></div><div class="layui-form-item"><div class="layui-input-block"><button class="layui-btn layui-btn-normal" lay-submit="" lay-filter="save">保存</button><button class="layui-btn layui-btn-primary layui-btn-close">取消</button></div></div></form>',
            success: function(layero, index){
                $(".layer-open .layui-btn-close").click(function() {layer.close(index);return !1});
                layero.find('input[name="mobile"]').focus();

                form.on('submit(save)',function(data){
                    if(data.field.nickname == $('#info_nickname').text()) return !1;
                    fly.json('/user/nickname/', data.field, function(res){
                        layer.msg("修改成功", {icon: 1,time: 1E3}, function(){location.reload();})
                    });
                    return !1;
                });
            }
        });
    });
    //修改手机
    $(".edit_phone").click(function() {
        layer.open({
            type: 1,
            area: ['366px'],
            shade: 0.4,
            title: '更换手机',
            content: '<form class="layui-form layui-form-pane layer-open"><div class="layui-form-item"><label class="layui-form-label"><i class="fa fa-mobile fa-fw"></i> </label><div class="layui-input-block"><input type="text" id="phone_input" name="phone" required="" lay-verify="phone" value="'+$('#info_phone').val()+'" placeholder="请输入手机号" maxlength="11" autocomplete="off" class="layui-input"></div></div><div class="layui-form-item"><label class="layui-form-label identify-btn" id="phone_code_btn">获取验证码</label><div class="layui-input-block"><input type="text" id="phone_code_input" name="code" value="" placeholder="请输入手机验证码" required="" maxlength="6" lay-verify="number" autocomplete="off" class="layui-input"></div></div><div class="layui-form-item"><button class="layui-btn layui-btn-fluid layui-btn-orange" lay-submit="" lay-filter="validate" id="phone_confirm">确定</button></div></form>',
            success: function(layero, index){

                var phone_code_btn = $("#phone_code_btn");
                $("#phone_code_btn").click(function(){
                    var phone_input = $("#phone_input"),phone_code_input = $("#phone_code_input");
                    if(!phone_input.val().match(/^(((1[3|4|5|6|7|8|9][0-9]{1}))+\d{8})$/)){
                        layer.msg('手机号格式错误', {icon: 5,anim: 6})
                        return !1
                    }
                    if($(this).hasClass('identify-disable')){return false;}

                    fly.json('/user/senddx/', {phone:phone_input.val()}, function(res){
                        phone_code_input.val('');
                        phone_code_btn.addClass("identify-disable");
                        smsTime(phone_code_btn);
                        layer.msg(res.msg, {icon: 1,time: 1E3})
                    });

                });
                $(".layer-open input[name=code]").focus();
                form.on('submit(validate)',function(data){

                    fly.json('/user/validatephone/', data.field, function(res){
                        if(res.status === 0){
                            $('.layer-open input[name=phone]').removeAttr("readonly");
                            $('.layer-open input[name=phone]').val("");
                            $('.layer-open input[name=phone]').attr("lay-filter","phone");
                            $('.layer-open input[name=code]').val("");
                            clearInterval(phone_code_btn.timer);
                            phone_code_btn.timer = null;
                            phone_code_btn.html("获取验证码");
                            phone_code_btn.removeClass("identify-disable");
                            $(".layer-open input[name=phone]").focus();
                            $('#phone_confirm').attr("lay-filter","change");
                            form.render();
                        };
                    });
                    return !1;
                });
                form.on('submit(change)',function(data){
                    if(data.field.phone == $('#info_phone').text()){
                        layer.msg("手机没有任何变化", {icon: 2,anim: 6})
                        return !1;
                    }

                    fly.json('/user/changephone', data.field, function(res){
                        layer.msg("修改成功", {icon: 1,time: 1E3}, function(){location.reload();});
                    });
                    return !1;
                });
            }
        });
    });
    //修改邮箱
    $(".edit_email").click(function() {
        layer.open({
            type: 1,
            area: ['366px'],
            shade: 0.4,
            title: $(this).text(),
            content: '<form class="layui-form layui-form-pane layer-open"><div class="layui-form-item"><label class="layui-form-label"><i class="fa fa-envelope-o fa-fw"></i></label><div class="layui-input-block"><input type="text" id="email_input" name="email" value="'+$('#info_email').val()+'" placeholder="请输入邮箱" required=""  lay-verify="email" autocomplete="off" class="layui-input"></div></div><div class="layui-form-item"><label class="layui-form-label identify-btn" id="email_code_btn">获取验证码</label><div class="layui-input-block"><input type="text" id="email_code_input" name="code" value="" placeholder="请输入邮件验证码" required="" lay-verify="number" autocomplete="off" class="layui-input"></div></div><div class="layui-form-item"><button class="layui-btn layui-btn-fluid layui-btn-orange" lay-submit="" lay-filter="change">确定</button></div></form>',
            success: function(layero, index){
                $("#email_code_btn").click(function(){
                    var email_input = $("#email_input"),email_code_input = $("#email_code_input"),email_code_btn = $(this);
                    if(!/^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/.test(email_input.val())){
                        layer.msg('邮箱格式错误', {icon: 5,anim: 6})
                        return !1
                    }
                    if($(this).hasClass('identify-disable')){return false;}

                    fly.json('/user/validateemail', {email:email_input.val()}, function(res){
                        layer.msg(res.msg, {icon: 1,time: 1E3})
                    }, {
                        error: function(){
                            email_code_input.val('');
                            email_code_btn.addClass("identify-disable");
                            $(".layer-open input[name=code]").focus();
                            smsTime(email_code_btn);
                        }
                    });
                });
                $(".layer-open input[name=email]").focus();
                form.on('submit(change)',function(data){
                    if(data.field.email == $('#info_email').text()){
                        layer.msg("邮箱没有任何变化", {icon: 2,anim: 6});
                        return !1;
                    }

                    fly.json('/user/changeemail', data.field, function(res){
                        layer.msg("修改成功", {icon: 1,time: 1E3}, function(){location.reload();});
                    });
                    return !1;
                });
            }
        });
    });


    //上传图片
    if($('.upload-img')[0]){
        layui.use('upload', function(upload){
            var avatarAdd = $('.avatar-add');

            upload.render({
                elem: '.upload-img'
                ,url: '/user/upload/'
                ,size: 50
                ,before: function(){
                    avatarAdd.find('.loading').show();
                }
                ,done: function(res){
                    if(res.status == 0){
                        $.post('/user/set/', {
                            avatar: res.url
                        }, function(res){
                            location.reload();
                        });
                    } else {
                        layer.msg(res.msg, {icon: 5});
                    }
                    avatarAdd.find('.loading').hide();
                }
                ,error: function(){
                    avatarAdd.find('.loading').hide();
                }
            });
        });
    }

    //发布封面图上传
    var uploadInst = upload.render({
        elem: '#test1'
        ,url: '/upload/'
        ,before: function(obj){
            //预读本地文件示例，不支持ie8
            obj.preview(function(index, file, result){
                $('#demo1').attr('src', result); //图片链接（base64）
            });
        }
        ,done: function(res){
            //如果上传失败
            if(res.code > 0){
                return layer.msg('上传失败');
            }
            //上传成功
        }
        ,error: function(){
            //演示失败状态，并实现重传
            var demoText = $('#demoText');
            demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
            demoText.find('.demo-reload').on('click', function(){
                uploadInst.upload();
            });
        }
    });

    //验证规则
    form.verify({
        resRequired: [
            /[\S]+/
            ,'请上传组件资源包'
        ]
    });
    //上传组件
    var elemRes = $('#FLY-extend-res')
    upload.render({
        elem: '#FLY-extend-upload'
        ,url: '/api/upload/file'
        ,accept: 'file'
        ,exts: 'zip|rar|7z'
        ,size: 3*1000*2014
        ,done: function(res){
            if(res.status == 0){
                elemRes.val(res.url);
                this.elem.find('p').html(res.filename);
                layer.msg('文件上传成功', {icon: 1});
            } else {
                layer.msg(res.msg, {icon: 5});
            }
        }
    });

    //提交成功后的回调
    fly.form['extendRelease'] = function(field, elem, res){
        layer.alert(res.msg, {
            icon: 1
            ,btnAlign: 'c'
            ,btn: ['朕已知晓']
            ,end: function(){
                location.href = '/user/extend/';
            }
        });
    };

  exports('user', null);
  
});