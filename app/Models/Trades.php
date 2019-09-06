<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Trades extends Model
{
    protected $table = 'trades';
    protected $fillable = ['id','name','zm','sort'];

    //与产品多对多关联
    public function products()
    {
        return $this->belongsToMany('App\Models\Products\Products','products_trade','trade_id','product_id');
    }


    /*
    * 缓存数据
    */
    public function getCacheList()
    {
        $items = Cache::get($this->table);
        if(empty($items)){
            $items = $this->orderBy('sort', 'ASC')->get()->toArray();
            Cache::put($this->table, $items, 2);
            return $items;
        }

        return $items;
    }
    /*
    * 更新字母标记
    */
    public function zm()
    {
        $child = $this->select('id', 'zm', 'sort')->orderBy('sort','asc')->get()->toArray();
        $child = getZm($child);

//        foreach ($child as $k => &$item){
//            $item['sort'] = ($k+1) * 5;
//        }
        updateBatch($this->table,$child);
        return true;
    }

}
