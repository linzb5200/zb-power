@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>更新标签</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.color.update',['id'=>$color->id])}}" method="post">
                {{ method_field('put') }}
                @include('admin.color._form')
            </form>
        </div>
    </div>
@endsection