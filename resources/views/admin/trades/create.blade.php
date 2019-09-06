@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加行业</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.trades.store')}}" method="post">
                @include('admin.trades._form')
            </form>
        </div>
    </div>
@endsection