@extends('home.layouts.base')
@section('style')

@endsection
@section('content')
    <div class="banner">
        <img src="{{asset('static/home/img/banner/inner.png')}}" alt="">
    </div>
    @include('home.layouts.search')
    <div class="main-box wrap">

        <div class="breadcrumb-box">
            <div class="breadcrumb">
                <cite>场景：</cite>
                <span class="layui-breadcrumb" lay-separator="|" style="visibility: visible;">

                    <a href="/{{$cateInfo['pinyin']}}/" class="active">不限</a>

                    @foreach($categorys as $category)
                        <span lay-separator="">|</span>
                    <a href="/{{$cateInfo['pinyin']}}/{{$category['pinyin']}}/" class="active">{{$category['title']}}</a>
                    @endforeach
            </div>

            <div class="breadcrumb mg20">
                    <span class="layui-breadcrumb" lay-separator="|" style="visibility: visible;">
                        <a href="" class="active">综合排序</a><span lay-separator=""> </span>
                        <a href="list-h-1">热门下载</a><span lay-separator=""> </span>
                        <a href="list-f-1">最多收藏</a><span lay-separator=""> </span>
                        <a href="list-n-1">最新上传</a> </span>
            </div>
        </div>

        <div class="box layui-row">

            @foreach($items as $item)
                <div class="layui-col-md3">
                    <div class="item">
                        <div class="content mask">
                            <a href="/{{$cateInfo['pinyin']}}/{{$allCate[$item['cate_id']]['pinyin']}}/{{$item['id']}}" target="_blank" class="pic"><img class="imgLazy"  alt="" src="{{ getImagePath($item['thumb']) }}" width="100%"></a>
                        </div>
                        <div class="shadow">
                            <a href="/{{$cateInfo['pinyin']}}/{{$allCate[$item['cate_id']]['pinyin']}}/{{$item['id']}}" class="layui-btn layui-btn-radius layui-btn-danger">立即下载</a>
                            <span class="zan"><i class="fa fa-heart-o"></i></span>
                            <span class="down"><i class="fa fa-download"></i></span>
                        </div>
                        <div class="title">
                            <a href="/{{$cateInfo['pinyin']}}/{{$allCate[$item['cate_id']]['pinyin']}}/{{$item['id']}}" target="_blank" class="name">{{$item['title']}}</a>
                        </div>
                        <div class="tools">
                            <span class="zan"><i class="fa fa-heart-o"></i>{{$item['fav']+$item['rand_fav']}}</span>
                            <span class="down"><i class="fa fa-download"></i>{{$item['clicks']+$item['rand_clicks']}}</span>
                        </div>
                    </div>
                </div>

            @endforeach


        </div>
    </div>
@endsection

@section('script')

@endsection