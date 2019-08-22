
<div class="fly-header layui-bg-black">
    <div class="layui-container">
        <a class="fly-logo" href="/">
            <img src="https://bdn.135editor.com/files/201812/135whitelogo.png" style="" alt="">
        </a>
        <ul class="layui-nav fly-nav layui-hide-xs" hidden>
            <li class="layui-nav-item layui-this">
                <a href="/"><i class="iconfont icon-jiaoliu"></i>交流</a>
            </li>
        </ul>

        <ul class="layui-nav fly-nav-user">
            <!-- 登入后的状态 -->
            <li class="layui-nav-item">
                <a class="fly-nav-avatar" href="javascript:;">
                    <cite class="layui-hide-xs"> </cite>
                    <i class="iconfont icon-renzheng layui-hide-xs" title=""></i>
                    <i class="layui-badge fly-badge-vip layui-hide-xs">VIP3</i>
                    <img src="https://tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg">
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="{{route('home.member.info')}}">个人信息</a></dd>
                    <dd><a href="{{route('home.member.permission')}}">我的权限</a></dd>
                    <dd><a href="{{route('home.member.orders')}}">我的订单</a></dd>
                    <dd><a href="{{route('home.member.message')}}">我的消息</a></dd>
                    <dd><a href="javascript:;" class="edit_pwd">修改密码</a></dd>
                    <hr style="margin: 5px 0;">
                    <dd><a href="{{route('home.member.logout')}}" style="text-align: center;">退出</a></dd>
                </dl>
            </li>
        </ul>
    </div>
</div>