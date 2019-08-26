@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>更新行业</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.trades.update',['id'=>$trades->id])}}" method="post">
                {{ method_field('put') }}
                @include('admin.trades._form')
            </form>
        </div>
    </div>
@endsection