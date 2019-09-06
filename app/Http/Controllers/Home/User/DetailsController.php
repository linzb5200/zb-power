<?php

namespace App\Http\Controllers\Home\User;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class DetailsController extends UserCenterController
{
    use AuthenticatesUsers;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:member')->except(['recharge','score']);
    }

    //积分明细
    public function score()
    {
        return view('home.user.details.score');
    }

    //充值明细
    public function recharge()
    {
        return view('home.user.details.recharge');
    }


}
