<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetPasswordNotification;

class Member extends Authenticatable
{
    protected $table = 'members';
    protected $fillable = ['id','uuid','name','nickname','password','from','province_id','city_id','area_id','mobile','realname','avatar','score','money','frozen_money','wx_openid','qq_openid','is_vip','is_lock','actived','status','remember_token'];
    protected $hidden = ['password','remember_token'];


}
