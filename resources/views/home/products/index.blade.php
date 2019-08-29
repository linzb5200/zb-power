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
        <a href="/{{$cateInfo['zm']}}/" class="active">全部</a><span lay-separator=""> </span>
                    @foreach($categorys as $category)
        <a href="/{{$cateInfo['zm']}}/{{$category['zm']}}/">{{$category['title']}}</a><span lay-separator=""> </span>
                    @endforeach
      </span>
            </div>
            <div class="breadcrumb mb-10 ">
                <cite>行业：</cite>
                <span class="layui-breadcrumb"  lay-separator=" " style="visibility: visible;">
        <a href="#" class="active">全部</a><span lay-separator=""> </span>
                    @foreach($costTrades as $ct)
                        <a href="/{{$cateInfo['zm']}}/{{$ct['zm']}}/">{{$ct['name']}}</a><span lay-separator=""> </span>
                    @endforeach
      </span>
            </div>
            <div class="breadcrumb mb-10">
                <cite>风格：</cite>
                <span class="layui-breadcrumb"  lay-separator=" " style="visibility: visible;">

        <a href="#" class="active">全部</a><span lay-separator=""> </span>
                    @foreach($costStyles as $cs)
                        <a href="/{{$cateInfo['zm']}}/{{$cs['zm']}}/">{{$cs['name']}}</a><span lay-separator=""> </span>
                    @endforeach
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
                <div class="fly-case-img ahref" href="/{{$cateInfo['zm']}}/{{$costCate[$item['cate_id']]['zm']}}/{{$item['id']}}" target="_blank" >
                    <img src="{{ getImagePath($item['thumb']) }}" alt="">
                    <div class="tool">
                        <cite class="layui-btn layui-btn-boss layui-btn-small">立即下载</cite>
                        <div class="btn">
                            <i class="iconfont icon-zan"></i>
                            <i class="layui-icon">&#xe600;</i>
                        </div>
                    </div>
                </div>

                <h2><a href="/{{$cateInfo['zm']}}/{{$costCate[$item['cate_id']]['zm']}}/{{$item['id']}}" target="_blank">{{$item['title']}}</a></h2>
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