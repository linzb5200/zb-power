@extends('home.member.layouts.base')

@section('style')
@endsection
@section('content')

    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="" >
            <span class="layui-breadcrumb">
              <a href="">用户中心</a>
              <a><cite>我收藏的样式</cite></a>
            </span>
            <hr>
            <div class="layui-row masonry">

                @foreach($items as $key => $item)
                    <div class="layui-card layui-col-xs6 layui-col-sm6 layui-col-md4 masonry-item">
                        <div class="layui-card-header">{{$item->styles->title}}
                            <button class="layui-btn layui-btn-sm layui-btn-danger pull-right ajax-confirm" data-href="{{route('home.member.av_destroy',['id'=>$item->id])}}" data-confirm="delete" ><i class="fa fa-trash-o"></i> 删除</button>
                        </div>
                        <div class="layui-card-body" >
                            {!!$item->styles->content !!}
                        </div>
                    </div>

                @endforeach
            </div>

            {{$items->links()}}
        </div>

    </div>
@endsection