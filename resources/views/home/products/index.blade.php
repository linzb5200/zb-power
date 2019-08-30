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
                <a href="{{route('products.cate',['cate'=>$cate['zm']])}}/" @if(empty($arg['zm'])) class="active" @endif >全部</a><span lay-separator=""> </span>
                @foreach($categorys as $cg)
                <a href="{{route('products.cate2',['cate'=>$cate['zm'],'zm'=>$cg['zm']])}}/"  @if($arg['zm'] == $cg['zm']) class="active" @endif >{{$cg['title']}}</a><span lay-separator=""> </span>
                @endforeach
              </span>
            </div>
            <div class="breadcrumb mb-10 ">
                <cite>行业：</cite>
                <span class="layui-breadcrumb"  lay-separator=" " style="visibility: visible;">
                <a href="{{myRoute('all_trade',0,'.html')}}"  @if(empty($arg['trade'])) class="active" @endif >全部</a><span lay-separator=""> </span>
                @foreach($costTrades as $ct)
                <a href="{{myRoute('trade',$ct['zm'],'.html')}}"  @if($arg['trade'] == $ct['zm']) class="active" @endif >{{$ct['name']}}</a><span lay-separator=""> </span>
                @endforeach
              </span>
            </div>
            <div class="breadcrumb mb-10">
                <cite>风格：</cite>
                <span class="layui-breadcrumb"  lay-separator=" " style="visibility: visible;">
                <a href="{{myRoute('all_style',0,'.html')}}" @if(empty($arg['style'])) class="active" @endif >全部</a><span lay-separator=""> </span>
                @foreach($costStyles as $cs)
                <a href="{{myRoute('style',$cs['zm'],'.html')}}" @if($arg['style'] == $cs['zm']) class="active" @endif >{{$cs['name']}}</a><span lay-separator=""> </span>
                @endforeach
              </span>
            </div>
        </div>
    </div>


    <div class="fly-main" style="overflow: hidden; ">

        <div class="fly-filter">
            <div class="layui-tab layui-tab-brief order-tab">
                <ul class="layui-tab-title">
                    <li @if($arg['sort'] == 0) class="layui-this" @endif ><a href="{{myRoute('sort',0,'.html')}}">综合排序</a></li>
                    <li @if($arg['sort'] == 1) class="layui-this" @endif ><a href="{{myRoute('sort',1,'.html')}}">热门下载</a></li>
                    <li @if($arg['sort'] == 2) class="layui-this" @endif ><a href="{{myRoute('sort',2,'.html')}}">最多收藏</a></li>
                    <li @if($arg['sort'] == 3) class="layui-this" @endif ><a href="{{myRoute('sort',3,'.html')}}">最新上传</a></li>
                    <li class="fr" style="width: 400px;">
                    </li>
                </ul>
            </div>

            <div class="filter-tab">
                <ul class="layui-nav layui-layout-left layui-bg-black" lay-filter="">
                    <li class="layui-nav-item ">
                        <a href="javascript:;">色系</a>
                        <dl class="layui-nav-child">
                            @foreach($costColors as $cc)
                                <dd  @if($arg['color'] == $cc['zm']) class="layui-this" @endif ><a href="{{myRoute('color',$cc['zm'],'.html')}}">{{$cc['name']}}</a></dd>
                            @endforeach
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">软件</a>
                        <dl class="layui-nav-child">
                            <dd  @if($arg['soft'] == 1) class="layui-this" @endif ><a href="{{myRoute('soft',1,'.html')}}">PowerPoint 2003</a></dd>
                            <dd  @if($arg['soft'] == 2) class="layui-this" @endif ><a href="{{myRoute('soft',2,'.html')}}">PowerPoint 2007</a></dd>
                            <dd  @if($arg['soft'] == 3) class="layui-this" @endif ><a href="{{myRoute('soft',3,'.html')}}">PowerPoint 2010</a></dd>
                            <dd  @if($arg['soft'] == 4) class="layui-this" @endif ><a href="{{myRoute('soft',4,'.html')}}">PowerPoint 2016</a></dd>
                            <dd  @if($arg['soft'] == 5) class="layui-this" @endif ><a href="{{myRoute('soft',5,'.html')}}">其他版本</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">类型</a>
                        <dl class="layui-nav-child">
                            <dd  @if($arg['type'] == 1) class="layui-this" @endif ><a href="{{myRoute('type',1,'.html')}}">动态模版</a></dd>
                            <dd  @if($arg['type'] == 2) class="layui-this" @endif ><a href="{{myRoute('type',2,'.html')}}">静态模版</a></dd>
                        </dl>
                    </li>
                </ul>

                <a href="{{myRoute('clear','1','.html')}}" class="reset">清空条件</a>
            </div>

        </div>

        <ul class="fly-case-list">
            @foreach($items as $item)
            <li data-id="123">
                <div class="fly-case-img ahref" href="/{{$cate['zm']}}/{{$costCate[$item['cate_id']]['zm']}}/{{$item['id']}}.html" target="_blank" >
                    <img src="{{ getImagePath($item['thumb']) }}" alt="">
                    <div class="tool">
                        <cite class="layui-btn layui-btn-boss layui-btn-small">立即下载</cite>
                        <div class="btn">
                            <i class="iconfont icon-zan"></i>
                            <i class="layui-icon">&#xe600;</i>
                        </div>
                    </div>
                </div>

                <h2><a href="/{{$cate['zm']}}/{{$costCate[$item['cate_id']]['zm']}}/{{$item['id']}}" target="_blank">{{$item['title']}}</a></h2>
                <div class="fly-case-dash">
                    <button class="layui-btn layui-btn-transparent " data-type="download"><i class="fa fa-download"></i>{{$item['download']+$item['rand_download']}}</button>
                    <button class="layui-btn layui-btn-transparent fly-case-active" data-type="praise"><i class="layui-icon">&#xe600;</i>{{$item['fav']+$item['rand_fav']}}</button>
                </div>
            </li>
            @endforeach
        </ul>

        <!-- <blockquote class="layui-elem-quote layui-quote-nm">暂无数据</blockquote> -->
        {!! $ret->appends($arg)->links('vendor.pagination.fly') !!}


    </div>


@endsection

@section('script')

@endsection