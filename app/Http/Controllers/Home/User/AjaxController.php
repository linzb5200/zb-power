<?php

namespace App\Http\Controllers\Home\User;

use App\Models\Members\Mine;
use App\Models\Members\Score;
use App\Models\Products\Products;
use Illuminate\Http\Request;
use App\Models\Member;

class AjaxController extends UserCenterController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:member')
            ->except(['avatar','pwd','nickname','validatephone','changephone','changeemail',
                'validateemail','bind_qr','unbind_qq','senddx','sign','top','fav','zan','download']);
    }

    //修改头像
    public function avatar(Request $request)
    {

        $id = auth('member')->user()->id;
        $member = Member::findOrFail($id);
        $avatar = $request->input('avatar');

        if ($avatar && $member->update(['avatar'=>$request->input('avatar')])){
            return response()->json(['status' => 0,'msg' => '修改成功']);
        }
        return response()->json(['status' => 1099,'msg' => '系统错误']);
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


    //绑定微信
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

    //绑定QQ
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

        $latest = (new Score)->latest($id);

        if($latest['today']){
            return response()->json(['status' => 1099,'msg' => '今日已签到']);
        }

        if($latest['now']->keep == 0){
            $latest['now']->keep =1;
        }

        $data = [
            'uid'=>$id,
            'type'=>1,
            'way'=>1,
            'score'=>$member->score + $latest['now']->change,
            'change'=>$latest['now']->change,
            'keep'=>$latest['now']->keep,
            'ip'=>$request->ip(),
            'status'=>1,
        ];

        $sign = Score::create($data);
        if ($sign){
            $member->update(['score'=>$score]);
            return response()->json(['status' => 0,'msg' => '签到成功','data'=>$data]);
        }
        return response()->json(['status' => 1099,'msg' => '签到失败']);
    }
    //活跃榜 TOP20
    public function top(Request $request)
    {
        $model = new Score;
        $data = [];
        //最新签到
        $data[] = $model->newest();
        //今日最快
        $data[] = $model->fastest();
        //总签到榜
        $data[] = $model->leader();
        return response()->json(['status' => 0,'msg' => '活跃榜','data'=>$data]);
    }

    //收藏
    public function fav(Request $request)
    {
        $id = $request->input('id');
        $model = new Mine;
        $count = $model->fav($id,true);
        if($count){
            return response()->json(['status' => 0,'msg' => '已收藏成功']);
        }
        $model->fav($id);
        return response()->json(['status' => 0,'msg' => '收藏成功']);
    }

    //点赞
    public function zan(Request $request)
    {
        $id = $request->input('id');
        $model = new Mine;
        $count = $model->zan($id,true);
        if($count){
            return response()->json(['status' => 0,'msg' => '已点赞成功']);
        }
        $model->zan($id);
        return response()->json(['status' => 0,'msg' => '点赞成功']);
    }

    //下载
    public function download(Request $request)
    {
        $id = $request->input('id');

        //下载记录
        $model = new Mine;
        $count = $model->down($id,true);
        if($count==0){
            $model->down($id);
        }

        $info = Products::findOrFail($id);
        $data = [
            'download' =>$info['download'] + 1
        ];
        $info->update($data);
        $file = public_path() . getImagePath($info['attachment']);   //要下载的路径文件
        $pathInfo = pathinfo($file);
        $filename = time().mt_rand(100,999).'.'.$pathInfo['extension']; //这个只是文件的名字
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment; filename=".($filename));
        readfile($file);
    }
}
