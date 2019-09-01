<?php

namespace App\Http\Controllers\Home\User;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;


class UserCenterController extends Controller
{
    use AuthenticatesUsers;
    public $member;
    protected function guard()
    {
        return Auth::guard('member');
    }

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->member = auth('member')->user();
            view()->share('member',$this->member);

            return $next($request);
        });
    }

}
