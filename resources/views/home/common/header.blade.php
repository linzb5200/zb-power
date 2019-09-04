
<div class="fly-header layui-bg-black">
    <div class="layui-container">
        <a class="fly-logo" href="/">
            <img src="/static/home/images/logo1.png" alt="layui">
        </a>

        <ul class="layui-nav layui-layout-left layui-bg-white " lay-filter="">

            @foreach($nav as $key => $nv)
            <li class="layui-nav-item">
                <a href="/@if($nv['zm']!=''){{$nv['zm']}}@endif/">{{$nv['title']}}</a>
                @if($nv['children'])
                <dl class="layui-nav-child">
                    @foreach($nv['children'] as $child)
                        <dd><a href="/@if($nv['zm']!=''){{$nv['zm']}}@endif/@if($child['zm']!=''){{$child['zm']}}/@endif">{{$child['title']}}</a></dd>
                    @endforeach
                </dl>
                @endif
            </li>
            @endforeach

        </ul>


        <ul class="layui-nav fly-nav-user">
        @if(auth()->guard('member')->check())
            <!-- 登入后的状态 -->
            <li class="layui-nav-item">
                <a class="fly-nav-avatar" href="javascript:;">
                    <cite class="layui-hide-xs"> </cite>
                    <i class="iconfont icon-renzheng layui-hide-xs" title=""></i>
                    <i class="layui-badge fly-badge-vip layui-hide-xs">VIP3</i>
                    <img src="https://tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg">
                </a>
                <dl class="layui-nav-child">

                    <dd><a href="{{route('home.user.mine.add')}}" title="" >上传作品</a></dd>
                    <hr style="margin: 5px 0;">
                    <dd><a href="{{route('home.blog',['id'=>auth()->guard('member')->user()->id]) }}" title="" >我的主页</a></dd>
                    <dd><a href="{{route('home.user.mine')}}" title="" >我的模板</a></dd>
                    <hr style="margin: 5px 0;">
                    <dd><a href="{{route('home.user')}}" title="" >用户中心</a></dd>
                    <dd><a href="{{route('home.user.profile')}}" title="" >个人资料</a></dd>
                    <hr style="margin: 5px 0;">
                    <dd><a href="{{route('home.user.logout')}}" style="text-align: center;">退出</a></dd>
                </dl>
            </li>
            @else
            <!-- 未登入的状态 -->
                <li class="layui-nav-item">
                    <a class="iconfont icon-touxiang layui-hide-xs" href="../user/login.html"></a>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;" class="fly-login">快速登入</a>
                </li>
            @endif
        </ul>

    </div>
</div>