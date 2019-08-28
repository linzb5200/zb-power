
<div class="fly-header layui-bg-black">
    <div class="layui-container">
        <a class="fly-logo" href="/">
            <img src="/static/home/images/logo.png" alt="layui">
        </a>

        <ul class="layui-nav layui-layout-left layui-bg-white " lay-filter="">

            @foreach($navs as $key => $nav)
            <li class="layui-nav-item">
                <a href="/@if($nav['pinyin']!=''){{$nav['pinyin']}}@endif/">{{$nav['title']}}</a>
                @if($nav['children'])
                <dl class="layui-nav-child">
                    @foreach($nav['children'] as $child)
                        <dd><a href="/@if($nav['pinyin']!=''){{$nav['pinyin']}}@endif/@if($child['pinyin']!=''){{$child['pinyin']}}/@endif">{{$child['title']}}</a></dd>
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