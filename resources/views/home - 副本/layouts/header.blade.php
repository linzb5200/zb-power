
<div class="fly-header layui-bg-black">
    <div class="layui-fluid">
        <a class="fly-logo" href="/">
            <img src="https://bdn.135editor.com/files/201812/135whitelogo.png" style="" alt="">
        </a>
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item layui-this">
                <a href="">首页</a>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">素材库</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{route('material.style.index')}}">样式中心</a></dd>
                    <dd><a href="{{route('material.tpl.index')}}">模板中心</a></dd>
                    <dd><a href="{{route('material.color.index')}}">配色方案</a></dd>
                </dl>
            </li>
        </ul>

        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">帮助中心</a>
                <dl class="layui-nav-child">
                    <dd><a href="">使用教程</a></dd>
                    <dd><a href="">使用原则</a></dd>
                    <dd><a href="">合作推广</a></dd>
                    <dd><a href="">运营导航</a></dd>
                </dl>
            </li>


            @if(auth()->guard('member')->check())
            <li class="layui-nav-item">
                <a class="fly-nav-avatar" href="javascript:;">
                    <cite class="layui-hide-xs">{{ auth('member')->user()->name }}</cite>
                    <i class="iconfont icon-renzheng layui-hide-xs" title="认证信息：layui 作者"></i>
                    <i class="layui-badge fly-badge-vip layui-hide-xs">VIP3</i>
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="/member" title="" >编辑资料</a></dd>
                    <dd><a href="/member/permission" title="" >我的权限</a></dd>
                    <dd><a href="/member/orders" title="" >我的订单</a></dd>
                    <dd><a href="/member/set/pwd" title="" >修改密码</a></dd>
                    <dd><a href="/member/logout" >退出</a></dd>
                </dl>
            </li>
            @else
                <li class="layui-nav-item"><a href="javascript:;" id="float-login">登录</a></li>
                <li class="layui-nav-item"><a href="javascript:;" id="float-register">注册</a></li>
            @endif
        </ul>
    </div>
</div>