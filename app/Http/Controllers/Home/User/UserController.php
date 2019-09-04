<?php

namespace App\Http\Controllers\Home\User;

use App\Models\Member;
use App\Models\Members\MembersScore;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class UserController extends UserCenterController
{
    use AuthenticatesUsers;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:member')->except(['index','profile']);
    }

    public function index(Request $request)
    {

        $dash = [];
        $dash['sign'] = (new MembersScore)->latest($this->member->id);


        return view('home.user.index',compact(['dash']));
    }

    public function profile(Request $request)
    {
        return view('home.user.profile');
    }


}
