<!DOCTYPE html>
<html style="background-color: #e2e2e2;">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>发现 Layui 2017 年度最佳案例</title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <link rel="stylesheet" href="http://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{asset('static/home/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{asset('static/plugins/swiper/4.5.0/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('static/home/css/global.css')}}">
    @yield('style')
</head>
<body class="fly-full">

@include('home.common.header')
@yield('content')
@include('home.common.footer')

<script src="{{ asset('static/home/layui/layui.js') }}"></script>
<script src="{{ asset('static/plugins/jquery/3.4.1/jquery.min.js') }}"></script>
<script src="{{ asset('static/plugins/swiper/4.5.0/js/swiper.min.js') }}"></script>
<script src="{{ asset('static/home/mods/global.js') }}"></script>
@yield('script')
</body>
</html>