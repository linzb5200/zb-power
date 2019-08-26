<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Trades extends Model
{
    protected $table = 'trades';
    protected $fillable = ['id','name','sort'];

    //与产品多对多关联
    public function products()
    {
        return $this->belongsToMany('App\Models\Products\Products','products_trade','trade_id','product_id');
    }

}
