@extends('home.member.layouts.base')

@section('content')
    <div class="layui-tab layui-tab-brief" lay-filter="user">
        <span class="layui-breadcrumb">
          <a href="">用户中心</a>
          <a><cite>我保存的文章</cite></a>
        </span>
        <hr>

        <div class="layui-tab-content" style="padding: 20px 0;">
            <div class="layui-tab-item layui-show">
                <ul class="mine-view jie-row">

                    @foreach($items as $key => $item)
                    <li>
                        <a class="jie-title" href="../jie/detail.html" target="_blank">{{$item->title}}</a>
                        <div class="pull-right">
                            <i>{{$item->created_at}}</i>
                            <a class="mine-edit" href="/jie/edit/8116">提交审核</a>
                            <a class="mine-edit" href="/jie/edit/8116">编辑</a>
                            <a class="mine-edit" href="/jie/edit/8116">删除</a>
                            <a class="mine-edit" href="/jie/edit/8116">查看</a>
                        </div>
                    </li>
                    @endforeach

                </ul>
                <div id="LAY_page"></div>
            </div>
        </div>
    </div>
@endsection