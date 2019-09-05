<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mine extends Model
{
    use SoftDeletes;
    protected $table = 'members_mine';

    protected $fillable = [
        'id','uid', 'product_id', 'type', 'created_at', 'updated_at',
    ];

    //收藏
    public function fav($id,$check=false,$type = 1){
        $uid = auth('member')->user()->id;
        $map = [
            'uid'=>$uid,
            'product_id'=>$id,
            'type'=>$type,
        ];
        if($check){
            return $this->where($map)->count();
        }
        return $this->create($map);
    }
    //点赞
    public function zan($id,$check=false){
        return $this->fav($id,$check,2);
    }
    //下载
    public function down($id,$check=false){
        return $this->fav($id,$check,3);
    }


}
