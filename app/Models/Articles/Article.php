<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = ['category_id','title','keywords','description','content','thumb','click'];

    //文章所属分类
    public function category()
    {
        return $this->belongsTo('App\Models\Articles\Cate');
    }

    //与标签多对多关联
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag','article_tag','article_id','tag_id');
    }


}
