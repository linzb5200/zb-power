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
        return view('home.user.profile');
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
