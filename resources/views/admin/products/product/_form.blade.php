{{csrf_field()}}

<div class="layui-form-item">
    <label for="" class="layui-form-label">标题</label>
    <div class="layui-input-block">
        <input type="text" name="title" value="{{ $data->title ?? old('title') }}" lay-verify="required" placeholder="请输入标题" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">关键词</label>
    <div class="layui-input-block">
        <input type="text" name="keywords" value="{{$data->keywords??old('keywords')}}" lay-verify="required" placeholder="请输入关键词" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">描述</label>
    <div class="layui-input-block">
        <textarea name="description" placeholder="请输入描述" class="layui-textarea">{{$data->description??old('description')}}</textarea>
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">发布时间</label>
    <div class="layui-input-block">
        <input type="text" name="created_at" value="@if($created_at) {{$created_at}} @else {{ $data->created_at ?? old('created_at') }} @endif" lay-verify="required" placeholder="yyyy-MM-dd HH:mm:ss" class="layui-input laydatetime" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">所属分类</label>
    <div class="layui-input-block">
        <select name="cate_str" xm-select="cate_str" xm-select-radio="">
        </select>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">标签</label>
    <div class="layui-input-block">
        <select name="tags" xm-select="selectId" xm-select-search="">
            @foreach($tags as $tag)
                <option value="{{$tag['id']}}" {{ $tag->selected??'' }}>{{$tag['name']}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">风格</label>
    <div class="layui-input-block">
        @foreach($styles as $style)
            <input type="checkbox" name="style[]" value="{{$style['id']}}" title="{{$style['name']}}" {{ $style->checked??'' }}>
        @endforeach
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">行业</label>
    <div class="layui-input-block">
        @foreach($trades as $trade)
            <input type="checkbox" name="trades[]" value="{{$trade['id']}}" title="{{$trade['name']}}" {{ $trade->checked??'' }}>
        @endforeach
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">颜色</label>
    <div class="layui-input-block">
        @foreach($colors as $color)
            <input type="checkbox" name="color[]" value="{{$color['id']}}" title="{{$color['name']}}" {{ $color->checked??'' }}>
        @endforeach
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">软件</label>
    <div class="layui-input-block">
        <input type="radio" name="soft" value="1" title="PowerPoint 2003" @if($data->soft == 1) checked @endif>
        <input type="radio" name="soft" value="2" title="PowerPoint 2007" @if($data->soft == 2) checked @endif>
        <input type="radio" name="soft" value="3" title="PowerPoint 2010" @if($data->soft == 3) checked @endif>
        <input type="radio" name="soft" value="4" title="PowerPoint 2016" @if($data->soft == 4) checked @endif>
        <input type="radio" name="soft" value="5" title="其他版本" @if($data->soft == 5) checked @endif>
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">类型</label>
    <div class="layui-input-block">
        <input type="radio" name="type" value="1" title="动态" @if($data->type == 1) checked @endif>
        <input type="radio" name="type" value="2" title="静态" @if($data->type == 2) checked @endif>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">积分</label>
    <div class="layui-input-block">
        <input type="text" name="points" value="{{ $data->points ?? old('points',0) }}" lay-verify="required|number" placeholder="请输入积分" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">随机点击量</label>
    <div class="layui-input-block">
        <input type="text" name="rand_clicks" value="{{ $data->rand_clicks ?? old('rand_clicks',$rand['rand_clicks']) }}" lay-verify="required|number" placeholder="请输入点击量" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">随机收藏数</label>
    <div class="layui-input-block">
        <input type="text" name="rand_fav" value="{{ $data->rand_fav ?? old('rand_fav',$rand['rand_fav']) }}" lay-verify="required|number" placeholder="请输入收藏数" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">随机点赞数量</label>
    <div class="layui-input-block">
        <input type="text" name="rand_zan" value="{{ $data->rand_zan ?? old('rand_zan',$rand['rand_zan']) }}" lay-verify="required|number" placeholder="请输入点赞数量" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">随机使用数</label>
    <div class="layui-input-block">
        <input type="text" name="rand_used" value="{{ $data->rand_used ?? old('rand_used',$rand['rand_used']) }}" lay-verify="required|number" placeholder="请输入使用数" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">随机下载量</label>
    <div class="layui-input-block">
        <input type="text" name="rand_download" value="{{ $data->rand_download ?? old('rand_download',$rand['rand_download']) }}" lay-verify="required|number" placeholder="请输入下载量" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">文件大小MB</label>
    <div class="layui-input-block">
        <input type="text" name="size" value="{{ $data->size ?? old('size',0) }}" lay-verify="required|number" placeholder="请输入文件大小" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">文件类型</label>
    <div class="layui-input-block">
        <input type="text" name="format" value="{{ $data->format ?? old('format','pptx') }}" lay-verify="required" placeholder="请输入文件类型" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">页面数量</label>
    <div class="layui-input-block">
        <input type="text" name="page" value="{{ $data->page ?? old('page',2) }}" lay-verify="required" placeholder="请输入页面数量" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">排序</label>
    <div class="layui-input-block">
        <input type="number" name="sort" value="{{ $data->sort  ?? old('sort',99) }}" lay-verify="required|number" placeholder="请输入数字" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">封面图</label>
    <div class="layui-input-block">
        <div class="layui-upload">
            <button type="button" class="layui-btn" id="uploadButton"><i class="layui-icon">&#xe67c;</i>图片上传</button>
            <div class="layui-upload-list" >
                <ul class="layui-clear upload-container">
                    @if(isset($data->thumb) && $data->thumb > 0)
                        <li data-id="{{ $data->thumb }}" class="img-item">
                            <img src="{{ getImagePath($data->thumb) }}" />
                            <i class="tip">上传成功</i>
                        </li>
                    @endif
                </ul>
                <input type="hidden" name="thumb" class="img-id" value="{{ $data->thumb??0 }}">
            </div>
        </div>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">附件</label>
    <div class="layui-input-block">
        <div class="layui-upload">
            <button type="button" class="layui-btn" id="uploadButton1" lay-data="{exts: 'pptx|ppt|xlsx|xltm|docx|doc'}"><i class="layui-icon">&#xe67c;</i>上传附件</button>
            <div class="layui-upload-list">
                <ul class="layui-clear upload-container">
                    @if(!empty($images))
                        @foreach($images as $image)

                            <li data-id="{{ $image }}" class="file-item">
                                <input type="text" value="{{ getImagePath($image) }}"  class="layui-input">
                                <i class="fa fa-arrow-left"></i>
                                <i class="fa fa-trash"></i>
                                <i class="fa fa-arrow-right"></i>
                                <i class="tip">上传成功</i>
                            </li>

                        @endforeach
                    @endif
                </ul>
                <input type="hidden" name="attachment" class="img-id" value="{{ $data->attachment??0 }}">
            </div>
        </div>
    </div>
</div>


@include('UEditor::head');
<div class="layui-form-item">
    <label for="" class="layui-form-label">内容</label>
    <div class="layui-input-block">
        <script id="container" name="content" type="text/plain">
            {!! $data->content??old('content') !!}
        </script>
    </div>
</div>

<div class="layui-form-item" style="position: fixed;z-index:9999;bottom: 5px;margin-top: 5px;">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.products')}}" >返 回</a>
    </div>
</div>