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
                        <a href="/" class="active">首页</a><span lay-separator="">></span>
                        @if($channel)
                        @foreach($channel as $chan)
                        <a href="{{ $chan['url'] }}">{{ $chan['title'] }}</a>{!!$chan['arrow']!!}
                        @endforeach
                        @endif
                        <a href="javascript:;">当前作品</a> </span>
            </div>
        </div>

        <div class="info-box">
            <div class="info-lt">
                <div class="title">{{$info['title']}}</div>
                <div class="detail">
                    {!!$info['content']!!}
                    <p>
                        本作品内容为{{$info['title']}}， 格式为 {{$info['format']}}， 大小{{ getSize($info['size']) }} ， 页数为{{$info['page']}}， 请使用软件{{$info['soft']}}打开， 作品中文字及图均可以修改和编辑，图片更改请在作品中右键图片并更换，文字修改请直接点击文字进行修改，也可以新增和删除作品中的内容， 欢迎使用。 该资源来自用户分享，如果损害了你的权利，请联系网站客服处理。
                    </p>
                </div>

            </div>
            <div class="info-rt">
                <div class="layui-card">
                    <div class="layui-card-header pb20">
                        <div class="download">
                            <button type="button" class="layui-btn layui-btn-lg layui-btn-radius" data-url="{{ route('download',['id'=>$info['id']]) }}" id="download">
                                <i class="fa fa-download"></i> 立即下载
                            </button>
                        </div>
                        <div class="star" hidden>
                            <i class="layui-icon layui-icon-rate"></i>
                        </div>
                    </div>
                    <div class="layui-card-body">
                        <table class="layui-table">
                            <colgroup>
                                <col width="150">
                                <col width="200">
                                <col>
                            </colgroup>
                            <tbody>
                            <tr>
                                <td>软件</td>
                                <td>{{$info['soft']}}</td>
                            </tr>
                            <tr>
                                <td>格式</td>
                                <td>{{$info['format']}}</td>
                            </tr>
                            <tr>
                                <td>大小</td>
                                <td>{{ getSize($info['size']) }}</td>
                            </tr>
                            @if($info['page'] > 0)
                            <tr>
                                <td>页数</td>
                                <td>{{$info['page']}} </td>
                            </tr>
                            @endif
                            @if($info['scale'])
                                <tr>
                                    <td>比例</td>
                                    <td>{{$info['scale']}} </td>
                                </tr>
                            @endif
                            @if(isset($info['auth']) && $info['auth'])
                                <tr>
                                    <td>作者</td>
                                    <td>{{$info['auth']}} </td>
                                </tr>
                            @endif
                            <tr>
                                <td>上传时间</td>
                                <td>{{$info['created_at']}}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="layui-card">
                    <div class="layui-card-header">
                        相关搜索：
                    </div>
                    <div class="layui-card-body tag">

                        <a href="#">时间节点</a>
                        <a href="#">年计划</a>
                        <a href="#">时间节点</a>
                        <a href="#">年计划</a>
                        <a href="#">时间节点</a>
                        <a href="#">年计划</a>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#download').click(function () {
            console.log('click')
            var url = $(this).data('url');
            if(url != '') window.open(url);
        });
    </script>

@endsection