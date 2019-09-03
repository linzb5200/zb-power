@extends('home.layouts.user.base')

@section('content')
    <div class="fly-panel fly-panel-user" pad20>

        <div class="layui-tab layui-tab-brief" lay-filter="user">
            <ul class="layui-tab-title" id="LAY_mine">
                <li data-type="mine-tpl" lay-id="index" class="layui-this">我的模板（<span>89</span>）</li>
                <li data-type="mine-fav" lay-id="fav" >我的收藏（<span>69</span>）</li>
                <li data-type="mine-down" lay-id="down">我的下载 （<span>16</span>）</li>
            </ul>
            <div class="layui-tab-content" style="padding: 20px 0;">
                <div class="layui-tab-item layui-show">
                    <ul class="mine-view jie-row">
                        <li>
                            <a class="jie-title" href="../jie/detail.html" target="_blank">基于 layui 的极简社区页面模版</a>
                            <i>2017/3/14 上午8:30:00</i>
                            <a class="mine-edit" href="/jie/edit/8116">编辑</a>
                            <em>661阅/10答</em>
                        </li>
                        <li>
                            <a class="jie-title" href="../jie/detail.html" target="_blank">基于 layui 的极简社区页面模版</a>
                            <i>2017/3/14 上午8:30:00</i>
                            <a class="mine-edit" href="/jie/edit/8116">编辑</a>
                            <em>661阅/10答</em>
                        </li>
                        <li>
                            <a class="jie-title" href="../jie/detail.html" target="_blank">基于 layui 的极简社区页面模版</a>
                            <i>2017/3/14 上午8:30:00</i>
                            <a class="mine-edit" href="/jie/edit/8116">编辑</a>
                            <em>661阅/10答</em>
                        </li>
                    </ul>
                    <div id="LAY_page"></div>
                </div>
                <div class="layui-tab-item">
                    <ul class="mine-view jie-row">
                        <li>
                            <a class="jie-title" href="../jie/detail.html" target="_blank">基于 layui 的极简社区页面模版</a>
                            <i>收藏于23小时前</i>  </li>
                    </ul>
                    <div id="LAY_page1"></div>
                </div>
                <div class="layui-tab-item">
                    <ul class="mine-view jie-row">
                        <li>
                            <a class="jie-title" href="../jie/detail.html" target="_blank">基于 layui 的极简社区页面模版</a>
                            <i>收藏于23小时前</i>  </li>
                    </ul>
                    <div id="LAY_page1"></div>
                </div>
            </div>
        </div>
    </div>
@endsection