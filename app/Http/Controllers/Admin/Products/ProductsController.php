<?php

namespace App\Http\Controllers\Admin\Products;

use App\Models\Style;
use App\Models\Tag;
use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products\Products;
use App\Models\Products\ProductsCate;
use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    protected $rule;
    public function __construct()
    {
        parent::__construct();
        $this->rule = [
            'title'=>'required',
            'keywords' =>'nullable',
            'description' =>'nullable',
            'cate_str' =>'required',
            'points' =>'required',
            'rand_clicks' =>'required',
            'rand_fav' =>'nullable',
            'rand_used' =>'nullable',
            'rand_zan' =>'nullable',
            'rand_download' =>'nullable|numeric',
            'size' =>'nullable|numeric',
            'format' =>'nullable',
            'page' =>'nullable',
            'thumb' =>'nullable|numeric',
            'attachment' =>'nullable',
            'content' =>'required',
            'sort' =>'required',
            'status' =>'nullable',
            'created_at' =>'nullable',
        ];
        $rand = [];
        $rand['rand_clicks'] = mt_rand(900,5000);
        $rand['rand_zan'] = mt_rand(300,700);
        $rand['rand_fav'] =  mt_rand(150,$rand['rand_zan']);
        $rand['rand_used'] = mt_rand(50,$rand['rand_fav']);
        $rand['rand_download'] = mt_rand(200,$rand['rand_clicks']);
        view()->share('rand',$rand);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.product.index');
    }

    public function data(Request $request)
    {

        $map = [
            'no' => [
                'title' => ['like','keyword'],
                'created_at' => ['start_at', 'end_at']
            ],
            'ok' => [
                'status' => 1,
            ]
        ];
        $query = Products::query();
        $res = getMap($query,$map)->orderBy('id')->paginate($request->get('limit',30))->toArray();

        $modelCate = new ProductsCate();
        foreach ($res['data'] as &$item){
            $cate = $modelCate->getInfo($item['cate_id']);
            $item['cate_title'] = $cate['title'];
            $item['thumb'] = getImagePath($item['thumb']);
        }
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
        $tags = Tag::get();
        $colors = Color::get();
        $styles = Style::get();

        $last = DB::table('products') ->orderBy('id', 'desc') ->first();
        $start = date('Y-m-d 00:00:00',strtotime($last->created_at));
        $end = date('Y-m-d 23:59:59',strtotime($last->created_at));

        $count = DB::table('products')->whereBetween('created_at',[strtotime($start),strtotime($end)])->count();

        $created_at = date('Y-m-d H:i:s');
        if($count>6){
            $d = date('Y-m-d',strtotime(" $start +1 day"))." ".date('H').":".date('i').":".date('s');
            $created_at = date('Y-m-d H:i:s', $d);
        }



        return view('admin.products.product.create',compact(['cate_list','tags','colors','styles','created_at']));
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

        $cate_str = $request['cate_str'];
        $arr = explode('/',$cate_str);
        $data['cate_id'] = $arr[count($arr)-1];

        $product = Products::create($data);

        $tags = $request['tags'];
        if ($product && !empty($tags) ){
            $product->tags()->sync(explode(',',$tags));
        }
        $colors = $request['color'];
        if ($product && !empty($colors) ){
            $product->colors()->sync($colors);
        }
        $styles = $request['style'];
        if ($product && !empty($styles) ){
            $product->styles()->sync($styles);
        }
        return redirect(route('admin.products'))->with(['status'=>'添加完成']);

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
        $model = new ProductsCate();
        $cates = $model->getList();
        $cate_list = getTree($cates);
        $data = Products::findOrFail($id);

        $tags = Tag::get();
        foreach ($tags as $tag){
            $tag->selected = $data->tags->contains($tag) ? 'selected' : '';
        }

        $colors = Color::get();
        foreach ($colors as $color){
            $color->checked = $data->colors->contains($color) ? 'checked' : '';
        }

        $styles = Style::get();
        foreach ($styles as $style){
            $style->checked = $data->styles->contains($style) ? 'checked' : '';
        }
        $created_at = date('Y-m-d H:i:s');

        // 图集处理
        $images = explode(',', $data->attachment);
        return view('admin.products.product.edit',compact(['cate_list','data','images','tags','colors','styles','created_at']));
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

        $product = Products::findOrFail($id);

        $thumb = $product['thumb'];
        $attachment = $product['attachment'];
        $old_img = findContentImg($product['content']);

        $cate_str = $request['cate_str'];
        $arr = explode('/',$cate_str);
        $data['cate_id'] = $arr[count($arr)-1];

        if ($product->update($data)){

            $tags = $request['tags'];
            if($tags){
                $product->tags()->sync(explode(',',$tags));
            }
            $colors = $request['color'];
            if ($product && !empty($colors) ){
                $product->colors()->sync($colors);
            }
            $styles = $request['style'];
            if ($product && !empty($styles) ){
                $product->styles()->sync($styles);
            }

            //删除旧的缩略图
            if($data['thumb'] != $thumb) {
                deleteFile(getImagePath($thumb));
            }

            //删除旧的附件
            $new = explode(',',$data['attachment']);
            $old = explode(',',$attachment);
            $dels = $old ? diff_out($old,$new) : [];
            if($dels){
                foreach ($dels as $del) deleteFile(getImagePath($del));
            }
            //删除内容旧的图片
            $new_img = findContentImg($data['content']);
            $dels_img = $old_img ? diff_out($old_img,$new_img) : [];
            if($dels_img){
                foreach ($dels_img as $del_img) deleteFile($del_img);
            }


            return redirect(route('admin.products'))->with(['status'=>'更新成功']);
        }
        return redirect(route('admin.products'))->withErrors(['status'=>'系统错误']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        foreach (Products::whereIn('id',$ids)->get() as $model){
            $data = $model->toArray();

            //删除旧的缩略图
            if($data['thumb']) {
                deleteFile(getImagePath($data['thumb']));
            }

            //删除旧的附件
            if($data['attachment']) {
                $attachments = explode(',',$data['attachment']);
                foreach ($attachments as $del) deleteFile(getImagePath($del));
            }
            //删除内容旧的图片
            delContentPic($data['content']);


            $this->dels($model);
        }
        return response()->json(['code'=>0,'msg'=>'删除成功']);
    }

    /**
     * 处理联动分类
     */
    public function linkCate()
    {

        $model = new ProductsCate();
        $linkCates = $model->linkCate();
        dd($linkCates);

    }
}
