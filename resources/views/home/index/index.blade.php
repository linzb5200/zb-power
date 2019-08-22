@extends('home.layouts.base')
@section('style')

@endsection
@section('content')
    <div class="banner">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{asset('static/home/img/banner/banner1.jpg')}}" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('static/home/img/banner/banner2.jpg')}}" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="{{asset('static/home/img/banner/banner3.jpg')}}" alt="">
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
    <div class="search-box">

        <form class="layui-form search-form" action="/search">
            {{csrf_field()}}
            <div class="layui-form-item">

                <div class="layui-inline">
                    <select name="id" class="layui-input layui-bg-gray" lay-verify="required">
                        <option value=""></option>
                        @foreach($navs as $key => $nav)
                        <option value="/{{$nav['pinyin']}}/">{{$nav['title']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="layui-inline">
                    <input type="text" name="keyword" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input input">
                </div>
                <div class="layui-inline pull-right">
                    <button class="layui-btn layui-btn-primary btn-search" lay-submit lay-filter="searchForm">搜索</button>
                </div>

            </div>
        </form>

    </div>

    <div class="count-box">
        名企精英都在用的专业简历 已有 <span id="count">2033316<i class="icon posa"></i></span> 位用户在这里创建简历
    </div>
    <div class="main-box wrap">

        @foreach($navs as $key => $nav)

            @if($nav['recommend'] == 1)
        <div class="box-title">
            <blockquote class="layui-elem-quote">{{$nav['title']}}
                <span class="layui-breadcrumb" lay-separator=" ">
                    @foreach($nav['children'] as $child)
                        @if($child['recommend'] == 1)
                        <a href="/{{$nav['pinyin']}}/{{$child['pinyin']}}/">{{$child['title']}}</a>
                        @endif
                    @endforeach
              <a href="/{{$nav['pinyin']}}/" class="fr">查看更多></a>
            </span>
            </blockquote>
        </div>
        <div class="box layui-row">

            @if(isset($hots[$nav['id']]))
            @foreach($hots[$nav['id']] as $hot)
            <div class="layui-col-md3">
                <div class="item">
                    <div class="content mask">
                        <a href="{{$hot['url']}}" target="_blank" class="pic"><img class="imgLazy"  alt="" src="{{ getImagePath($hot['thumb']) }}" width="100%"></a>
                    </div>
                    <div class="shadow">
                        <a href="{{$hot['url']}}" class="layui-btn layui-btn-radius layui-btn-danger">立即下载</a>
                        <span class="zan"><i class="fa fa-heart-o"></i></span>
                        <span class="down"><i class="fa fa-download"></i></span>
                    </div>
                    <div class="title">
                        <a href="{{$hot['url']}}" target="_blank" class="name">{{$hot['title']}}</a>
                    </div>
                    <div class="tools">
                        <span class="zan"><i class="fa fa-heart-o"></i>{{$hot['fav']+$hot['rand_fav']}}</span>
                        <span class="down"><i class="fa fa-download"></i>{{$hot['clicks']+$hot['rand_clicks']}}</span>
                    </div>
                </div>
            </div>
            @endforeach

            @endif

        </div>

            @endif
        @endforeach
    </div>
@endsection

@section('script')

@endsection