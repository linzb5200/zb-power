@extends('home.member.layouts.base')

@section('style')
    <style>
        .masonry-item{width: 30%;}
        .pic-name {height: 100%;border: 0px;text-align: center;padding: 0px;margin: 0px;color: #ca8989;}
    </style>
@endsection
@section('content')

    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="" >
            <span class="layui-breadcrumb">
              <a href="">用户中心</a>
              <a><cite>我的图片</cite></a>
            </span>
            <hr>
            <div class="layui-row masonry">

                @foreach($items as $key => $item)
                    <div class="layui-card layui-col-xs4 layui-col-sm4 layui-col-md4 masonry-item">
                        <div class="layui-card-header">
                            <input type="text" value="{{$item->title ? $item->title : "未命名"}}" class="pic-name" data-id="{{$item->id}}" readonly="">

                            <button class="layui-btn layui-btn-sm layui-btn-danger pull-right ajax-confirm" data-href="{{route('home.member.picture_destroy',['id'=>$item['id']])}}" data-confirm="delete" ><i class="fa fa-trash-o"></i> 删除</button>
                        </div>
                        <div class="layui-card-body">
                            @if($item->path)
                                <img src="{{$item->path}}" alt="" width="240px">
                            @else
                                <img src="{{ asset('static/home/img/nothumb.png') }}" alt="" style="max-width: 442px">
                            @endif
                        </div>
                    </div>

                @endforeach
            </div>

            {{$items->links()}}
        </div>

    </div>
@endsection
@section('script')
@endsection