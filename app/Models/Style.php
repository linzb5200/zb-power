<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Style extends Model
{
    protected $table = 'styles';
    protected $fillable = ['name','sort'];

    //与产品多对多关联
    public function products()
    {
        return $this->belongsToMany('App\Models\Products\Products','products_style','style_id','product_id');
    }

}
