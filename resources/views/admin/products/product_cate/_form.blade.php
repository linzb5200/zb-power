{{csrf_field()}}
<input type="hidden" name="parent_id" value="{{ $data->parent_id ?? 0 }}">
<div class="layui-form-item">
    <label for="" class="layui-form-label">上级分类</label>
    <div class="layui-input-block">
        <select name="parent_id" lay-search  lay-filter="parent_id">
            <option value="0">一级分类</option>
            @foreach($cate_list as $cate)
                <option value="{{$cate['id']}}" @if(isset($data->parent_id) && $data->parent_id == $cate['id']) selected @endif>{{$cate['tree_html']}}{{$cate['title']}}</option>
            @endforeach

        </select>
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">名称</label>
    <div class="layui-input-block">
        <input type="text" name="title" value="{{ $data->title ?? old('title') }}" lay-verify="required" placeholder="请输入名称" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">拼音</label>
    <div class="layui-input-block">
        <input type="text" name="pinyin" value="{{ $data->pinyin ?? old('pinyin') }}" placeholder="请输入拼音" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">点击量</label>
    <div class="layui-input-block">
        <input type="text" name="clicks" value="{{ $data->clicks ?? 0 }}" lay-verify="required|number" placeholder="请输入数字" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">排序</label>
    <div class="layui-input-block">
        <input type="text" name="sort" value="{{ $data->sort ?? 0 }}" lay-verify="required|number" placeholder="请输入数字" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">推荐</label>
    <div class="layui-input-block">
        <input type="radio" name="recommend" value="1" title="首页推荐" {{ $data->recommend == 1? 'checked' : '' }}>
        <input type="radio" name="recommend" value="0" title="无" {{ $data->recommend == 0? 'checked' : '' }}>
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.products_cate')}}" >返 回</a>
    </div>
</div>