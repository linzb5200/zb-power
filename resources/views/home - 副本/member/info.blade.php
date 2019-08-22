@extends('home.member.layouts.base')

@section('content')
    <div class="layui-tab layui-tab-brief">
            <span class="layui-breadcrumb">
              <a href="">用户中心</a>
              <a><cite>个人信息</cite></a>
            </span>
        <hr>
        <br>

        <div class="layui-form layui-form-pane layui-tab-item layui-show" lay-filter="info">
            <form method="post">
                <div class="layui-form-item">
                    <label for="info_nickname" class="layui-form-label">昵称</label>
                    <div class="layui-input-inline">
                        <input type="text" id="info_nickname" name="nickname" required lay-verify="nickname" autocomplete="off" value="{{ auth('member')->user()->nickname }}" class="layui-input" readonly>
                    </div>
                    <div class="layui-form-mid layui-word-aux"><a href="javascript:;" class="edit_nickname" style="font-size: 12px; color: #4f99cf;">更换昵称</a></div>
                </div>
                <div class="layui-form-item">
                    <label for="info_level" class="layui-form-label">会员等级</label>
                    <div class="layui-input-inline">
                        <input type="text" id="info_level" name="level" required lay-verify="level" autocomplete="off" value="{{ auth('member')->user()->mobile }}" class="layui-input" readonly>
                    </div>
                    <div class="layui-form-mid layui-word-aux"><a href="#" style="font-size: 12px; color: #4f99cf;">购买会员</a></div>
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
            </form>
        </div>


    </div>
@endsection
