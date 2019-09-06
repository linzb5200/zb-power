@extends('home.layouts.user.add')

@section('content')
    <div class="layui-container fly-marginTop">
        <div class="layui-card publish" pad20 style="padding-top: 5px;">

            <div class="layui-card-header">
                <fieldset class="layui-elem-field layui-field-title layui-inline">
                    <legend>发布作品</legend>
                </fieldset>
            </div>

            <div class="layui-card-body">

                <div class="layui-text" style="margin-bottom: 30px;">
                    <blockquote class="layui-elem-quote">          发布之前，请务必详细阅读：《<a href="https://fly.layui.com/extend/demo/" target="_blank">作品发布规范</a>》
                    </blockquote>
                </div>

                <div class="layui-form layui-form-pane">
                    <form action="" method="post">

                        <div class="layui-row layui-col-space10">
                            <div class="layui-col-md6">
                                <label for="L_title" class="layui-form-label">标题</label>
                                <div class="layui-input-block">
                                    <input type="text" id="L_title" name="title" required lay-verify="required" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-col-md6">
                                <label class="layui-form-label">所在分类</label>
                                <div class="layui-input-inline">
                                    <select lay-verify="required" name="class" lay-filter="column">
                                        <option></option>
                                        <option value="0">提问</option>
                                        <option value="99">分享</option>
                                        <option value="100">讨论</option>
                                        <option value="101">建议</option>
                                        <option value="168">公告</option>
                                        <option value="169">动态</option>
                                    </select>
                                </div>
                                <div class="layui-input-inline">
                                    <select lay-verify="required" name="class" lay-filter="column">
                                        <option></option>
                                        <option value="0">提问</option>
                                        <option value="99">分享</option>
                                        <option value="100">讨论</option>
                                        <option value="101">建议</option>
                                        <option value="168">公告</option>
                                        <option value="169">动态</option>
                                    </select>
                                </div>
                            </div>

                            <div class="layui-col-md12">
                                <div class="layui-form-item layui-form-text">
                                    <div class="layui-input-block">
                                        <textarea id="L_content" name="content" required lay-verify="required" placeholder="" class="layui-textarea fly-editor" style="height: 260px;"></textarea>
                                        <label class="layui-form-label" style="top: -2px;">内容文档</label>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md12">
                                <div class="layui-upload">
                                    <button type="button" class="layui-btn" id="test1">
                                        <i class="layui-icon layui-icon-upload"></i>封面图
                                    </button>
                                    <div class="layui-upload-list">
                                        <img class="layui-upload-img" id="demo1">
                                        <p id="demoText"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md12">

                                <div>
                                    <input type="hidden" name="res" required="" lay-verify="resRequired" value="" id="FLY-extend-res">
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-upload-drag" id="FLY-extend-upload" style="width: 100%; padding: 20px 20px 10px; box-sizing: border-box;">
                                        <i class="layui-icon layui-icon-upload"></i>
                                        <p>上传组件包（文件格式：zip / rar / 7z）</p>
                                    </div>
                                    <input class="layui-upload-file" type="file" accept="" name="file">
                                </div>
                            </div>
                            <div class="layui-col-md12">

                                <div class="layui-form-item">
                                    <label for="L_vercode" class="layui-form-label">图形码</label>
                                    <div class="layui-input-inline">
                                        <input type="text" id="L_vercode" name="vercode" required lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid">
                                        <span style="color: #c00;">1+1=?</span>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-md12">
                                <div class="layui-form-item">
                                    <button class="layui-btn" lay-filter="*" lay-submit>立即发布</button>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection