
<div class="fly-header layui-bg-black">
    <div class="layui-container">
        <a class="fly-logo" href="/">
            <img src="/static/home/images/logo.png" alt="layui">
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

            <!-- 未登入的状态 -->
            <li class="layui-nav-item">
                <a class="iconfont icon-touxiang layui-hide-xs" href="../user/login.html"></a>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;" class="fly-login">快速登入</a>
            </li>

        </ul>
    </div>
</div>