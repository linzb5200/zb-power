{{csrf_field()}}
<div class="layui-form-item">
    <label for="" class="layui-form-label">用户名</label>
    <div class="layui-input-inline">
        <input type="text" name="name" value="{{ $member->name ?? old('name') }}" lay-verify="required" placeholder="请输入用户名" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">密码</label>
    <div class="layui-input-inline">
        <input type="password" name="password" placeholder="请输入密码" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">确认密码</label>
    <div class="layui-input-inline">
        <input type="password" name="password_confirmation" placeholder="请输入密码" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">邮箱</label>
    <div class="layui-input-inline">
        <input type="text" name="email" value="{{$member->email??old('email')}}" required="email" lay-verify="email" placeholder="请输入邮箱" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">手机号</label>
    <div class="layui-input-inline">
        <input type="text" name="mobile" value="{{$member->mobile??old('mobile')}}" required="mobile" lay-verify="mobile" placeholder="请输入手机号" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">个人描述</label>
    <div class="layui-input-inline">
        <textarea name="description" class="layui-input" cols="30" rows="10">{{$member->description??old('description')}}</textarea>
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-input-inline">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
            <input type="radio" name="status" id="status" value="1" title="正常" @if(isset($member->status) && $member->status == 1) checked @endif>
            <input type="radio" name="status" id="status" value="0" title="锁定" @if(isset($member->status) && $member->status == 0) checked @endif>
        </div>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">头像</label>
    <div class="layui-input-block">
        <div class="layui-upload">
            <button type="button" class="layui-btn" id="uploadPic"><i class="layui-icon">&#xe67c;</i>图片上传</button>
            <div class="layui-upload-list" >
                <ul id="layui-upload-box" class="layui-clear">
                    @if(isset($member->avatar) && $member->avatar > 0)
                        <li><img src="{{ getImagePath($member->avatar) }}" /><p>上传成功</p></li>
                    @endif
                </ul>
                <input type="hidden" name="avatar" id="avatar" value="{{ $member->avatar??0 }}">
            </div>
        </div>
    </div>
</div>
<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.member')}}" >返 回</a>
    </div>
</div>