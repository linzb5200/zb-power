<?php

namespace App\Models\Members;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Levels extends Model
{
    protected $table = 'members_level';

    use SoftDeletes;

    /**
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name','description', 'sort', 'status','num_store_pic','num_upload_pic','num_fav_style','num_fav_tpl','num_fav_color','num_fav_video','num_fav_gif','num_save_art','num_save_style','num_save_tpl','num_save_sign','num_craw_art','num_art_turn_pic','num_bind_wx_public',
    ];
}
