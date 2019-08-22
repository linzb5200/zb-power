<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;

class RechargeLog extends Model
{
    protected $table = 'members_recharge';

    protected $fillable = [
        'id','member_id','user_money','log_money','log_type', 'log_no', 'log_name',   'log_ip','log_remark', 'log_status', 'created_at',
    ];
}
