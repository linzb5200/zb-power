<?php

namespace App\Http\Controllers\Home\User;

use App\Models\Member;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class UserController extends UserCenterController
{
    use AuthenticatesUsers;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:member')
            ->except(['index','profile','repass','finance','content']);
    }

    public function index(Request $request)
    {
        return view('home.user.index');
    }

    public function profile(Request $request)
    {
        if($request->isMethod('POST')){
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
                return response()->json(['status' => 0,'msg' => '更新成功']);
            }
            return response()->json(['status' => 0,'msg' => '系统错误']);

        }
        return view('home.user.profile');
    }

    public function repass(Request $request)
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
            return response()->json(['status' => 0,'msg' => '更新成功']);
        }
        return response()->json(['status' => 0,'msg' => '系统错误']);
    }

    public function finance()
    {
        return view('home.user.finance');
    }

    public function content()
    {
        return view('home.user.content');
    }


}
