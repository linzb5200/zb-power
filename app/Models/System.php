<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class System extends Model
{
    use SoftDeletes;
    protected $table = 'system';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'key','value', 'type','remark','status','sort'
    ];

    public function conf()
    {
        return $this->all(['key', 'value'])->pluck('value', 'key')->toArray();
    }
}
