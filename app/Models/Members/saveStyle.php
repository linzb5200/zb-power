<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class saveStyle extends Model
{
    use SoftDeletes;
    protected $table = 'members_save_style';

    protected $fillable = [
        'id','member_id', 'content', 'status', 'created_at', 'updated_at',
    ];
}
