<?php

namespace App\Http\Controllers\Admin\Products;

use App\Models\Products\ProductsCate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Overtrue\Pinyin\Pinyin;

class ProductsCateController extends Controller
{
    protected $rule;
    public function __construct()
    {
        parent::__construct();
        $this->rule = [
            'parent_id' => 'required',
            'title' => 'required|min:2',
            'clicks' => 'required',
            'recommend' => 'nullable',
            'sort' => 'required',
            'pinyin'=>'nullable',
        ];

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.products.product_cate.index');
    }

    public function data(Request $request)
    {

        $map = [
            'no' => [
                'name' => ['like','keyword'],
                'created_at' => ['start_at', 'end_at']
            ],
            'ok' => [
                'status' => 1,
                'parent_id' => $request->get('parent_id',0),
            ]
        ];
        $query = ProductsCate::query();
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
        $model = new ProductsCate();
        $cates = $model->getList();
        $cate_list = getTree($cates);
        return view('admin.products.product_cate.create',compact('cate_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $this->validate($request,$this->rule);
        if($data['title'] && empty($data['pinyin'])){
            $pinyin = new Pinyin();
            $data['pinyin'] = $pinyin->abbr($data['title']);
        }

        if (ProductsCate::create($data)){
            $model = new ProductsCate;
            $model->zm($data['parent_id']);
            return redirect(route('admin.products_cate',['parent_id'=>$data['parent_id']]))->with(['status'=>'添加完成']);
        }
        return redirect(route('admin.products_cate'))->with(['status'=>'系统错误']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = new ProductsCate();
        $cates = $model->getList();
        $cate_list = getTree($cates);
        $data = ProductsCate::findOrFail($id);
        return view('admin.products.product_cate.edit',compact(['data','cate_list']));
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

        $data = $this->validate($request,$this->rule);

        if($data['title'] && empty($data['pinyin'])){
            $pinyin = new Pinyin();
            $data['pinyin'] = $pinyin->permalink($data['title'],'');
        }

        if($data['parent_id'] == 0){
            $data['zm'] = $data['pinyin'];
        }

        $model = ProductsCate::findOrFail($id);
        if ($model->update($data)){
            $model->zm($data['parent_id']);
            return redirect(route('admin.products_cate',['parent_id'=>$data['parent_id']]))->with(['status'=>'更新成功']);
        }
        return redirect(route('admin.products_cate'))->withErrors(['status'=>'系统错误']);
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
        $category = ProductsCate::with(['childs','styles'])->find($ids);
        if (!$category){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        if (!$category->childs->isEmpty() ){
            return response()->json(['code'=>1,'msg'=>'该分类下有子分类，不能删除']);
        }
        if (!$category->styles->isEmpty()){
            return response()->json(['code'=>1,'msg'=>'该分类下有样式文章，不能删除']);
        }

        if ($category->delete()){
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
        return response()->json(['code'=>1,'msg'=>'删除失败']);
    }
}
