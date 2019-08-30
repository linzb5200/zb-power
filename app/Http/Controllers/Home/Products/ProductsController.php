<?php

namespace App\Http\Controllers\Home\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\Controller;
use App\Models\Products\Products;
use App\Models\Products\ProductsCate;

class ProductsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(Request $request)
    {

        $arg = $this->myArg();


        $modelCate = new ProductsCate();

        $fid = $arg['cate']['id'];

        $zm = $arg['zm'];
        if(!empty($zm)){
            $fid = $zm['id'];
        }

        $childIds = $modelCate->getChilds($fid); //获取当前分类下所有子分类ids

        $map = [
            'ok' => [
                'closed' => 0,
                'cate_id' => ['in',explode(',',$childIds)]
            ]
        ];
        //获取产品
        $model = new Products();
        $query = $model::query();
        $ret = getMap($query,$map)->orderBy('id')->paginate(20);

        $items = $ret->toArray()['data'];

        $cate = $arg['cate'];
        $categorys = $arg['cate']['children'];//获取父类下所有子类
        $arg = getArg(['cate','zm','color','style','trade','soft','type','scale','sort','page','clear']);
        return view('home.products.index',compact(['categorys','cate','items','ret','arg']));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword','');
        $cate_id = $request->input('id','');

        $model = new Products();
        $modelCate = new ProductsCate();

        if($cate_id){
            $childIds = $modelCate->getChilds($cate_id);
            $items = $model->getByCateIds($childIds);
        }else{
            $items = $model->getByKeyword($keyword);
        }

        return view('home.products.index',compact(['items']));
    }

    public function show(Request $request,$cate='',$py='',$id)
    {
        $model = new Products();
        $info = $model->getInfo($id);
        $channel = $this->getChannel($info['cate_str']);

        return view('home.products.show',compact(['info','channel']));
    }

    public function download(Request $request)
    {
        $id = $request->input('id');
        $info = Products::findOrFail($id);
        $data = [
            'download' =>$info['download'] + 1
        ];
        $info->update($data);

        $file = public_path() . getImagePath($info['attachment']);   //要下载的路径文件

        $pathInfo = pathinfo($file);
        $filename = time().mt_rand(100,999).'.'.$pathInfo['extension']; //这个只是文件的名字
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment; filename=".($filename));
        readfile($file);
    }

    //获取详情页导航
    public function getChannel($str)
    {
        if(empty($str)) return '';
        $model = new ProductsCate();
        $cats = $model->getCacheList();
        $ids = explode('/',$str);

        $temp = [];
        $url = '/';
        foreach ($ids as $k => $id){
            $url .= $cats[$id]['pinyin'].'/';
            $temp[$k] = [
                'url'=> $url,
                'title'=> $cats[$id]['title'],
                'arrow'=> "<span lay-separator=''>></span>",
            ];
        }

        return $temp;
    }


    //伪静态转真实数据
    public function myArg()
    {
        $arg = getArg(['cate','zm','color','style','trade','soft','type','scale','sort','page']);
        $this->nav;
        $this->costColors;
        $this->costStyles;
        $this->costTrades;

        foreach ($this->nav as $cate){
            if($cate['zm'] == $arg['cate']) {
                $arg['cate'] = $cate;

                foreach ($cate['children'] as $child){
                    if($child['zm'] == $arg['zm']) {
                        $arg['zm'] = $child;
                        continue;
                    }
                }

                continue;
            }
        }

        foreach ($this->costColors as $color){
            if($color['zm'] == $arg['color']) {
                $arg['color'] = $color['id'];
                continue;
            }
        }

        foreach ($this->costStyles as $style){
            if($style['zm'] == $arg['style']) {
                $arg['style'] = $style['id'];
                continue;
            }
        }

        foreach ($this->costTrades as $trade){
            if($trade['zm'] == $arg['trade']) {
                $arg['trade'] = $trade['id'];
                continue;
            }
        }
        return $arg;
    }


}
