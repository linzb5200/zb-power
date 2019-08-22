
<ul class="layui-nav layui-nav-tree layui-inline" lay-filter="user">
    <li class="layui-nav-item">
        <a href="{{route('home')}}">
            <i class="layui-icon">&#xe68e;</i>
            返回编辑器
        </a>
    </li>


    <li class="layui-nav-item @if(in_array($site['curl'],['/member/info','/member/permission','/member/orders','/member/invitation','/member/message','/member/feedback','/member/log_login'])) layui-nav-itemed @endif">
        <a href="javascript:;"><i class="layui-icon">&#xe612;</i>用户中心</a>
        <dl class="layui-nav-child"> <!-- 二级菜单 -->
            <dd><a href="{{route('home.member.info')}}">个人信息</a></dd>
            <dd><a href="{{route('home.member.permission')}}">我的权限</a></dd>
            <dd><a href="{{route('home.member.orders')}}">我的订单</a></dd>
            <dd><a href="{{route('home.member.invitation')}}">我的邀请</a></dd>
            <dd><a href="{{route('home.member.message')}}">我的消息</a></dd>
            <dd><a href="{{route('home.member.feedback')}}">我的反馈</a></dd>
            <dd><a href="javascript:;" class="edit_pwd">修改密码</a></dd>
            <dd><a href="{{route('home.member.log_login')}}">登录记录</a></dd>
        </dl>
    </li>
    <li class="layui-nav-item @if(in_array($site['curl'],['/member/picture'])) layui-nav-itemed @endif">
        <a href="{{route('home.member.picture')}}">
            <i class="layui-icon">&#xe64a;</i>
            我的图片
        </a>
    </li>
    <li class="layui-nav-item @if(in_array($site['curl'],['/member/fav_style','/member/fav_tpl','/member/fav_color','/member/fav_video','/member/fav_gif'])) layui-nav-itemed @endif">
        <a href="javascript:;"><i class="layui-icon">&#xe67b;</i>我收藏的</a>
        <dl class="layui-nav-child"> <!-- 二级菜单 -->
            <dd><a href="{{route('home.member.fav_style')}}" class="active">收藏的样式</a></dd>
            <dd><a href="{{route('home.member.fav_tpl')}}">收藏的模板</a></dd>
            <dd><a href="{{route('home.member.fav_color')}}">收藏的配色</a></dd>
            <dd><a href="{{route('home.member.fav_video')}}">收藏的视频</a></dd>
            <dd><a href="{{route('home.member.fav_gif')}}">收藏的动图</a></dd>
        </dl>
    </li>
    <li class="layui-nav-item @if(in_array($site['curl'],['/member/save_style','/member/save_tpl','/member/save_art'])) layui-nav-itemed @endif">
        <a href="javascript:;"><i class="layui-icon">&#xe60a;</i>我保存的</a>
        <dl class="layui-nav-child"> <!-- 二级菜单 -->
            <dd><a href="{{route('home.member.save_style')}}">保存的样式</a></dd>
            <dd><a href="{{route('home.member.save_tpl')}}">保存的模板</a></dd>
            <dd><a href="{{route('home.member.save_art')}}">保存的文章</a></dd>
        </dl>
    </li>
</ul>

<div class="site-tree-mobile layui-hide">
    <i class="layui-icon">&#xe602;</i>
</div>
<div class="site-mobile-shade"></div>

<div class="site-tree-mobile layui-hide">
    <i class="layui-icon">&#xe602;</i>
</div>
<div class="site-mobile-shade"></div>