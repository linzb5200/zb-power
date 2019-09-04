<?php

namespace App\Http\Controllers\Home\User;

use Illuminate\Http\Request;
use App\Models\Member;

class AjaxController extends UserCenterController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:member')
            ->except(['pwd','nickname','validatephone','changephone','changeemail',
                'validateemail','bind_qr','unbind_qq','senddx','sign']);
    }

    //修改密码
    public function pwd(Request $request)
    {

        $this->validate($request,[
            'nowpass'=>'required|min:3|max:8',
            'password'=>'required|min:3|max:8|confirmed',
            'password_confirmation'=>'required|min:3|max:8',
        ]);
        $id = auth('member')->user()->id;
        $member = Member::findOrFail($id);

        if(!\Hash::check($request->input('nowpass'), $member->password)){
            return response()->json(['status' => 1099,'msg' => '旧密码不正确']);
        }
        if ($member->update(['password'=>bcrypt($request->input('password'))])){
            return response()->json(['status' => 0,'msg' => '修改成功']);
        }
        return response()->json(['status' => 1099,'msg' => '系统错误']);
    }

    //修改昵称
    public function nickname(Request $request)
    {

        $data = $this->validate($request,[
            'nickname'=>'required|min:3|max:20',
        ]);

        $id = auth('member')->user()->id;
        $member = Member::findOrFail($id);

        if ($member->update($data)){
            return response()->json(['status' => 0,'msg' => '修改成功']);
        }
        return response()->json(['status' => 1099,'msg' => '系统错误']);
    }

    //验证手机
    public function validatephone(Request $request)
    {
        $data = $this->validate($request,[
            'phone'=>'required',
            'code'=>'required',
        ]);
        $validate_code = request()->cookie('phone_code');
        if ($data['code'] != $validate_code){
            return response()->json(['status' => 1099,'msg' => '手机验证码错误']);
        }

        $id = auth('member')->user()->id;
        $member = Member::findOrFail($id);

        if ($member->mobile == $data['phone']){
            \Cookie::queue('phone_code', null);
            return response()->json(['status' => 0,'msg' => '手机号码正确']);
        }
        return response()->json(['status' => 1099,'msg' => '手机号码错误']);
    }

    //修改手机
    public function changephone(Request $request)
    {
        $data = $this->validate($request,[
            'phone'=>'required',
            'code'=>'required',
        ]);
        $validate_code = request()->cookie('phone_code');
        if ($data['code'] != $validate_code){
            return response()->json(['status' => 1099,'msg' => '手机验证码错误']);
        }

        $id = auth('member')->user()->id;
        $member = Member::findOrFail($id);

        if ($member->update(['mobile'=>$data['phone']])){
            \Cookie::queue('phone_code', null);
            return response()->json(['status' => 0,'msg' => '修改成功']);
        }
        return response()->json(['status' => 1099,'msg' => '手机号码错误']);
    }

    //修改邮箱
    public function changeemail(Request $request)
    {

        $data = $this->validate($request,[
            'email'=>'required|email',
            'code'=>'required',
        ]);

        $validate_code = request()->cookie('email_code');
        if ($data['code'] != $validate_code){
            return response()->json(['status' => 1099,'msg' => '邮箱验证码错误']);
        }

        $id = auth('member')->user()->id;
        $member = Member::findOrFail($id);
        unset($data['code']);

        if ($member->update($data)){
            \Cookie::queue('email_code', null);
            return response()->json(['status' => 0,'msg' => '修改成功']);
        }
        return response()->json(['status' => 1099,'msg' => '系统错误']);
    }

    //获取邮箱验证码
    public function validateemail(Request $request)
    {

        $data = $this->validate($request,[
            'email'=>'required|email',
        ]);
        $code = rand(1000,9999);
        \Cookie::queue('email_code', $code, time()+90);
        $send = sendMailer($data['email'],'获取验证码', '你的验证码是：'.$code);


        return response()->json($send);
    }


    public function bind_qr(Request $request)
    {

        $data = $this->validate($request,[
            'nickname'=>'required|min:3|max:8',
        ]);

        $id = auth('member')->user()->id;
        $member = Member::findOrFail($id);

        if ($member->update($data)){
            return response()->json(['status' => 0,'msg' => '更新成功']);
        }
        return response()->json(['status' => 1099,'msg' => '系统错误']);
    }

    public function unbind_qq(Request $request)
    {

        $data = $this->validate($request,[
            'nickname'=>'required|min:3|max:8',
        ]);

        $id = auth('member')->user()->id;
        $member = Member::findOrFail($id);

        if ($member->update($data)){
            return response()->json(['status' => 0,'msg' => '更新成功']);
        }
        return response()->json(['status' => 1099,'msg' => '系统错误']);
    }

    //短信验证码
    public function senddx(Request $request)
    {
        $data = $this->validate($request,[
            'phone'=>'required',
        ]);
        $code = rand(1000,9999);
        \Cookie::queue('phone_code', $code, time()+90);

        $send= ['status'=>0,'msg'=>'发送成功'.$code];

//        $send = sendSms($data['phone'],$code);

        return response()->json($send);

    }

    //签到
    public function sign(Request $request)
    {
        $id = auth('member')->user()->id;
        $member = Member::findOrFail($id);
        $score = $member->score + 5;
        if ($member->update(['score'=>$score])){
            return response()->json(['status' => 0,'msg' => '签单成功']);
        }
        return response()->json(['status' => 1099,'msg' => '签单失败']);
    }
}
