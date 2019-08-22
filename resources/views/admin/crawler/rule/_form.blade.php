{{csrf_field()}}

<div class="layui-form-item">
    <label for="" class="layui-form-label" style="width: 10%;">目标网站</label>
    <div class="layui-input-inline" style="width: 70%;">
        <input type="text" name="name" value="{{ $data->name ?? old('name') }}" lay-verify="required" placeholder="请输入目标网站" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label" style="width: 10%;">目标链接</label>
    <div class="layui-input-inline" style="width: 70%;">
        <input type="text" name="url" value="{{ $data->url ?? old('url','') }}" lay-verify="required" placeholder="请输入目标链接" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label" style="width: 10%;">分类链接规则</label>
    <div class="layui-input-inline" style="width: 70%;">
        <input type="text" name="pick_category" value="{{ $data->pick_category ?? old('pick_category','') }}" lay-verify="required" placeholder="请输入采集分类链接规则" class="layui-input" >
    </div>
</div>


<div class="layui-form-item">
    <label for="" class="layui-form-label" style="width: 10%;">分类名称规则</label>
    <div class="layui-input-inline" style="width: 70%;">
        <input type="text" name="pick_category_text" value="{{ $data->pick_category_text ?? old('pick_category_text','') }}" lay-verify="required" placeholder="请输入采集分类名称规则" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label" style="width: 10%;">页码规则</label>
    <div class="layui-input-inline" style="width: 70%;">
        <input type="text" name="pick_page" value="{{ $data->pick_page ?? old('pick_page','') }}" lay-verify="required" placeholder="请输入页码规则" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label" style="width: 10%;">当前页规则</label>
    <div class="layui-input-inline" style="width: 70%;">
        <input type="text" name="pick_current_page" value="{{ $data->pick_current_page ?? old('pick_current_page','') }}" lay-verify="required" placeholder="请输入当前页规则" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label" style="width: 10%;">文章标题规则</label>
    <div class="layui-input-inline" style="width: 70%;">
        <input type="text" name="pick_title" value="{{ $data->pick_title ?? old('pick_title','') }}" lay-verify="required" placeholder="请输入采集标题规则" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label" style="width: 10%;">文章链接规则</label>
    <div class="layui-input-inline" style="width: 70%;">
        <input type="text" name="pick_link" value="{{ $data->pick_link ?? old('pick_link','') }}" lay-verify="required" placeholder="请输入文章链接规则" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label" style="width: 10%;">文章内容规则</label>
    <div class="layui-input-inline" style="width: 70%;">
        <input type="text" name="pick_content" value="{{ $data->pick_content ?? old('pick_content','') }}" lay-verify="required" placeholder="请输入内容规则" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label" style="width: 10%;">文章标签规则</label>
    <div class="layui-input-inline" style="width: 70%;">
        <input type="text" name="pick_tag" value="{{ $data->pick_tag ?? old('pick_tag','') }}" lay-verify="" placeholder="请输入文章标签规则" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label" style="width: 10%;">文章缩略图规则</label>
    <div class="layui-input-inline" style="width: 70%;">
        <input type="text" name="pick_thumb" value="{{ $data->pick_thumb ?? old('pick_thumb','') }}" lay-verify="required" placeholder="请输入缩略图规则" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label" style="width: 10%;">文件独立链接页面规则</label>
    <div class="layui-input-inline" style="width: 70%;">
        <input type="text" name="pick_file_blank" value="{{ $data->pick_file_blank ?? old('pick_file_blank','') }}" placeholder="请输入文件独立链接页面规则" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label" style="width: 10%;">文章文件下载地址规则</label>
    <div class="layui-input-inline" style="width: 70%;">
        <input type="text" name="pick_file" value="{{ $data->pick_file ?? old('pick_file','') }}" placeholder="请输入文件下载地址规则" class="layui-input" >
    </div>
</div>


<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.crawler_rule')}}" >返 回</a>
    </div>
</div>