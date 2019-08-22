<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'members_feedback';

    protected $fillable = [
        'id','member_id', 'type', 'content', 'status', 'created_at',
    ];
}
