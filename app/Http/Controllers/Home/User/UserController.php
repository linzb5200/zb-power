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
            ->except(['index','profile','repass','orders','blog']);
    }

    public function index(Request $request)
    {
        return view('home.user.index');
    }

    public function profile(Request $request)
    {
        return view('home.user.profile');
    }

    public function orders()
    {
        return view('home.user.orders');
    }

    public function blog()
    {
        return view('home.user.blog');
    }


}
