@extends('home.layouts.base')
@section('style')

@endsection
@section('content')

    <div class="fly-home fly-panel" >
        <img src="{{ getImagePath(auth('member')->user()->avatar) }}" alt="贤心">
        <i class="iconfont icon-renzheng" title="Fly社区认证"></i>
        <h1>
            {{ auth('member')->user()->nickname }}
            <i class="layui-icon layui-icon-add-1">关注</i>
            {{--<i class="iconfont icon-nan"></i>--}}
            <!-- <i class="iconfont icon-nv"></i>  -->
            {{--<i class="layui-badge fly-badge-vip">VIP3</i>--}}
            <!--
            <span style="color:#c00;">（管理员）</span>
            <span style="color:#5FB878;">（社区之光）</span>
            <span>（该号已被封）</span>
            -->
        </h1>

        {{--<p style="padding: 10px 0; color: #5FB878;">认证信息：layui 作者</p>--}}

        <p class="fly-home-info">
            <i class="iconfont icon-kiss" title=""></i><span style="color: #FF7200;">{{ auth('member')->user()->score }} 模版</span>
            <i class="iconfont icon-kiss" title=""></i><span style="color: #FF7200;">{{ auth('member')->user()->score }} 积分</span>
            <i class="iconfont icon-shijian"></i><span>{{ date('Y-m-d',strtotime(auth('member')->user()->created_at)) }} 加入</span>
            {{--<i class="iconfont icon-chengshi"></i><span>来自杭州</span>--}}
        </p>

        {{--<p class="fly-home-sign">（人生仿若一场修行）</p>--}}


    </div>

    <div class="layui-container">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md6 fly-home-jie">
                <div class="fly-panel">
                    <h3 class="fly-panel-title">Ta的模板</h3>
                    <ul class="jie-row">
                        <li>
                            <span class="fly-jing">精</span>
                            <a href="" class="jie-title"> 基于 layui 的极简社区页面模版</a>
                            <i>刚刚</i>
                            <em class="layui-hide-xs">1136阅/27答</em>
                        </li>
                        <li>
                            <a href="" class="jie-title"> 基于 layui 的极简社区页面模版</a>
                            <i>1天前</i>
                            <em class="layui-hide-xs">1136阅/27答</em>
                        </li>
                        <li>
                            <a href="" class="jie-title"> 基于 layui 的极简社区页面模版</a>
                            <i>2017-10-30</i>
                            <em class="layui-hide-xs">1136阅/27答</em>
                        </li>
                        <li>
                            <a href="" class="jie-title"> 基于 layui 的极简社区页面模版</a>
                            <i>1天前</i>
                            <em class="layui-hide-xs">1136阅/27答</em>
                        </li>
                        <li>
                            <a href="" class="jie-title"> 基于 layui 的极简社区页面模版</a>
                            <i>1天前</i>
                            <em class="layui-hide-xs">1136阅/27答</em>
                        </li>
                        <li>
                            <a href="" class="jie-title"> 基于 layui 的极简社区页面模版</a>
                            <i>1天前</i>
                            <em class="layui-hide-xs">1136阅/27答</em>
                        </li>
                        <li>
                            <a href="" class="jie-title"> 基于 layui 的极简社区页面模版</a>
                            <i>1天前</i>
                            <em class="layui-hide-xs">1136阅/27答</em>
                        </li>
                        <!-- <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><i style="font-size:14px;">没有发表任何求解</i></div> -->
                    </ul>
                </div>
            </div>

            <div class="layui-col-md6 fly-home-da">
                <div class="fly-panel">
                    <h3 class="fly-panel-title">Ta的成长</h3>
                    <ul class="layui-timeline">
                        <li class="layui-timeline-item">
                            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                            <div class="layui-timeline-content layui-text">
                                <h3 class="layui-timeline-title">8月18日</h3>
                                <p>
                                    layui 2.0 的一切准备工作似乎都已到位。发布之弦，一触即发。
                                    <br>不枉近百个日日夜夜与之为伴。因小而大，因弱而强。
                                    <br>无论它能走多远，抑或如何支撑？至少我曾倾注全心，无怨无悔 <i class="layui-icon"></i>
                                </p>
                            </div>
                        </li>
                        <li class="layui-timeline-item">
                            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                            <div class="layui-timeline-content layui-text">
                                <h3 class="layui-timeline-title">8月16日</h3>
                                <p>杜甫的思想核心是儒家的仁政思想，他有“<em>致君尧舜上，再使风俗淳</em>”的宏伟抱负。个人最爱的名篇有：</p>
                                <ul>
                                    <li>《登高》</li>
                                    <li>《茅屋为秋风所破歌》</li>
                                </ul>
                            </div>
                        </li>
                        <li class="layui-timeline-item">
                            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                            <div class="layui-timeline-content layui-text">
                                <h3 class="layui-timeline-title">8月15日</h3>
                                <p>
                                    中国人民抗日战争胜利72周年
                                    <br>常常在想，尽管对这个国家有这样那样的抱怨，但我们的确生在了最好的时代
                                    <br>铭记、感恩
                                    <br>所有为中华民族浴血奋战的英雄将士
                                    <br>永垂不朽
                                </p>
                            </div>
                        </li>
                        <li class="layui-timeline-item">
                            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                            <div class="layui-timeline-content layui-text">
                                <div class="layui-timeline-title">过去</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection