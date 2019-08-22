@extends('admin.base')
@section('style')
    <style>
        .layui-form-item .layui-form-label{
            width: 10%!important;
        }
        .layui-form-item .layui-input-inline{
            width: 100%!important;
        }
    </style>
@endsection
@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加规则</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.crawler_rule.store')}}" method="post">
                @include('admin.crawler.rule._form')
            </form>
        </div>
    </div>
@endsection

@section('script')

@endsection