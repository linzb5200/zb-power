<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;

class MembersScore extends Model
{
    protected $table = 'members_score';

    protected $fillable = [
        'id','uid', 'type', 'way', 'used','score','change', 'keep','ip','status', 'created_at', 'updated_at',
    ];

    public function latest($id){

        $start = date('Y-m-d 00:00:00');
        $end = date('Y-m-d 23:59:59');
        $map = [
            'uid'=>$id,
            'type'=>1,
            'way'=>1,
            'status'=>1,
        ];
        $today = $this->where($map)
            ->whereBetween('created_at',[$start,$end])
            ->first();

        $start = date('Y-m-d 00:00:00',strtotime("-1 day"));
        $end = date('Y-m-d 23:59:59',strtotime("-1 day"));
        $yesterday = $this->where($map)
            ->whereBetween('created_at',[$start,$end])
            ->first();

        $now = (object)array();
        $now->keep = 1;
        $now->change = 5;
        if($yesterday){
            $kp = $yesterday->keep +1;
            if($kp < 5){
                $now->change = 5;
            }elseif ($kp>=5 && $kp<15){
                $now->change = 10;
            }elseif ($kp>=15 && $kp<30){
                $now->change = 15;
            }elseif ($kp>=30 && $kp<100){
                $now->change = 20;
            }elseif ($kp>=100 && $kp<365){
                $now->change = 30;
            }elseif ($kp>=365){
                $now->change = 50;
            }
            $now->keep +=1;
        }

        return ['today'=>$today,'now'=>$now];
    }


}
