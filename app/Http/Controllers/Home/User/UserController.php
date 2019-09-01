<?php

namespace App\Http\Controllers\Home\User;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class UserController extends UserCenterController
{
    use AuthenticatesUsers;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:member')
            ->except(['index']);
    }

    public function index()
    {
        return view('home.user.index');
    }


}
