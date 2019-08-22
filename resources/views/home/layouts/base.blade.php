<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="X-UA-Compatible" content="IE=9"/>
    <meta name="HandheldFriendly" content="true"/>
    <meta name="renderer" content="webkit"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('static/home/img/favicon.png')}}" />
    <link rel="icon" type="image/x-icon" href="{{asset('static/home/img/favicon.png')}}" />
    <title>精品PPT模板下载</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <title>精品PPT模板下载</title>
    <link rel="stylesheet" href="http://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{asset('static/plugins/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{asset('static/plugins/swiper/4.5.0/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('static/home/css/common.css')}}">
    <link rel="stylesheet" href="{{asset('static/home/css/response.css')}}">
    <link rel="stylesheet" href="{{asset('static/home/css/template.css')}}">
    @yield('style')

</head>
<body>
<div class="container">
    @include('home.layouts.header')
    <div class="clearboth"></div>
    <div class="body-box">
        @yield('content')
    </div>
    <div class="clearboth"></div>
    @include('home.layouts.footer')
    <div class="clearboth"></div>
    <div class="sider-box">
    </div>
</div>



<script src="{{ asset('static/plugins/jquery/3.4.1/jquery.min.js') }}"  type="text/javascript"></script>

<!--[if lt IE 9]>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
<script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="{{ asset('static/plugins/layui/layui.all.js') }}"  type="text/javascript"></script>
<script src="{{ asset('static/plugins/swiper/4.5.0/js/swiper.min.js') }}"  type="text/javascript"></script>
<script src="{{ asset('static/home/js/common.js') }}"  type="text/javascript"></script>
@yield('script')
</body>
</html>