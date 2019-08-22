<?php

namespace App\Http\Controllers\Admin;

use App\Models\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('admin.system.index');
    }

    public function data(Request $request)
    {

        $map = [
            'ok' => [
                'status' => 1,
            ]
        ];
        $query = System::query();
        $res = getMap($query,$map)->orderBy('id')->paginate($request->get('limit',30))->toArray();

        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res['total'],
            'data'  => $res['data']
        ];
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.system.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'key'  => 'required|string',
            'value' => 'required|string',
            'type' => 'required',
            'remark' => 'required',
            'sort'  => 'required|numeric',
        ]);
        if (System::create($request->all())){
            Cache::forget('settings');
            return redirect(route('admin.system'))->with(['status'=>'添加完成']);
        }
        return redirect(route('admin.system'))->with(['status'=>'系统错误']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = System::findOrFail($id);
        return view('admin.system.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'key'  => 'required|string',
            'value' => 'required|string',
            'type' => 'required',
            'remark' => 'required',
            'sort'  => 'required|numeric',
        ]);
        $system = System::findOrFail($id);
        if ($system->update($request->all())){
            Cache::forget('settings');
            return redirect(route('admin.system'))->with(['status'=>'更新成功']);
        }
        return redirect(route('admin.system'))->withErrors(['status'=>'系统错误']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        if (System::destroy($ids)){
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
        return response()->json(['code'=>1,'msg'=>'删除失败']);
    }
}
