<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trades;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.trades.index');
    }

    public function data(Request $request)
    {
        $res = Trades::orderBy('id','desc')->orderBy('sort','desc')->paginate($request->get('limit',30))->toArray();
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
        return view('admin.trades.create');
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
            'name'  => 'required|string',
            'sort'  => 'required|numeric'
        ]);
        if (Trades::create($request->all())){
            $model = new Trades;
            $model->zm();
            return redirect(route('admin.trades'))->with(['status'=>'添加完成']);
        }
        return redirect(route('admin.trades'))->with(['status'=>'系统错误']);
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
        $trades = Trades::findOrFail($id);
        return view('admin.trades.edit',compact('trades'));
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
            'name'  => 'required|string',
            'sort'  => 'required|numeric'
        ]);
        $style = Trades::findOrFail($id);
        if ($style->update($request->only(['name','sort']))){
            $style->zm();
            return redirect(route('admin.trades'))->with(['status'=>'更新成功']);
        }
        return redirect(route('admin.trades'))->withErrors(['status'=>'系统错误']);
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
        if (Trades::destroy($ids)){
            $model = new Trades;
            $model->zm();
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
        return response()->json(['code'=>1,'msg'=>'删除失败']);
    }
}
