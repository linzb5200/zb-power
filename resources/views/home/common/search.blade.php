
<form class="layui-form" action="">
    <div class="layui-form-item">
        <div class="layui-inline select">
            <select name="city" class="layui-input layui-bg-gray " lay-verify="required">
                <option value=""></option>
                <option value="0">北京</option>
                <option value="1">上海</option>
                <option value="2">广州</option>
                <option value="3">深圳</option>
                <option value="4">杭州</option>
            </select>
        </div>
        <div class="layui-inline"><i class="line"></i>
            <input type="text" name="title" required lay-verify="required" placeholder="请输入标题" autocomplete="off"
                   class="layui-input input">
        </div>
        <div class="layui-inline">
            <button class="layui-btn layui-btn-boss" lay-submit lay-filter="searchForm">搜索</button>
        </div>

    </div>
</form>