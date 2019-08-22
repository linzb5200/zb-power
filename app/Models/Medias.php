<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/10 0010
 * Time: 22:48
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Medias extends Model
{
    use SoftDeletes;
    protected $table = 'medias';
    /**
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from','member_id','type','path', 'name','title','md5','size','mime_type','origin_name','disk','remark','sort','status'
    ];

    // 获取图片路径
    public function getPathById($id)
    {
        if (!$id) return '';
        $info = $this->where('id','=', $id)->first();

        if (!$info) return [];
        $info = json_decode(json_encode($info),true);

        return $info['path'];

    }
    // 删除媒体图片
    public function del($key)
    {
        if(is_array($key)){
            foreach ($key as $v) $this->del($v);
        }


        if(is_numeric($key)){
            return DB::table('medias')->where('id','=', $key)->delete();
        }else{
            return DB::table('medias')->where('path','=', $key)->delete();
        }
    }

}