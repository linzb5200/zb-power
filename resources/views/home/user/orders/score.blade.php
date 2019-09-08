@extends('home.layouts.user.base')

@section('content')

    <div class="fly-panel fly-panel-user" pad20>
        <!--
        <div class="fly-msg" style="margin-top: 15px;">
          您的邮箱尚未验证，这比较影响您的帐号安全，<a href="activate.html">立即去激活？</a>
        </div>
        -->
        <div class="layui-tab layui-tab-brief" lay-filter="user">
            <ul class="layui-tab-title" id="LAY_mine">
                <li data-type="mine-recharge" lay-id="bill" class="layui-this">积分明细</li>
                <li data-type="mine-vip" lay-id="vip">VIP充值记录 </li>
            </ul>
            <div class="layui-tab-content" style="padding: 20px 0;">
                <div class="layui-tab-item layui-show">
                    <ul class="mine-view jie-row">
                        @foreach($items as $item)
                        <li>

                            <i>@if($item->type == 1)
                                    @if($item->way == 1)签到 @endif
                                    @if($item->way == 3)充值 @endif
                                @elseif($item->type == 2)
                                    @if($item->used == 1)兑换 @endif
                                @endif
                                    @if($item->type == 1) +@elseif($item->type == 2) -@endif{{$item['change']}} 积分</i>

                            <em> {{$item['created_at']}}</em>
                        </li>
                        @endforeach
                    </ul>
                    <div id="LAY_page1">{!! $items->links() !!}</div>
                </div>
            </div>
        </div>
    </div>
@endsection