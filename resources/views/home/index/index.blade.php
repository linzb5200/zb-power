@extends('home.layouts.base')
@section('style')

@endsection

@section('content')
<div class="fly-banner">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">

                <div class="fly-case-header">
                    <p class="fly-case-year"> YOMORE IS EBERYWHERE</p>
                    <p class="fly-case-slogan">嘿，等你很久了</p>
                </div>

            </div>
            <div class="swiper-slide">

                <div class="fly-case-header">
                    <p class="fly-case-year"></p>
                    <p class="fly-case-slogan">Hey，听说你要份求职简历？</p>

                </div>

            </div>
            <div class="swiper-slide">

                <div class="fly-case-header">
                    <p class="fly-case-year" style="font-size: 40px"> Never forget why you started and you accomplish
                        your mission </p>
                    <p class="fly-case-slogan">愿你归来 仍是少年</p>
                </div>

            </div>
            <div class="swiper-slide">

                <div class="fly-case-header">
                    <p class="fly-case-year">LESS IS MORE</p>
                    <p class="fly-case-slogan">简约及是美</p>

                </div>

            </div>
            <div class="swiper-slide">

                <div class="fly-case-header">
                    <p class="fly-case-year">GRADUATION SEASON SO YOUNG </p>
                    <p class="fly-case-slogan">毕业季 致青春</p>

                </div>

            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</div>

<div class="fly-search-index search-area">
    @include('home.common.search')
</div>

<div class="fly-main" style="overflow: hidden;">

    @foreach($navs as $key => $nav)
        @if($nav['recommend'] == 1)
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li><h2 class="title">{{$nav['title']}}</h2></li>

            @foreach($nav['children'] as $child)
                @if($child['recommend'] == 1)
            <li><a href="/{{$nav['pinyin']}}/{{$child['pinyin']}}/">{{$child['title']}}</a></li>
                @endif
            @endforeach
            <li class="fr"><a href="/{{$nav['pinyin']}}/">查看更多 ></a></li>
        </ul>
    </div>

    <ul class="fly-case-list">

        @if(isset($hots[$nav['id']]))
        @foreach($hots[$nav['id']] as $hot)
        <li data-id="123">
            <div class="fly-case-img" href="{{$hot['url']}}" target="_blank">
                <img src="{{ getImagePath($hot['thumb']) }}" alt="">
                <div class="tool">
                    <cite class="layui-btn layui-btn-boss layui-btn-small" href="{{$hot['url']}}" target="_blank" >立即下载</cite>
                    <div class="btn">
                        <i class="iconfont icon-zan"></i>
                        <i class="layui-icon">&#xe600;</i>
                    </div>
                </div>
            </div>

            <h2><a href="{{$hot['url']}}" target="_blank">{{$hot['title']}}</a></h2>
            <div class="fly-case-dash">
                <button class="layui-btn layui-btn-transparent " data-type="download"><i class="fa fa-download"></i>{{$hot['download']+$hot['rand_download']}}
                </button>
                <button class="layui-btn layui-btn-transparent fly-case-active" data-type="praise"><i
                            class="layui-icon">&#xe600;</i>{{$hot['fav']+$hot['rand_fav']}}
                </button>
            </div>
        </li>

        @endforeach
        @endif
    </ul>
        @endif
    @endforeach

</div>
@endsection

@section('script')

@endsection