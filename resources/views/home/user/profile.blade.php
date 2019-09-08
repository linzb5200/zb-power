@extends('home.layouts.user.base')

@section('content')

    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="user">
            <ul class="layui-tab-title" id="LAY_mine">
                <li class="layui-this" lay-id="info">我的资料</li>
                <li lay-id="avatar">头像</li>
                <li lay-id="pass">密码</li>
            </ul>
            <div class="layui-tab-content" style="padding: 20px 0;">
                <div class="layui-form layui-form-pane layui-tab-item layui-show">
                    <form method="post" id="F_profile">
                        <div class="layui-form-item">
                            <label for="info_nickname" class="layui-form-label">昵称</label>
                            <div class="layui-input-inline">
                                <input type="text" id="info_nickname" name="nickname" required lay-verify="nickname" autocomplete="off" value="{{ auth('member')->user()->nickname }}" class="layui-input" readonly>
                            </div>
                            <div class="layui-form-mid layui-word-aux"><a href="javascript:;" class="edit_nickname" style="font-size: 12px; color: #4f99cf;">更换昵称</a></div>
                        </div>
                        <div class="layui-form-item">
                            <label for="info_phone" class="layui-form-label">手机</label>
                            <div class="layui-input-inline">
                                <input type="text" id="info_phone" name="mobile" required lay-verify="mobile" autocomplete="off" value="{{ auth('member')->user()->mobile }}" class="layui-input" readonly>
                            </div>
                            <div class="layui-form-mid layui-word-aux"><a href="javascript:;" class="edit_phone" style="font-size: 12px; color: #4f99cf;">更换手机</a></div>
                        </div>
                        <div class="layui-form-item">
                            <label for="info_email" class="layui-form-label">邮箱</label>
                            <div class="layui-input-inline">
                                <input type="text" id="info_email" name="email" value="{{ auth('member')->user()->email }}" required lay-verify="email" autocomplete="off" class="layui-input" readonly>
                            </div>
                            <div class="layui-form-mid layui-word-aux"><a href="javascript:;" class="edit_email" style="font-size: 12px; color: #4f99cf;">设置邮箱</a></div>
                        </div>
                        <div class="layui-form-item">
                            <label for="info_qq" class="layui-form-label">QQ</label>
                            <div class="layui-input-inline">
                                <input type="text" id="info_qq" name="qq" required lay-verify="qq" autocomplete="off" value="" class="layui-input" readonly>
                            </div>
                            <div class="layui-form-mid layui-word-aux"><a href="javascript:;" class="bind_qr" style="font-size: 12px; color: #4f99cf;">绑定QQ帐号</a>，QQ快速登录。</div>
                        </div>
                        <div class="layui-form-item">
                            <label for="info_wechat" class="layui-form-label">微信号</label>
                            <div class="layui-input-inline">
                                <input type="text" id="info_wechat" name="wechat" required lay-verify="wechat" autocomplete="off" value="" class="layui-input" readonly>
                            </div>
                            <div class="layui-form-mid layui-word-aux"><a href="javascript:;" class="bind_qr" style="font-size: 12px; color: #4f99cf;">绑定微信号</a>，扫码微信登录。</div>
                        </div>
                        <div class="layui-form-item layui-form-text" hidden>
                            <label for="L_sign" class="layui-form-label">签名</label>
                            <div class="layui-input-block">
                                <textarea placeholder="随便写些什么刷下存在感" id="L_sign"  name="sign" autocomplete="off" class="layui-textarea" style="height: 80px;"></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item" hidden>
                            <button class="layui-btn" key="" lay-filter="F_profile" lay-submit>确认修改</button>
                        </div>
                    </form>
                </div>

                <div class="layui-form layui-form-pane layui-tab-item">
                    <div class="layui-form-item">
                        <div class="avatar-add">
                            <p>建议尺寸168*168，支持jpg、png、gif，最大不能超过100KB</p>
                            <button type="button" class="layui-btn upload-img">
                                <i class="layui-icon">&#xe67c;</i>上传头像
                            </button>
                            <img src="{{ getImagePath(auth('member')->user()->avatar) }}">
                            <span class="loading"></span>
                        </div>
                    </div>
                </div>

                <div class="layui-form layui-form-pane layui-tab-item">
                    <form action="{{route('home.user.pwd')}}" method="post">
                        <div class="layui-form-item">
                            <label for="L_nowpass" class="layui-form-label">当前密码</label>
                            <div class="layui-input-inline">
                                <input type="password" id="L_nowpass" name="nowpass" required lay-verify="required" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label for="L_password" class="layui-form-label">新密码</label>
                            <div class="layui-input-inline">
                                <input type="password" id="L_password" name="password" required lay-verify="required" autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux">6到16个字符</div>
                        </div>
                        <div class="layui-form-item">
                            <label for="L_password_confirmation" class="layui-form-label">确认密码</label>
                            <div class="layui-input-inline">
                                <input type="password" id="L_password_confirmation" name="password_confirmation" required lay-verify="required" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <button class="layui-btn" key="" lay-filter="F_repass" lay-submit>确认修改</button>
                        </div>
                    </form>
                </div>


            </div>

        </div>
    </div>
@endsection
@section('script')

@endsection