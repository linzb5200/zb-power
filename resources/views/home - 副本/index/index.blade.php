@extends('home.layouts.base')
@section('style')
    <link href="{{ asset('static/plugins/spectrum/spectrum.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('static/plugins/ueditor/themes/default/css/ueditor.css') }}" rel="stylesheet" >
@endsection
@section('content')
    <div class="content-box ">
        <div class="content-l">
            <ul class="layui-nav tab-nav ">

            </ul>
            <div class="content-scroll content-list">

            </div>
        </div>
        <div class="content-r">
            <div class="editor_content">
                <textarea name="content" id="editor_content"></textarea>
            </div>
            <div class="color-tools layui-form">
                <h3>调色盘</h3>
                <input type="text" id="color-input" class="none" style="display: none;">

                <select id="color-select" lay-filter="color-select">
                    <option value="1" selected="">选中换色</option>
                    <option value="2">全文换色</option>
                    <option value="3">素材换色</option>
                </select>
                <div class="layui-unselect layui-form-select">
                    <div class="layui-select-title">
                        <input type="text" placeholder="请选择" value="选中换色" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i>
                    </div>
                    <dl class="layui-anim layui-anim-upbit">
                        <dd lay-value="1" class="layui-this">选中换色</dd>
                        <dd lay-value="2" class="">全文换色</dd>
                        <dd lay-value="3" class="">素材换色</dd>
                    </dl>
                </div>
                <ul class="color-list clear">
                    <li style="background-color: #ac1d10" data-color="#ac1d10"></li>
                    <li style="background-color: #d82821;" data-color="#d82821"></li>
                    <li style="background-color: #ef7060;" data-color="#ef7060"></li>
                    <li style="background-color: #fde2d8;" data-color="#fde2d8"></li>
                    <li style="background-color: #d32a63;" data-color="#d32a63"></li>
                    <li style="background-color: #eb6794;" data-color="#eb6794"></li>
                    <li style="background-color: #f5bdd1;" data-color="#f5bdd1"></li>
                    <li style="background-color: #ffebf0;" data-color="#ffebf0"></li>
                    <li style="background-color: #e2561b;" data-color="#e2561b"></li>
                    <li style="background-color: #ff8124;" data-color="#ff8124"></li>
                    <li style="background-color: #fcb42b;" data-color="#fcb42b"></li>
                    <li style="background-color: #feecaf;" data-color="#feecaf"></li>
                    <li style="background-color: #0c8918;" data-color="#0c8918"></li>
                    <li style="background-color: #80b135;" data-color="#80b135"></li>
                    <li style="background-color: #c2c92a;" data-color="#c2c92a"></li>
                    <li style="background-color: #e5f3d0;" data-color="#e5f3d0"></li>
                    <li style="background-color: #374aae;" data-color="#374aae"></li>
                    <li style="background-color: #1e9be8;" data-color="#1e9be8"></li>
                    <li style="background-color: #59c3f9;" data-color="#59c3f9"></li>
                    <li style="background-color: #b6e4fd;" data-color="#b6e4fd"></li>
                    <li style="background-color: #8d4bbb;" data-color="#8d4bbb"></li>
                    <li style="background-color: #a65bcb;" data-color="#a65bcb"></li>
                    <li style="background-color: #cca4e3;" data-color="#cca4e3"></li>
                    <li style="background-color: #be7763;" data-color="#be7763"></li>
                    <li style="background-color: #212122;" data-color="#212122"></li>
                    <li style="background-color: #757576;" data-color="#757576"></li>
                    <li style="background-color: #c6c6c7;" data-color="#c6c6c7"></li>
                    <li style="background-color: #f5f5f4;" data-color="#f5f5f4"></li>
                </ul>
                <span class="color-more"><i class="fa fa-angle-double-down"></i>更多配色</span>
            </div>

            <div class="operate-tool">
                <button type="button" class="layui-btn layui-btn-primary" id="btn_copy_wx"><i class="fa fa-copy"></i>微信复制</button>
                <button type="button" class="layui-btn layui-btn-primary" id="btn_save" data-cate-id="" data-type="art" data-id="" data-name="" data-thumbnail="" data-summary="" data-link="" data-author="" data-artcover=""><i class="fa fa-save"></i>保存文章</button>
                <button type="button" class="layui-btn layui-btn-primary" id="btn_remote_art"><i class="fa fa-file-code-o"></i>导入文章</button>
                <button type="button" class="layui-btn layui-btn-primary" id="btn_art_image"><i class="fa fa-file-image-o"></i>生成图片</button>
                <button type="button" class="layui-btn layui-btn-primary" id="btn_trash"><i class="fa fa-trash-o"></i>清空内容</button>
                <button type="button" class="layui-btn layui-btn-primary" id="btn_drafts" data-time="300"><i class="fa fa-file-text-o"></i>云端草稿</button>
                <button type="button" class="layui-btn layui-btn-primary" id="btn_preview"><i class="fa fa-eye"></i>文章预览</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('static/home/js/changecolor.js')}}"></script>
    <script src="{{asset('static/home/js/tinycolor.js')}}"></script>
    <script src="{{asset('static/home/js/crypto-js.js')}}"></script>
    <script src="{{asset('static/plugins/spectrum/spectrum.js')}}"></script>
    <script src="{{asset('static/plugins/ueditor/ueditor.config.js')}}"></script>
    <script src="{{asset('static/plugins/ueditor/ueditor.all.min.js')}}"></script>
    <script src="{{asset('static/plugins/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
    <script src="{{asset('static/plugins/ueditor/third-party/zeroclipboard/ZeroClipboard.min.js')}}"></script>
    <script src="{{asset('static/home/js/common.js')}}"></script>
    <script src="{{asset('static/home/js/index.js')}}"></script>
@endsection