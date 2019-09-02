
<ul class="layui-nav layui-nav-tree layui-inline" lay-filter="user">

    <li class="layui-nav-item">
        <a href="{{route('home.blog',['id'=>auth()->guard('member')->user()->id]) }}">
            <i class="layui-icon">&#xe68e;</i>
            我的主页
        </a>
    </li>
    <li class="layui-nav-item @if(in_array($site['curl'],['/user'])) layui-this @endif">
        <a href="{{route('home.user')}}">
            <i class="layui-icon">&#xe665;</i>
            用户中心
        </a>
    </li>
    <li class="layui-nav-item @if(in_array($site['curl'],['/user/profile'])) layui-this @endif">
        <a href="{{route('home.user.profile')}}">
            <i class="layui-icon">&#xe620;</i>
            个人资料
        </a>
    </li>
    <li class="layui-nav-item @if(in_array($site['curl'],['/user/finance'])) layui-this @endif">
        <a href="{{route('home.user.finance')}}">
            <i class="layui-icon">&#xe65e;</i>
            财务管理
        </a>
    </li>
    <li class="layui-nav-item @if(in_array($site['curl'],['/user/content'])) layui-this @endif">
        <a href="{{route('home.user.content')}}">
            <i class="layui-icon">&#xe705;</i>
            内容管理
        </a>
    </li>
</ul>
