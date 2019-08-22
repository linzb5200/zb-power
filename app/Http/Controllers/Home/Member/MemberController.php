<?php

namespace App\Http\Controllers\Home\Member;

use App\Models\Member;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Members\Drafts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberController extends MemberCenterController
{
    use AuthenticatesUsers;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:member')
            ->except(['index','info','drafts','draftsInfo','draftsDel','permission','message','orders','invitation','feedback','picture','pwd']);
    }

    public function index()
    {
        return view('home.member.index');
    }

    public function info()
    {
        return view('home.member.info');
    }


    public function drafts()
    {
        $map = [
            'ok' => [
                'member_id' => $this->member->id,
            ]
        ];
        $query = Drafts::query();
        $lists = getMap($query,$map)->orderBy('id','desc')->paginate(100);
        $items = $lists->toArray()['data'];

        return view('home.member.drafts',compact('items'));
    }

    public function draftsInfo(Request $request){

        $id = $request->input('id','');

        $ret = Drafts::where('id','=',$id)->get();

        if($ret->isEmpty()){
            return response()->json([
                'status' => 1,
                'msg' => '获取成功',
                'data' => [],
            ]);
        }

        $info = $ret->toArray();
        $info = json_decode(json_encode($info),true);
        if($info){
            return response()->json([
                'status' => 1,
                'msg' => '获取成功',
                'data' => $info[0],
            ]);

        }else{
            return response()->json([
                'status' => 0,
                'msg' => '系统错误',
            ]);
        }
    }
    public function draftsDel(Request $request){

        $id = $request->input('id','');

        $model = Drafts::findOrFail($id);
        return $this->dels($model);
    }

    public function permission()
    {
        return view('home.member.permission');
    }

    public function message()
    {
        return view('home.member.message');
    }

    public function orders()
    {
        return view('home.member.orders');
    }
    public function invitation()
    {
        return view('home.member.invitation');
    }
    public function feedback()
    {
        return view('home.member.feedback');
    }
    public function picture()
    {
        return view('home.member.picture');
    }
    public function log_login()
    {
        return view('home.member.log_login');
    }

}
