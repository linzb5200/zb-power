<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Products\ProductsCate;


class CommonController extends Controller
{
    /**
     * 获取联动分类
     */
    public function linkCate()
    {
        $selected = \Request::input('selected');
        $model = new ProductsCate();
        $links = $model->linkCate($selected);


        $links2 = [
            ['name'=>'北京','value'=>1,'children'=>[
                ['name'=>'北京市1','value'=>12,'children'=>[
                    ['name'=>'朝阳区1','value'=>13,'children'=>[]],
                    ['name'=>'朝阳区2','value'=>14,'children'=>[]],
                ]],
                ['name'=>'天津','value'=>17,'children'=>[]]
            ]],
            ['name'=>'天津','value'=>2,'children'=>[
                ['name'=>'天津市1','value'=>51,'children'=>[]]
            ]]
        ];
        $data = [
            'code'=>0,
            'msg'=>'success',
            'data'=>$links,
        ];
        return response($data);
    }

}
