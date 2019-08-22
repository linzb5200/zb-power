<?php

namespace App\Http\Controllers\Home;

use App\Models\Member;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    //登录表单
    public function showLoginForm()
    {
        return view('home.passport.login');
    }
    public function showFloatLoginForm()
    {
        return view('home.passport.float_login');
    }

    public function floatLogin(Request $request)
    {
        if($request->method() == 'POST'){

            $this->validateLogin($request);
            $input = $request->all();
            $remember = isset($input['remember']) ? 1 : 0;

            if (!$this->guard()->attempt(['name' => $input['name'], 'password' => $input['password']],$remember)) {
                return response()->json([
                    'status' => 0,
                    'msg' => '用户名或密码错误',
                    'data' => $input,
                ]);
            }else{
                return response()->json([
                    'status' => 1,
                    'msg' => '登录成功',
                    'url' => route('home.member'),
                ]);
            }
        }

    }
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
