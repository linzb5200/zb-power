<?php

namespace App\Http\Controllers\Home\User;

use App\Models\Members\Mine;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MineController extends UserCenterController
{
    use AuthenticatesUsers;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:member')->except(['mine','fav','down','zan','release']);
    }
    //我的作品
    public function mine()
    {
        $uid = auth('member')->user()->id;
        $map = [
            'a.uid'=>$uid,
        ];
        $ret = DB::table('products')->from("products as a")
            ->leftJoin('products_cate as c', 'a.cate_id', '=', 'c.id')
            ->select('a.cate_id','c.parent_id', 'c.zm','a.id', 'a.title','a.created_at')
            ->where($map)
            ->orderBy('a.created_at', 'desc')
            ->paginate(10);
        $items = $ret->toArray()['data'];

        $counts = (new Mine)->tj();

        return view('home.user.mine.art',compact(['ret','items','counts']));
    }

    //我的收藏
    public function fav()
    {
        $uid = auth('member')->user()->id;
        $map = [
            'a.uid'=>$uid,
            'a.type'=>1,
        ];
        $ret = DB::table('members_mine')->from("members_mine as a")
            ->leftJoin('products as p', 'a.product_id', '=', 'p.id')
            ->leftJoin('products_cate as c', 'p.cate_id', '=', 'c.id')
            ->select('p.cate_id','c.parent_id', 'c.zm','a.product_id', 'p.title','a.created_at')
            ->where($map)
            ->orderBy('a.created_at', 'desc')
            ->paginate(10);
        $items = $ret->toArray()['data'];

        $counts = (new Mine)->tj();
        return view('home.user.mine.fav',compact(['ret','items','counts']));
    }
    //我的点赞
    public function zan()
    {
        $uid = auth('member')->user()->id;
        $map = [
            'a.uid'=>$uid,
            'a.type'=>2,
        ];
        $ret = DB::table('members_mine')->from("members_mine as a")
            ->leftJoin('products as p', 'a.product_id', '=', 'p.id')
            ->leftJoin('products_cate as c', 'p.cate_id', '=', 'c.id')
            ->select('p.cate_id','c.parent_id', 'c.zm','a.product_id', 'p.title','a.created_at')
            ->where($map)
            ->orderBy('a.created_at', 'desc')
            ->paginate(10);
        $items = $ret->toArray()['data'];

        $counts = (new Mine)->tj();
        return view('home.user.mine.zan',compact(['ret','items','counts']));
    }
    //我的下载
    public function down()
    {
        $uid = auth('member')->user()->id;
        $map = [
            'a.uid'=>$uid,
            'a.type'=>3,
        ];
        $ret = DB::table('members_mine')->from("members_mine as a")
            ->leftJoin('products as p', 'a.product_id', '=', 'p.id')
            ->leftJoin('products_cate as c', 'p.cate_id', '=', 'c.id')
            ->select('p.cate_id','c.parent_id', 'c.zm','a.product_id', 'p.title','a.created_at')
            ->where($map)
            ->orderBy('a.created_at', 'desc')
            ->paginate(10);
        $items = $ret->toArray()['data'];

        $counts = (new Mine)->tj();
        return view('home.user.mine.down',compact(['ret','items','counts']));
    }

    //发布作品
    public function release()
    {
        return view('home.user.mine.release');
    }


}
