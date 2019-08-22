@extends('home.member.layouts.base')

@section('content')

    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="" >
            <span class="layui-breadcrumb">
              <a href="">用户中心</a>
              <a><cite>我的邀请</cite></a>
            </span>
            <hr>
            <br>


            <fieldset class="layui-elem-field">
                <legend>分享链接邀请好友加入</legend>
                <div class="layui-field-box">
                    zhubian.com/invitation/register?code=ebff43aad31
                    <button class="layui-btn pull-right">点击复制</button>
                </div>
            </fieldset>
            <br>

            <fieldset class="layui-elem-field">
                <legend>邀请进度</legend>
                <div class="layui-field-box">
                    <div class="layui-progress layui-progress-big" lay-showPercent="yes">
                        <div class="layui-progress-bar layui-bg-red" lay-percent="50%"></div>
                    </div>
                </div>
            </fieldset>

            <br>


            <fieldset class="layui-elem-field layui-field-title">
                <legend>邀请列表</legend>
            </fieldset>

            <table class="layui-table">
                <colgroup>
                    <col width="150">
                    <col width="200">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th>邀请人昵称</th>
                    <th>邀请时间</th>
                    <th>是否绑定公众号</th>
                    <th>绑定时间</th>
                    <th>是否兑换</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>
@endsection