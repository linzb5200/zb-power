<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;

class Integral extends Model
{
    protected $table = 'members_integral';

    protected $fillable = [
        'id','member_id', 'user_score', 'log_no', 'log_name', 'log_ip', 'log_score',  'log_status',
    ];
}
