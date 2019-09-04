
<ul class="layui-nav layui-nav-tree layui-inline" lay-filter="user">

    <li class="layui-nav-item">
        <a href="{{route('home.blog',['id'=>auth()->guard('member')->user()->id]) }}">
            <i class="layui-icon">&#xe68e;</i>
            我的主页
        </a>
    </li>
    <li class="layui-nav-item @if(in_array($site['curl'],['/user'])) layui-this @endif">
        <a href="{{route('home.user')}}">
            <i class="layui-icon">&#xe612;</i>
            用户中心
        </a>
    </li>
    <li class="layui-nav-item @if(in_array($site['curl'],['/user/profile'])) layui-this @endif">
        <a href="{{route('home.user.profile')}}">
            <i class="layui-icon">&#xe620;</i>
            个人资料
        </a>
    </li>
    <li class="layui-nav-item @if(in_array($site['curl'],['/user/details/score','/user/details/recharge'])) layui-this @endif">
        <a href="{{route('home.user.details.score')}}">
            <i class="layui-icon">&#xe65e;</i>
            财务管理
        </a>
    </li>

    <li class="layui-nav-item @if(in_array($site['curl'],['/user/mine','/user/mine/fav','/user/mine/down'])) layui-this @endif">
        <a href="{{route('home.user.mine')}}">
            <i class="layui-icon">&#xe656;</i>
            我的模板
        </a>
    </li>
</ul>
