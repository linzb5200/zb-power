
{{csrf_field()}}
<div class="layui-form-item">
    <label for="" class="layui-form-label">所属分类</label>
    <div class="layui-input-inline">
        <select name="type" lay-verify="required">
            <option value="">选择分类</option>
            <option value="0" @if(isset($data->type) && $data->type == 0) selected @endif>系统配置</option>
            <option value="1" @if(isset($data->type) && $data->type == 1) selected @endif>邮箱配置</option>
        </select>
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">键名</label>
    <div class="layui-input-block">
        <input type="text" name="key" value="{{ $data->key ?? old('key','') }}" lay-verify="required" placeholder="请输入键名" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">键值</label>
    <div class="layui-input-block">
        <input type="text" name="value" value="{{ $data->value ?? old('value','') }}" lay-verify="required" placeholder="请输入键值" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">备注</label>
    <div class="layui-input-block">
        <input type="text" name="remark" value="{{ $data->remark ?? old('remark','') }}" lay-verify="required" placeholder="请输入备注" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">排序</label>
    <div class="layui-input-inline">
        <input type="number" name="sort" value="{{ $data->sort  ?? old('sort',0) }}" lay-verify="required|number" placeholder="请输入数字" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.system')}}" >返 回</a>
    </div>
</div>