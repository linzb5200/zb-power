@extends('home.layouts.base')
@section('style')

@endsection

@section('content')
    <div class="fly-case-header fly-bg-white">
        <div class="fly-search-big search-area">
            @include('home.common.search')
        </div>
        <div class="breadcrumb-search">
            <div class="breadcrumb mb-10 ">
                <cite>用途：</cite>
                <span class="layui-breadcrumb" lay-separator=" " style="visibility: visible;">
        <a href="/{{$cateInfo['pinyin']}}/" class="active">全部</a><span lay-separator=""> </span>
                    @foreach($categorys as $category)
        <a href="/{{$cateInfo['pinyin']}}/{{$category['pinyin']}}/">{{$category['title']}}</a><span lay-separator=""> </span>
                    @endforeach
      </span>
            </div>
            <div class="breadcrumb mb-10 ">
                <cite>行业：</cite>
                <span class="layui-breadcrumb"  lay-separator=" " style="visibility: visible;">
        <a href="#" class="active">全部</a><span lay-separator=""> </span>
        <a href="#">通用</a><span lay-separator=""> </span>
        <a href="#">科技</a><span lay-separator=""> </span>
        <a href="#">教育</a><span lay-separator=""> </span>
        <a href="#">教育</a><span lay-separator=""> </span>
        <a href="#">互联网</a><span lay-separator=""> </span>
        <a href="#">党政</a><span lay-separator=""> </span>
        <a href="#">金融</a><span lay-separator=""> </span>
        <a href="#">金融</a><span lay-separator=""> </span>
        <a href="#">能源通讯</a><span lay-separator=""> </span>
        <a href="#">房地产</a><span lay-separator=""> </span>
        <a href="#">广告</a><span lay-separator=""> </span>
        <a href="#">旅游</a><span lay-separator=""> </span>
        <a href="#">交通物流</a><span lay-separator=""> </span>
        <a href="#">医药医疗</a><span lay-separator=""> </span>
        <a href="#">影视传媒</a><span lay-separator=""> </span>
        <a href="#">影视传媒</a><span lay-separator=""> </span>
        <a href="#">文艺</a><span lay-separator=""> </span>
        <a href="#">运动</a><span lay-separator=""> </span>
        <a href="#">其他</a><span lay-separator=""> </span>
      </span>
            </div>
            <div class="breadcrumb mb-10">
                <cite>风格：</cite>
                <span class="layui-breadcrumb"  lay-separator=" " style="visibility: visible;">

        <a href="#" class="active">全部</a><span lay-separator=""> </span>
        <a href="#">商务</a><span lay-separator=""> </span>
        <a href="#">简约</a><span lay-separator=""> </span>
        <a href="#">复古</a><span lay-separator=""> </span>
        <a href="#">中国风</a><span lay-separator=""> </span>
        <a href="#">中国风</a><span lay-separator=""> </span>
        <a href="#">韩范</a><span lay-separator=""> </span>
        <a href="#">欧美</a><span lay-separator=""> </span>
        <a href="#">可爱</a><span lay-separator=""> </span>
        <a href="#">梦幻</a><span lay-separator=""> </span>
        <a href="#">创意</a><span lay-separator=""> </span>
        <a href="#">酷炫</a><span lay-separator=""> </span>
        <a href="#">另类</a><span lay-separator=""> </span>
        <a href="#">清新淡雅</a><span lay-separator=""> </span>
        <a href="#">扁平</a><span lay-separator=""> </span>
        <a href="#">卡通动漫</a><span lay-separator=""> </span>
        <a href="#">其他</a><span lay-separator=""> </span>
      </span>
            </div>
        </div>
    </div>


    <div class="fly-main" style="overflow: hidden; ">

        <div class="fly-filter">
            <div class="layui-tab layui-tab-brief order-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this"><a href="">综合排序</a></li>
                    <li><a href="">热门下载</a></li>
                    <li><a href="">最多收藏</a></li>
                    <li><a href="">最新上传</a></li>
                    <li class="fr" style="width: 400px;">
                    </li>
                </ul>
            </div>

            <div class="filter-tab">

                <ul class="layui-nav layui-layout-right layui-bg-black" lay-filter="">
                    <li class="layui-nav-item">
                        <a href="javascript:;">色系</a>
                        <dl class="layui-nav-child">
                            <dd><a href="">红色</a></dd>
                            <dd><a href="">黑色</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">软件</a>
                        <dl class="layui-nav-child">
                            <dd><a href="#">PowerPoint 2003</a></dd>
                            <dd><a href="#">PowerPoint 2007</a></dd>
                            <dd><a href="#">PowerPoint 2010</a></dd>
                            <dd><a href="#">PowerPoint 2016</a></dd>
                            <dd><a href="#">其他版本</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">类型</a>
                        <dl class="layui-nav-child">
                            <dd><a href="">动态模版</a></dd>
                            <dd><a href="">静态模版</a></dd>
                        </dl>
                    </li>
                </ul>

            </div>

        </div>

        <ul class="fly-case-list">
            @foreach($items as $item)
            <li data-id="123">
                <div class="fly-case-img ahref" href="/{{$cateInfo['pinyin']}}/{{$allCate[$item['cate_id']]['pinyin']}}/{{$item['id']}}" target="_blank" >
                    <img src="{{ getImagePath($item['thumb']) }}" alt="">
                    <div class="tool">
                        <cite class="layui-btn layui-btn-boss layui-btn-small">立即下载</cite>
                        <div class="btn">
                            <i class="iconfont icon-zan"></i>
                            <i class="layui-icon">&#xe600;</i>
                        </div>
                    </div>
                </div>

                <h2><a href="/{{$cateInfo['pinyin']}}/{{$allCate[$item['cate_id']]['pinyin']}}/{{$item['id']}}" target="_blank">{{$item['title']}}</a></h2>
                <div class="fly-case-dash">
                    <button class="layui-btn layui-btn-transparent " data-type="download"><i class="fa fa-download"></i>{{$item['download']+$item['rand_download']}}</button>
                    <button class="layui-btn layui-btn-transparent fly-case-active" data-type="praise"><i class="layui-icon">&#xe600;</i>{{$item['fav']+$item['rand_fav']}}</button>
                </div>
            </li>
            @endforeach
        </ul>

        <!-- <blockquote class="layui-elem-quote layui-quote-nm">暂无数据</blockquote> -->

        <div style="text-align: center;">
            <div class="laypage-main">
                <span class="laypage-curr">1</span>
                <a href="">2</a><a href="">3</a>
                <a href="">4</a>
                <a href="">5</a>
                <span>…</span>
                <a href="" class="laypage-last" title="尾页">尾页</a>
                <a href="" class="laypage-next">下一页</a>
            </div>
        </div>

    </div>


@endsection

@section('script')

@endsection