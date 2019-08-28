@extends('home.layouts.base')
@section('style')

@endsection

@section('content')
    <div class="layui-container">
        <div class="layui-row layui-col-space15">

            <div class="breadcrumb-box mt-20">
                <div class="breadcrumb">
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

            <div class="layui-col-md8 content detail">


                <div class="fly-panel detail-box">
                    <h1>{{$info['title']}}</h1>
                    <div class="fly-detail-info">
                        <!-- <span class="layui-badge">审核中</span> -->
                        <span class="layui-badge layui-bg-green fly-detail-column">动态</span>

                        <span class="layui-badge" style="background-color: #999;">未结</span>
                        <!-- <span class="layui-badge" style="background-color: #5FB878;">已结</span> -->

                        <span class="layui-badge layui-bg-black">置顶</span>
                        <span class="layui-badge layui-bg-red">精帖</span>

                        <div class="fly-admin-box" data-id="123">
                            <span class="layui-btn layui-btn-xs jie-admin" type="del">删除</span>

                            <span class="layui-btn layui-btn-xs jie-admin" type="set" field="stick" rank="1">置顶</span>
                            <!-- <span class="layui-btn layui-btn-xs jie-admin" type="set" field="stick" rank="0" style="background-color:#ccc;">取消置顶</span> -->

                            <span class="layui-btn layui-btn-xs jie-admin" type="set" field="status" rank="1">加精</span>
                            <!-- <span class="layui-btn layui-btn-xs jie-admin" type="set" field="status" rank="0" style="background-color:#ccc;">取消加精</span> -->
                        </div>
                        <span class="fly-list-nums">
                            <a href="#comment"><i class="iconfont" title="回答">&#xe60c;</i> 66</a>
                            <i class="iconfont" title="人气">&#xe60b;</i> 99999
                        </span>
                    </div>
                    <div class="detail-body photos">
                        {!!$info['content']!!}
                        <p>
                            本作品内容为{{$info['title']}}， 格式为 {{$info['format']}}， 大小{{ getSize($info['size']) }} ， 页数为{{$info['page']}}， 请使用软件{{$info['soft']}}打开， 作品中文字及图均可以修改和编辑，图片更改请在作品中右键图片并更换，文字修改请直接点击文字进行修改，也可以新增和删除作品中的内容， 欢迎使用。 该资源来自用户分享，如果损害了你的权利，请联系网站客服处理。
                        </p>
                    </div>
                </div>

            </div>
            <div class="layui-col-md4">

                <div class="fly-panel">
                    <div class="fly-panel-main">
                        <a href="{{ route('download',['id'=>$info['id']]) }}" target="_blank" class="fly-download " >立即下载</a>
                    </div>
                </div>

                <div class="fly-panel">
                    <div class="fly-panel-info">
                        <ul class="tb">
                            <li class="clearfix">
                                <div class="fl th">图片编号</div>
                                <div class="td">1891268</div>
                            </li>
                            <li class="clearfix">
                                <div class="fl th">文件大小</div>
                                <div class="td">{{ getSize($info['size']) }}</div>
                            </li>
                            @if($info['page'] > 0)
                            <li class="clearfix">
                                <div class="fl th">页数</div>
                                <div class="td">{{$info['page']}}</div>
                            </li>
                            @endif
                            <li class="clearfix format">
                                <div class="fl th">文件格式</div>
                                <div class="td">docx</div>
                            </li>
                            @if($info['scale'])
                            <li class="clearfix format">
                                <div class="fl th">比例</div>
                                <div class="td">{{$info['scale']}}</div>
                            </li>
                            @endif
                            @if(isset($info['auth']) && $info['auth'])
                            <li class="clearfix">
                                <div class="fl th">作者</div>
                                <div class="td">{{$info['auth']}}</div>
                            </li>
                            @endif
                            <li class="clearfix">
                                <div class="fl th">推荐软件</div>
                                <div class="td">{{$info['soft']}}</div>
                            </li>
                            <li class="clearfix">
                                <div class="fl th">上传时间</div>
                                <div class="td">{{$info['created_at']}}</div>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="fly-panel">
                    <div class="fly-panel-title">
                        相关搜索
                    </div>
                    <div class="fly-panel-tag">
                        <ul>
                            <li><a href="#">时间节点</a></li>
                            <li><a href="#">时间节点</a></li>
                            <li><a href="#">年计划</a></li>
                            <li><a href="#">时间节点</a></li>
                            <li><a href="#">时间节点</a></li>
                            <li><a href="#">时间节点</a></li>
                            <li><a href="#">时间节点</a></li>
                            <li><a href="#">年计划</a></li>
                            <li><a href="#">时间节点</a></li>
                            <li><a href="#">时间节点</a></li>
                        </ul>
                    </div>
                </div>


                <div class="fly-panel">
                    <div class="fly-panel-state fz12">
                        声明：小清新感恩母亲节手抄报来自用户分享，仅限学习交流请勿用于商业用途。如损害你的权益请联系客服给予处理。
                    </div>
                </div>

                <dl class="fly-panel fly-list-one">
                    <dt class="fly-panel-title">相关文章推荐</dt>
                    <dd>
                        <a href="">基于 layui 的极简社区页面模版</a>
                        <span><i class="iconfont icon-pinglun1"></i> 16</span>
                    </dd>
                    <dd>
                        <a href="">基于 layui 的极简社区页面模版</a>
                        <span><i class="iconfont icon-pinglun1"></i> 16</span>
                    </dd>
                    <dd>
                        <a href="">基于 layui 的极简社区页面模版</a>
                        <span><i class="iconfont icon-pinglun1"></i> 16</span>
                    </dd>
                    <dd>
                        <a href="">基于 layui 的极简社区页面模版</a>
                        <span><i class="iconfont icon-pinglun1"></i> 16</span>
                    </dd>
                    <dd>
                        <a href="">基于 layui 的极简社区页面模版</a>
                        <span><i class="iconfont icon-pinglun1"></i> 16</span>
                    </dd>
                    <dd>
                        <a href="">基于 layui 的极简社区页面模版</a>
                        <span><i class="iconfont icon-pinglun1"></i> 16</span>
                    </dd>
                    <dd>
                        <a href="">基于 layui 的极简社区页面模版</a>
                        <span><i class="iconfont icon-pinglun1"></i> 16</span>
                    </dd>
                    <dd>
                        <a href="">基于 layui 的极简社区页面模版</a>
                        <span><i class="iconfont icon-pinglun1"></i> 16</span>
                    </dd>
                    <dd>
                        <a href="">基于 layui 的极简社区页面模版</a>
                        <span><i class="iconfont icon-pinglun1"></i> 16</span>
                    </dd>
                    <dd>
                        <a href="">基于 layui 的极简社区页面模版</a>
                        <span><i class="iconfont icon-pinglun1"></i> 16</span>
                    </dd>

                    <!-- 无数据时 -->
                    <!--
                    <div class="fly-none">没有相关数据</div>
                    -->
                </dl>


                <div class="fly-panel" style="padding: 20px 0; text-align: center;">
                    <img src="/static/home/images/weixin.jpg" style="max-width: 100%;" alt="layui">
                    <p style="position: relative; color: #666;">微信扫码关注 layui 公众号</p>
                </div>

            </div>
        </div>
    </div>
@endsection
