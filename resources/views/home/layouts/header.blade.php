
<div class="header-box layui-bg-white">
    <div class="layui-fluid">
        <a href="/" class="logo"><img src="{{asset('static/home/img/logo.png')}}" style="" alt=""></a>

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

        <ul class="layui-nav layui-layout-right layui-bg-white" hidden>
            <li class="layui-nav-item">
                <a href="javascript:;">帮助中心<span class="layui-nav-more"></span></a>
                <dl class="layui-nav-child layui-anim layui-anim-upbit">
                    <dd><a href="">使用教程</a></dd>
                    <dd><a href="">使用原则</a></dd>
                    <dd><a href="">合作推广</a></dd>
                    <dd><a href="">运营导航</a></dd>
                </dl>
            </li>


            <li class="layui-nav-item"><a href="javascript:;" id="float-login">登录</a></li>
            <li class="layui-nav-item"><a href="javascript:;" id="float-register">注册</a></li>
            <span class="layui-nav-bar" style="left: 34px; top: 55px; width: 0px; opacity: 0;"></span></ul>
    </div>
</div>