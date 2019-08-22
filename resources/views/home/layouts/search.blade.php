
<div class="search-box top100">
    <form class="layui-form search-form" action="/search/">
        {{csrf_field()}}
        <div class="layui-form-item">

            <div class="layui-inline">
                <select name="id" class="layui-input select" lay-verify="required">
                    @foreach($navs as $key => $nav)
                        <option value="{{$nav['id']}}">{{$nav['title']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="layui-inline">
                <input type="text" name="keyword" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input input">
            </div>
            <div class="layui-inline pull-right">
                <button class="layui-btn layui-btn-primary btn-search" lay-submit lay-filter="searchForm">搜索</button>
            </div>

        </div>
    </form>
</div>