
<form class="layui-form" action="">
    <div class="layui-form-item">
        <div class="layui-inline select">
            <select name="cate" class="layui-input layui-bg-gray " lay-verify="required">
                <option value=""></option>
                @foreach($nav as $key => $nv)
                    <option value="{{$nv['zm']}}">{{$nv['title']}}</option>
                @endforeach
            </select>
        </div>
        <div class="layui-inline"><i class="line"></i>
            <input type="text" name="keywords" required lay-verify="required" placeholder="请输入标题" autocomplete="off"
                   class="layui-input input">
        </div>
        <div class="layui-inline">
            <button class="layui-btn layui-btn-boss" lay-submit lay-filter="searchForm">搜索</button>
        </div>

    </div>
</form>