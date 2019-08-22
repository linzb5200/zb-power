<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class saveTpl extends Model
{
    use SoftDeletes;
    protected $table = 'members_save_tpl';

    protected $fillable = [
        'id','member_id', 'title', 'thumb', 'is_thumb', 'content', 'status', 'created_at', 'updated_at',
    ];
}
