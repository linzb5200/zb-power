<?php

namespace App\Http\Controllers\Home\User;

use App\Models\Members\Score;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class OrdersController extends UserCenterController
{
    use AuthenticatesUsers;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:member')->except(['score','bill','exchange','pay']);
    }

    //积分明细
    public function score()
    {
        $mode = new Score;
        $uid = auth('member')->user()->id;
        $map = [
            'uid'=>$uid,
            'type'=>1,
            'way'=>1,
            'status'=>1,
        ];
        $items= $mode->where($map)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('home.user.orders.score',compact(['items']));
    }

    //我的VIP
    public function bill()
    {
        return view('home.user.orders.bill');
    }

    //积分兑换VIP
    public function exchange()
    {
        return view('home.user.orders.exchange');
    }

    //充值(积分、VIP)
    public function pay()
    {

        return view('home.user.orders.pay');
    }



}
