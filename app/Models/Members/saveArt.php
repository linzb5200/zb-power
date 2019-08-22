<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class saveArt extends Model
{
    use SoftDeletes;
    protected $table = 'members_save_art';

    protected $fillable = [
        'id','member_id', 'title', 'thumb', 'is_thumb', 'content', 'author', 'original_link', 'excerpt',  'audit', 'status', 'created_at', 'updated_at',
    ];
}
