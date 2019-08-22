@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>站点配置</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.system.store')}}" method="post">
                @include('admin.system._form')
            </form>
        </div>
    </div>
@endsection


@section('script')
@endsection