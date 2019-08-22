@extends('admin.base')

@section('style')
@endsection
@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>编辑</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.system.update',['id'=>$data->id])}}" method="post">
                {{ method_field('put') }}
                @include('admin.system._form')
            </form>
        </div>
    </div>
@endsection


@section('script')
@endsection