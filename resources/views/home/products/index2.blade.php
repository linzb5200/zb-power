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
                        <a href="{{route('products.index2',['cate'=>$cate['zm'],'zm'=>$arg['zm'],'trade'=>0,'style'=>0,'color'=>0,'soft'=>0,'type'=>0,'scale'=>0,'sort'=>0,'page'=>1])}}"  @if(empty($arg['trade'])) class="active" @endif >全部</a><span lay-separator="">
                    </span>
                @foreach($costTrades as $ct)
                <a href="{{route('products.index2',['cate'=>$cate['zm'],'zm'=>$arg['zm'],'trade'=>$ct['zm'],'style'=>$arg['style'],'color'=>$arg['color'],'soft'=>$arg['soft'],'type'=>$arg['type'],'scale'=>$arg['scale'],'sort'=>$arg['sort'],'page'=>$arg['page']])}}"
                   @if($arg['trade'] == $ct['zm'] && $arg['trade'] != '0')
                   class="active" @endif >{{$ct['name']}}</a><span lay-separator=""> </span>

                @endforeach
              </span>
            </div>
            <div class="breadcrumb mb-10">
                <cite>风格：</cite>
                <span class="layui-breadcrumb"  lay-separator=" " style="visibility: visible;">
                <a href="{{route('products.index2',['cate'=>$cate['zm'],'zm'=>$arg['zm'],'trade'=>$arg['trade'],'style'=>0,'color'=>0,'soft'=>0,'type'=>0,'scale'=>0,'sort'=>0,'page'=>1])}}" @if(empty($arg['style'])) class="active" @endif >全部</a><span lay-separator=""> </span>

                @foreach($costStyles as $cs)
                <a href="{{route('products.index2',['cate'=>$cate['zm'],'zm'=>$arg['zm'],'trade'=>$arg['trade'],'style'=>$cs['zm'],'color'=>$arg['color'],'soft'=>$arg['soft'],'type'=>$arg['type'],'scale'=>$arg['scale'],'sort'=>$arg['sort'],'page'=>$arg['page']])}}" @if($arg['style'] == $cs['zm'] && $arg['style'] != '0') class="active" @endif >{{$cs['name']}}</a><span lay-separator=""> </span>
                @endforeach
              </span>
            </div>
        </div>
    </div>


    <div class="fly-main" style="overflow: hidden;">

        <div class="fly-filter">
            <div class="layui-tab layui-tab-brief order-tab">
                <ul class="layui-tab-title">

                    @foreach($otherAttr['sort'] as $sk => $name)
                    <li @if($arg['sort'] == $sk) class="layui-this" @endif ><a href="{{route('products.index2',['cate'=>$cate['zm'],'zm'=>$arg['zm'],'trade'=>$arg['trade'],'style'=>$arg['style'],'color'=>$arg['color'],'soft'=>$arg['soft'],'type'=>$arg['type'],'scale'=>$arg['scale'],'sort'=>$sk,'page'=>$arg['page']])}}">{{$name}}</a></li>
                    @endforeach

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
                            <dd  @if($arg['color'] == $cc['zm']) class="layui-this" @endif ><a href="{{route('products.index2',['cate'=>$cate['zm'],'zm'=>$arg['zm'],'trade'=>$arg['trade'],'style'=>$arg['zm'],'color'=>$cc['zm'],'soft'=>$arg['soft'],'type'=>$arg['type'],'scale'=>$arg['scale'],'sort'=>$arg['sort'],'page'=>$arg['page']])}}">{{$cc['name']}}</a></dd>
                            @endforeach
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">软件</a>
                        <dl class="layui-nav-child">
                            @foreach($otherAttr['soft'] as $osk => $name)
                            <dd  @if($arg['soft'] == $osk) class="layui-this" @endif ><a href="{{route('products.index2',['cate'=>$cate['zm'],'zm'=>$arg['zm'],'trade'=>$arg['trade'],'style'=>$arg['style'],'color'=>$arg['color'],'soft'=>$osk,'type'=>$arg['type'],'scale'=>$arg['scale'],'sort'=>$arg['sort'],'page'=>$arg['page']])}}">{{$name}}</a></dd>
                            @endforeach
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">类型</a>
                        <dl class="layui-nav-child">
                            @foreach($otherAttr['type'] as $otk => $name)
                                <dd  @if($arg['type'] == $otk) class="layui-this" @endif ><a href="{{route('products.index2',['cate'=>$cate['zm'],'zm'=>$arg['zm'],'trade'=>$arg['trade'],'style'=>$arg['style'],'color'=>$arg['color'],'soft'=>$arg['soft'],'type'=>$otk,'scale'=>$arg['scale'],'sort'=>$arg['sort'],'page'=>$arg['page']])}}">{{$name}}</a></dd>
                            @endforeach
                        </dl>
                    </li>
                </ul>

                <a href="{{route('products.index',['cate'=>$cate['zm'],'zm'=>$arg['zm'],'trade'=>$arg['trade'],'style'=>$arg['style'],'color'=>$arg['color'],'soft'=>0,'type'=>0,'scale'=>0,'sort'=>1,'page'=>1])}}" class="reset">清空条件</a>
            </div>

        </div>

        <ul class="fly-case-list">
            @foreach($items as $item)
            <li data-id="{{$item['id']}}">
                <div class="fly-case-img ahref" href="{{route('products.show2',['zm'=>$costCate[$item['cate_id']]['zm'],'cate'=>$cate['zm'],'id'=>$item['id']]) }}" target="_blank" >
                    <img src="{{ getImagePath($item['thumb']) }}" alt="">
                    <div class="tool">
                        <cite class="layui-btn layui-btn-boss layui-btn-small">立即下载</cite>
                        <div class="btn">
                            <i class="iconfont icon-zan mine-zan"></i>
                            <i class="layui-icon mine-fav">&#xe600;</i>
                        </div>
                    </div>
                </div>

                <h2><a href="{{route('products.show2',['zm'=>$costCate[$item['cate_id']]['zm'],'cate'=>$cate['zm'],'id'=>$item['id']]) }}" target="_blank">{{$item['title']}}</a></h2>
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