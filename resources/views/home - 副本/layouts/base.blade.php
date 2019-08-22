<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title></title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('static/home/layui/css/layui.css') }}">
    @yield('style')
    <link rel="stylesheet" href="{{ asset('static/home/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('static/home/css/index.css') }}">
</head>
<body>

@include('home.layouts.header')
<div class="layui-fluid fly-user-main ">
    @include('home.layouts.nav')

    <div class="fly-panel fly-panel-user" >
    @yield('content')
    </div>
    <div class="fly-index-footer layui-bg-black">
        © layui.com - 底部固定区域
    </div>
</div>
<script src="{{ asset('js/jquery.min.js') }}"  type="text/javascript"></script>
<script src="{{ asset('static/home/layui/layui.all.js') }}"  type="text/javascript"></script>
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var element = layui.element;
    var layer = layui.layer;
    var form = layui.form;
    var table = layui.table;
    var upload = layui.upload;

    form.render();
    element.render();

    //统一错误提示信息
    @if(count($errors)>0)
    var errorStr = '';
    @foreach($errors->all() as $error)
        errorStr += "{{$error}}<br />";
    @endforeach
        layer.msg(errorStr);
    @endif

    @if(session('status'))
        layer.msg("{{session('status')}}");
    @endif

</script>

@yield('script')
</body>
</html>