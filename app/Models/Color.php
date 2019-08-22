<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Color extends Model
{
    protected $table = 'colors';
    protected $fillable = ['name','sort'];

    //与产品多对多关联
    public function products()
    {
        return $this->belongsToMany('App\Models\Products\Products','products_color','color_id','product_id');
    }

}
