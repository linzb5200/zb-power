<?php

namespace App\Http\Controllers\Home;

use App\Models\Member;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PassportController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:member')->except(['logout']);
    }

    //注册表单register.blade
    public function showRegisterForm()
    {
        return view('home.passport.register');
    }
    //注册
    public function register(Request $request)
    {
        $this->validate($request,[
            'captcha' => 'required|captcha',
            'name' => 'required',
            'phone' => 'required|numeric|regex:/^1[3456789][0-9]{9}$/|unique:members',
            'password'  => 'required|confirmed|min:6|max:14'
        ],[
            'captcha.captcha' => '验证码错误'
        ]);
        $data = array_merge($request->all(),['uuid'=>\Faker\Provider\Uuid::uuid()]);
        if ($member = Member::create($data)){
            $this->guard()->login($member);
        }
        return back()->with(['status'=>'系统错误']);
    }
    //手机注册
    public function reg(Request $request)
    {
        $input = $this->validate($request,[
            'captcha' => 'required',
            'mobile' => 'required|numeric|regex:/^1[3456789][0-9]{9}$/',
        ],[
            'captcha.required' => '请输入手机验证码',
            'mobile.required' => '请输入手机号码',
            'mobile.numeric' => '请输入正确的手机号',
            'mobile.regex' => '请输入正确的手机号',
        ]);

        $info = DB::table('members')->where('mobile','=',$input['mobile'])->first();
        if($info){
            $this->guard()->loginUsingId($info->id,true);
            $this->response(1000,[],'登录成功');
        }
        $input['password'] = bcrypt('123456');
        $input['uuid'] = \Faker\Provider\Uuid::uuid();
        unset($input['captcha']);

        if ($member = Member::create($input)){
            $this->guard()->login($member,true);
            $this->response(1000,[],'登录成功');
        }
        $this->response(1099,[],'登录失败');
    }

    //登录表单
//    public function showLoginForm()
//    {
//        return view('home.passport.login');
//    }

    public function redirectTo()
    {
        return route('home.member');
    }

    /**
     * @param Request $request
     * 登录验证
     */
    public function validateLogin(Request $request)
    {
        $this->validate($request, [
            'captcha' => 'required|captcha',
            $this->username() => 'required',
            'password' => 'required|string',
        ],[
            'captcha.captcha'=>'图形验证码错误',
        ]);
    }

    /**
     * @return string
     * 登录验证的字段
     */
    public function username()
    {
        return 'name';
    }

    //注销、退出
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    protected function guard()
    {
        return Auth::guard('member');
    }

}
