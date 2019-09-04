<?php

namespace App\Http\Controllers\Home\User;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class MineController extends UserCenterController
{
    use AuthenticatesUsers;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:member')->except(['fav','down','art','add']);
    }

    //我的收藏
    public function fav()
    {
        return view('home.user.mine.fav');
    }

    //我的收藏
    public function down()
    {
        return view('home.user.mine.down');
    }

    //我的上传
    public function art()
    {
        return view('home.user.mine.art');
    }

    //上传作品
    public function add()
    {
        return view('home.user.mine.add');
    }


}
