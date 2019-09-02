<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $settings;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->settings = settings();
            view()->share('settings',$this->settings);
            return $next($request);
        });
    }
    /**
     * 处理权限分类
     */
    public function tree($list=[], $pk='id', $pid = 'parent_id', $child = '_child', $root = 0)
    {
        if (empty($list)){
            $list = Permission::get()->toArray();
        }
        // 创建Tree
        $tree = array();
        if(is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId =  $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                }else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }

    /**
     * 处理删除
     */
    public function dels($model,$deleted_at=false)
    {
        if($deleted_at){
            $model->delete();
            if ($model->trashed()) {
                return response()->json([
                    'status' => 1,
                    'msg' => '软删除成功',
                    'url' => 1,
                ]);
            }
        }else{
            if($model->forceDelete()){
                return response()->json([
                    'status' => 1,
                    'msg' => '删除成功',
                    'url' => 1,
                ]);
            }
        }

        return response()->json([
            'status' => 0,
            'msg' => '删除失败',
        ]);
    }


    /**
     * 函数说明
     *
     * @param int $code
     * @param $data
     * @param string $msg
     * @return void
     */
    protected function response($status = 1000, $data = null, $msg = '')
    {
        $response = response()->json([
            'status' => $status,
            'msg'  => $msg,
            'data' => $data,
        ]);
        header('Content-Type:application/json;charset=utf-8');
        // 跨域
        if (request()->input('jsonp')) {
            $response = request()->input('callback') . '(' . $response . ')';
        }

        exit($response);
    }
}
