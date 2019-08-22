<?php

namespace App\Http\Controllers\Home\Member;

use App\Models\Member;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;


class MemberCenterController extends Controller
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

            $site = [
                'curl' => Request::getRequestUri()
            ];
            view()->share('site',$site);

            return $next($request);
        });
    }

}
