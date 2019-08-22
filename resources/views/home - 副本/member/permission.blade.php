@extends('home.member.layouts.base')

@section('content')

    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="" >
            <span class="layui-breadcrumb">
              <a href="">用户中心</a>
              <a><cite>我的权限</cite></a>
            </span>
            <hr>

            <table class="layui-table">
                <colgroup>
                    <col width="150">
                    <col width="200">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th>会员等级</th>
                    <th>开始于</th>
                    <th>结束于</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>免费会员</td>
                    <td>2019-02-15 21:04:29</td>
                    <td>-</td>
                    <td><button class="layui-btn layui-btn-sm layui-btn-danger">购买会员</button></td>
                </tr>
                </tbody>
            </table>
            <br>

            <fieldset class="layui-elem-field layui-field-title">
                <legend>会员等级权限一览表</legend>
            </fieldset>

            <table class="layui-table">
                <colgroup>
                    <col width="150">
                    <col width="200">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th>功能</th>
                    <th>授权数量</th>
                    <th>已用数量</th>
                    <th width="400">占比</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>图片存储数量</td>
                    <td>500</td>
                    <td>3</td>
                    <td width="400">
                        <div class="layui-progress" lay-showPercent="yes">
                            <div class="layui-progress-bar layui-bg-green" lay-percent="3%"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>图片上传数量</td>
                    <td>140 / 月</td>
                    <td>13</td>
                    <td width="400">
                        <div class="layui-progress" lay-showPercent="yes">
                            <div class="layui-progress-bar layui-bg-green" lay-percent="13%"></div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection