<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fav extends Model
{
    use SoftDeletes;
    protected $table = 'members_fav';

    protected $fillable = [
        'id','member_id', 'model_type', 'model_id', 'status', 'created_at',
    ];

    //收藏的样式
    public function styles()
    {
        return $this->belongsTo('App\Models\Materials\Style','model_id','id');
    }

    //收藏的模版
    public function tpls()
    {
        return $this->belongsTo('App\Models\Materials\Tpl','model_id','id');
    }

    //收藏的动图
    public function video()
    {
    }

}
