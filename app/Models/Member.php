<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetPasswordNotification;

class Member extends Authenticatable
{
    protected $table = 'members';
    protected $fillable = ['id','name','nickname','password','from','province_id','city_id','area_id','mobile','qq','email','realname','birthday','avatar','sex','description','recommend_uid','score','money','frozen_money','register_ip','login_num','last_time','last_ip','is_vip','is_lock','actived','status','remember_token'];
    protected $hidden = ['password','remember_token'];


}
