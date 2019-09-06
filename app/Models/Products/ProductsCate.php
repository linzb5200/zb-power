<?php

namespace App\Models\Products;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class ProductsCate extends Model
{
    use SoftDeletes;
    protected $table = 'products_cate';
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id','title', 'route','zm','pinyin','clicks','recommend', 'sort','status','tag'
    ];

    /*
    * 通过父类ID获取全部子类
    */
    public function getInfo($id = 0){

        if(is_numeric($id)) {
            return $this->where('id', $id)->first()->toArray();
        }
        $info = $this->where('zm', $id)->first()->toArray();
        return $info;
    }

    /*
    * 获取子分类
    */
    public function getChilds($fid = 0,$ids = ''){
        $data = $this->where('parent_id', $fid)->get()->toArray();

        if($data){

            if($ids == '' )$ids = $fid;
            foreach ($data as $item){
                $ids .= ','.$item['id'].$this->getChilds($item['id'],$ids);
            }
            return $ids;
        }else{
            if($ids == '')return $fid;
            return '';
        }

    }

    /*
    * 获取所有分类
    */
    public function getCacheList($tree='')
    {
        $items = Cache::get($this->table.$tree);
        if(empty($items)){
            $items = $this->orderBy('sort', 'ASC')->get()->toArray();

            $temp = [];
            foreach ($items as $item){

                if($tree == 1){
                    if($item['parent_id']==0){
                        $item['children']= [];
                        $temp[$item['id']] = $item;
                    }else{
                        $temp[$item['parent_id']]['children'][$item['id']] = $item;
                    }
                }else{

                    $temp[$item['id']] = $item;

                }
            }
            $items = $temp;

            Cache::put($this->table.$tree, $items, 2);
            return $items;
        }

        return $items;
    }


    /*
    * 获取分类数据
    */
    public function getList($fid = 0){
        if($fid) $this->where('parent_id',$fid);
        return $this->orderBy('sort','asc')->get()->toArray();
    }
    //子分类
    public function childs()
    {
        return $this->hasMany('App\Models\Products\ProductsCate','parent_id','id');
    }

    //所有子类
    public function allChilds()
    {
        return $this->childs()->with('allChilds');
    }

    /*
    * 获取联动分类
    */
    public function linkCate($selected)
    {
        $temps = $this->getCacheList();

        $items = $this->callChildren($temps,0,$selected);

        return $items;
    }
    public function callChildren($arr,$pid=0,$selected='')
    {
        $checked = explode('/',$selected);

        $data = [];
        if($arr){
            foreach ($arr as $key => $val) {
                if ($val['parent_id'] == $pid) {

                    $is = $checked ? in_array($val['id'],$checked) : false;

                    $tmp = [
                        'name'=>$val['title'],
                        'value'=>"{$val['id']}",
                        "selected"=>$is ? "selected" : "",
                        'children'=>$this->callChildren($arr,$val['id'],$selected),
                    ];
                    $data[] = $tmp;
                }
            }
        }
        return $data;
    }


    /*
    * 更新字母标记
    */
    public function zm($fid =0)
    {
        if(empty($fid)) return false;
        $child = $this->where('parent_id',$fid)->select('id', 'zm')->orderBy('sort','asc')->get()->toArray();
        $child = getZm($child);
        updateBatch($this->table,$child);
        return true;
    }
}
