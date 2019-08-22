<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{settings('webtitle')}}</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.bootcss.com/font-awesome/5.10.0-11/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('static/admin/layuiadmin/layui/css/layui.css')}}" media="all">
    <link href="{{ asset('static/plugins/layui-formselects/formSelects-v4.css') }}" rel="stylesheet" >
    <link rel="stylesheet" href="{{asset('static/admin/layuiadmin/style/admin.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('static/admin/css/common.css')}}" media="all">

</head>
<body>

<div class="layui-fluid">
    @yield('content')
</div>

<div class="fancybox-container" hidden>
    <a href="" class="fancybox"><img src="" width="120"></a>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/socket.io.js')}}"></script>
<script src="{{asset('static/admin/layuiadmin/layui/layui.all.js')}}"></script>
<script src="{{ asset('static/plugins/layui-formselects/formSelects-v4.js') }}"></script>
<script>

    function nofind(src = "{{asset('img/media_ico/ico-ppt.png')}}") {
        var img=event.srcElement;
        img.src=src;
        img.onerror = null;
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    layui.config({
        base: '/static/admin/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index', //主入口模块
    }).use(['element','form','layer','table','upload','laydate'],function () {
        var layer = layui.layer;

        //错误提示
        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                layer.msg("{{$error}}",{icon:5});
                @break
            @endforeach
        @endif

        //信息提示
        @if(session('status'))
            layer.msg("{{session('status')}}",{icon:6});
        @endif

        //监听消息推送
        {{--$(document).ready(function () {--}}
            {{--// 连接服务端--}}
            {{--var socket = io("{{config('custom.PUSH_MESSAGE_LOGIN')}}");--}}
            {{--// 连接后登录--}}
            {{--socket.on('connect', function () {--}}
                {{--socket.emit('login', "{{auth()->user()->uuid}}");--}}
            {{--});--}}
            {{--// 后端推送来消息时--}}
            {{--socket.on('new_msg', function (title, content) {--}}
                {{--//弹框提示--}}
                {{--layer.open({--}}
                    {{--title: title,--}}
                    {{--content: content,--}}
                    {{--offset: 'rb',--}}
                    {{--anim: 1,--}}
                    {{--time: 5000--}}
                {{--})--}}
            {{--});--}}
        {{--});--}}

    });

    var formSelects = layui.formSelects;

</script>
<script src="{{asset('static/admin/js/common.js')}}"></script>
@yield('script')
</body>
</html>



