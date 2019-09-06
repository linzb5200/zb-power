@extends('home.layouts.user.base')

@section('content')
    <div class="fly-panel fly-panel-user" pad20>

        <div class="layui-tab layui-tab-brief" lay-filter="mine">
            <ul class="layui-tab-title" id="LAY_mine">
                <li data-type="mine-tpl" data-url="{{route('home.user.mine')}}" lay-id="index" >我的上传（<span>{{$counts['mine_art']}}</span>）</li>
                <li data-type="mine-down" data-url="{{route('home.user.mine.down')}}" lay-id="down">我的下载 （<span>{{$counts['mine_down']}}</span>）</li>
                <li data-type="mine-fav" data-url="{{route('home.user.mine.fav')}}" lay-id="fav" class="layui-this">我的收藏（<span>{{$counts['mine_fav']}}</span>）</li>
                <li data-type="mine-zan" data-url="{{route('home.user.mine.zan')}}" lay-id="zan">我的点赞（<span>{{$counts['mine_zan']}}</span>）</li>
            </ul>
            <div class="layui-tab-content" style="padding: 20px 0;">

                <div class="layui-tab-item layui-show" >
                    <ul class="mine-view jie-row">
                        @foreach($items as $item)
                            <li>
                                <a class="jie-title" href="{{route('products.show2',['zm'=>$item->zm,'cate'=>$costCate[$item->parent_id]['zm'],'id'=>$item->product_id]) }}" target="_blank">{{$item->title}}</a>
                                <i>收藏于{{timeAgo($item->created_at)}}</i>  </li>
                        @endforeach
                    </ul>
                    <div id="LAY_page1">{!! $ret->links() !!}</div>
                </div>
            </div>
        </div>
    </div>
@endsection