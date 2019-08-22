@extends('home.member.layouts.base')

@section('content')

    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="" >
            <span class="layui-breadcrumb">
              <a href="">用户中心</a>
              <a><cite>我的模版</cite></a>
            </span>
            <hr>
            <div class="layui-row">

                @foreach($items as $key => $item)
                    <div class="layui-card layui-col-xs6 layui-col-sm6 layui-col-md4">
                        <div class="layui-card-header">
                            {{$item->title}}
                            <button class="layui-btn layui-btn-sm layui-btn-danger pull-right ajax-confirm" data-href="{{route('home.member.save_destroy',['id'=>$item['id'],'type'=>'tpl'])}}" data-confirm="delete" ><i class="fa fa-trash-o"></i> 删除</button>
                        </div>
                        <div class="layui-card-body" style="max-width: 442px">
                            @if($item->thumb)
                                <img src="{{$item->thumb}}" alt="" style="max-width: 442px">
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