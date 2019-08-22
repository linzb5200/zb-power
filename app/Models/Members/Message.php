<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'members_message';

    protected $fillable = [
        'id','member_id_from', 'member_id_to', 'type', 'content', 'status', 'created_at'
    ];
}
