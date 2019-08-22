@extends('home.member.layouts.default')

@section('content')
    <div style="padding: 20px; ">
        <form class="layui-form layui-form-pane" action="">
            <div class="layui-form-item" pane="">
                <label class="layui-form-label">存储选项</label>
                <div class="layui-input-block">
                    <input type="radio" name="save_type" value="1" title="我的文章" checked="" lay-filter="type">
                    <input type="radio" name="save_type" value="2" title="我的模板" lay-filter="type">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">图文标题</label>
                <div class="layui-input-block">
                    <input type="text" name="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">封面图片</label>
                <div class="layui-input-inline">
                    <input type="text" name="thumb" autocomplete="off" placeholder="" class="layui-input">
                </div>
                <div class="layui-input-inline">
                    <input type="checkbox" name="is_thumb" lay-skin="primary" title="正文中显示封面图" checked="">
                </div>
            </div>

            <div class="layui-form-item">
                <div class="col-sm-12 pull-left">
                    <button class="layui-btn layui-btn-sm">选择封面</button>
                    <button class="layui-btn layui-btn-sm">无版权封面</button>
                    <button class="layui-btn layui-btn-sm">设计封面首图</button>
                    <button class="layui-btn layui-btn-sm">设计封面次图</button>
                    <button class="layui-btn layui-btn-sm">上传封面</button>
                </div>
            </div>
            <div class="layui-form-item save-1">
                <label class="layui-form-label">图文作者</label>
                <div class="layui-input-block">
                    <input type="text" name="author" autocomplete="off" placeholder="请输入图文作者" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item save-1">
                <label class="layui-form-label">原文链接</label>
                <div class="layui-input-block">
                    <input type="text" name="original_link" autocomplete="off" placeholder="请输入原文链接" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text save-1">
                <label class="layui-form-label">图文摘要</label>
                <div class="layui-input-block">
                    <textarea name="excerpt" placeholder="如果不填写会默认抓取正文前54个字" class="layui-textarea"></textarea>
                </div>
            </div>
            <textarea name="content" style="display: none" id="content"></textarea>
            <div class="layui-form-item">
                <button class="layui-btn" lay-submit="submit" lay-filter="save">保存到我的文章</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        layui.use(['layer','form'],function () {
            var layer = layui.layer;
            var form = layui.form;

            form.on('radio(type)', function(data){
                if (data.value == 1) {
                    $('.save-1').show();
                    $('.save-2').hide();
                    $('button[lay-submit="submit"]').text('保存到我的文章');
                } else {
                    $('.save-2').show();
                    $('.save-1').hide();
                    $('button[lay-submit="submit"]').text('保存到我的模版');
                }
                form.render();
            });

            form.on('submit(save)', function(data){
                var content = window.parent.editor.getContent();
                data.field.content = content;
                var called = function(){
                    setTimeout(function(){
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                    },1000);
                };
                postTo('/member/save/create',data.field,called);

                return false;
            });
        });


    </script>
@endsection