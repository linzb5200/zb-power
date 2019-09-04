@extends('home.layouts.user.base')
@section('style')

@endsection
@section('content')
    <div class="fly-panel fly-panel-user" pad20>

        {{--<div class="fly-msg" style="margin-bottom: 20px;">--}}
            {{--您的邮箱尚未验证，这比较影响您的帐号安全，<a href="activate.html">立即去激活？</a>--}}
        {{--</div>--}}



        <div class="layui-row layui-col-space20">
            <div class="layui-col-md6">
                <div class="fly-panel fly-panel-border">
                    <div class="fly-panel-title"> 我的会员信息 </div>
                    <div class="fly-panel-main layui-text" style="padding: 18px 15px; height: 50px; line-height: 26px;">
                        <p> 您拥有：<span style="padding-right: 5px; color: #FF5722;" id="LAY_memberScore">{{$member->score}} 积分</span>
                            <a href="#" target="_blank" class="layui-btn layui-btn-warm layui-btn-xs">兑换</a>
                        </p>

                        <p> <span style="padding-right: 20px;">您当前为：非 VIP</span>
                            <a href="#" target="_blank" class="layui-btn layui-btn-warm layui-btn-xs">充值</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="layui-col-md6">
                <div class="fly-panel fly-signin fly-panel-border">
                    <div class="fly-panel-title"> 签到 <i class="fly-mid"></i>
                        <a href="javascript:;" class="fly-link" id="LAY_signinHelp">说明</a>
                        <i class="fly-mid"></i>
                        <a href="javascript:;" class="fly-link" id="LAY_signinTop">活跃榜
                            <span class="layui-badge-dot"></span>
                        </a> <span class="fly-signin-days">已连续签到<cite>{{$dash['sign']['now']->days}}</cite>天</span>
                    </div>
                    <div class="fly-panel-main fly-signin-main">
                        @if($dash['sign']['today'])
                        <button class="layui-btn layui-btn-disabled" id="LAY_signin">今日签到</button>
                        <span>获得了<cite>{{$dash['sign']['today']->change}}</cite>金币</span>
                        @else
                        <button class="layui-btn layui-btn-danger" id="LAY_signin">今日签到</button>
                        <span>可获得<cite>{{$dash['sign']['now']->change}}</cite>金币</span>
                        @endif

                    </div>
                </div>
            </div>

            <div class="layui-col-md12" style="margin-top: -20px; ">
                <div class="fly-panel fly-panel-border">

                    <div class="fly-panel-main fly-infos-main layui-text">
                        <span><i class="layui-icon">&#xe600;</i> 收藏<cite>5</cite></span>
                        <span><i class="layui-icon">&#xe601;</i> 下载<cite>5</cite></span>
                        <span><i class="layui-icon">&#xe62f;</i> 上传<cite>5</cite></span>
                        <span><i class="iconfont icon-jiaoliu"></i> 消息<cite>5</cite></span>
                    </div>
                </div>

            </div>


            <div class="layui-col-md12" style="margin-top: -20px; ">
                <div class="fly-panel fly-panel-border">
                    <div class="fly-panel-title"> 快捷方式</div>
                    <div class="fly-panel-main">
                        <ul class="layui-row layui-col-space10 fly-shortcut">
                            <li class="layui-col-sm3 layui-col-xs4"><a href="/user/profile/"><i
                                            class="layui-icon"></i><cite>修改信息</cite></a></li>
                            <li class="layui-col-sm3 layui-col-xs4"><a href="/user/profile/#avatar"><i
                                            class="layui-icon"></i><cite>修改头像</cite></a></li>
                            <li class="layui-col-sm3 layui-col-xs4"><a href="/user/profile/#pass"><i
                                            class="layui-icon"></i><cite>修改密码</cite></a></li>
                            <li class="layui-col-sm3 layui-col-xs4"><a href="/jie/add/"><i
                                            class="layui-icon"></i><cite>账户充值</cite></a></li>

                            <li class="layui-col-sm3 layui-col-xs4 LAY_search"><a href="javascript:;"><i
                                            class="layui-icon"></i><cite>账务明细  </cite></a></li>
                            <li class="layui-col-sm3 layui-col-xs4"><a href="/user/blog#fav"><i
                                            class="layui-icon"></i><cite>我的收藏</cite></a></li>
                            <li class="layui-col-sm3 layui-col-xs4"><a href="/user/blog#down"><i
                                            class="layui-icon"></i><cite>我的下载</cite></a></li>
                            <li class="layui-col-sm3 layui-col-xs4"><a href="/jie/15697/"><i
                                            class="layui-icon"></i><cite>成为卖家</cite></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('script')

@endsection