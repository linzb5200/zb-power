@extends('admin.base')
@section('style')
    <link href="{{ asset('static/plugins/spectrum/spectrum.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('static/plugins/ueditor/themes/default/css/ueditor.css') }}" rel="stylesheet" >
@endsection
@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加</h2>

        </div>
        <div class="layui-card-body" style="width: 850px;">
            <form class="layui-form" action="{{route('admin.products.store')}}" method="post">
                @include('admin.products.product._form')
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        layui.use(['layer','upload'],function () {
            uploadImage('#uploadButton','{{ route("uploadImg",['path'=>'thumb']) }}&w=400&h=300',false);
            uploadAttach('#uploadButton1','{{ route("uploadImg",['path'=>'attach']) }}',true);
        });
        formSelects.data('cate_str', 'server', {
            url: '{{ route("linkCate") }}',
            linkage: true,
            linkageWidth: 120   //代表每一级别的宽度, 默认是100
        });
    </script>

    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        UE.Editor.prototype._bkGetActionUrl = UE.Editor.prototype.getActionUrl;
        UE.Editor.prototype.getActionUrl = function(action) {
            if (action == 'uploadimage' || action == 'uploadscrawl' || action == 'uploadimage') {
                return '/upload/ueditor';
            } else if (action == 'uploadvideo') {
                return '/upload/ueditor/video';
            } else {
                return this._bkGetActionUrl.call(this, action);
            }
        };
        var ue = UE.getEditor('container',{
            initialFrameWidth : 800
        });
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        });
    </script>
@endsection