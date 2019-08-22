@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>添加分类</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.products_cate.store')}}" method="post">
                @include('admin.products.product_cate._form')
            </form>
        </div>
    </div>
@endsection