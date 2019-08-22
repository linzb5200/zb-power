<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登入 / 注册</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{asset('static/home/layui/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('static/home/layui/style/user.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('static/home/layui/style/login.css')}}" media="all">
</head>
<body>

<div class="layadmin-user-login layadmin-user-display-show" >

    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2></h2>
            <p></p>
        </div>
        @yield('content')
    </div>

    <div class="layui-trans layadmin-user-login-footer">

        <p>© 2018 </p>
        <p hidden>
            <span><a href="http://www.layui.com/admin/#get" target="_blank">获取授权</a></span>
            <span><a href="http://www.layui.com/admin/pro/" target="_blank">在线演示</a></span>
            <span><a href="http://www.layui.com/admin/" target="_blank">前往官网</a></span>
        </p>
    </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{asset('static/home/layui/layui.js')}}"></script>
<script src="{{asset('static/home/js/common.js')}}"></script>
@yield('script')
</body>
</html>