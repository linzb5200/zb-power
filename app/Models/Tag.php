<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['name','sort'];

    //与文章多对多关联
    public function articles()
    {
        return $this->belongsToMany('App\Models\Articles\Article','article_tag','tag_id','article_id');
    }
    //与产品多对多关联
    public function products()
    {
        return $this->belongsToMany('App\Models\Products\Products','products_tag','tag_id','product_id');
    }

}
