<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;

class Drafts extends Model
{
    protected $table = 'members_drafts';

    protected $fillable = [
        'member_id','content', 'log_ip', 'status', 'created_at', 'updated_at',
    ];
}
