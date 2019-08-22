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
            <div class="breadcrumb mg20">
                    <span class="layui-breadcrumb" lay-separator="|" style="visibility: visible;">
                        <a href="/material/tpl/0_0_1" class="active">综合排序</a><span lay-separator=""> </span>
                        <a href="/material/tpl/0_1_1">热门下载</a><span lay-separator=""> </span>
                        <a href="/material/tpl/0_2_1">全新模板</a><span lay-separator=""> </span>
                        <a href="/material/tpl/0_3_1">精准排序</a> </span>
            </div>
        </div>

        <div class="box layui-row">

            @foreach($items as $item)
                <div class="layui-col-md3">
                    <div class="item">
                        <div class="content mask">
                            <a href="#" target="_blank" class="pic"><img class="imgLazy"  alt="" src="{{ getImagePath($item['thumb']) }}" width="100%"></a>
                        </div>
                        <div class="shadow">
                            <a href="#" class="layui-btn layui-btn-radius layui-btn-danger">立即下载</a>
                            <span class="zan"><i class="fa fa-heart-o"></i></span>
                            <span class="down"><i class="fa fa-download"></i></span>
                        </div>
                        <div class="title">
                            <a href="#" target="_blank" class="name">{{$item['title']}}</a>
                        </div>
                        <div class="tools">
                            <span class="zan"><i class="fa fa-heart-o"></i>{{$item['fav']}}</span>
                            <span class="down"><i class="fa fa-download"></i>{{$item['clicks']}}</span>
                        </div>
                    </div>
                </div>

            @endforeach


        </div>
    </div>
@endsection

@section('script')

@endsection