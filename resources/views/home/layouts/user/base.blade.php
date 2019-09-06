
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户中心</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="fly,layui,前端社区">
    <meta name="description" content="Fly社区是模块化前端UI框架Layui的官网社区，致力于为web开发提供强劲动力">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <link rel="stylesheet" href="http://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{asset('static/home/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{asset('static/home/css/global.css')}}">
    <link rel="stylesheet" href="{{asset('static/home/css/user.css')}}">
</head>
<body>

@include('home.common.header')

<div class="layui-container fly-marginTop fly-user-main">
    @include('home.common.user.nav')

    @yield('content')
</div>

@include('home.common.footer')

<script src="{{ asset('static/home/layui/layui.js') }}"></script>
<script src="{{ asset('static/plugins/jquery/3.4.1/jquery.min.js') }}"></script>
<script src="{{ asset('static/home/mods/global.js') }}"></script>
<script src="{{ asset('static/home/mods/user.js') }}"></script>

</body>
</html>