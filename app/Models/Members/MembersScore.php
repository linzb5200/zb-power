<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;

class MembersScore extends Model
{
    protected $table = 'members_score';

    protected $fillable = [
        'id','uid', 'type', 'way', 'used','score','change', 'keep','ip','status', 'created_at', 'updated_at',
    ];

    //签到情况
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
        $now->days = 0;
        $now->keep = 0;
        $now->change = 5;
        if($yesterday){
            $kp = $yesterday->keep+1;
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
            $now->keep = $kp;
            $now->days = $yesterday->keep;
        }

        if($today){
            $now->days = $today->keep;
        }

        return ['today'=>$today,'now'=>$now];
    }

    //最新签到
    public function newest(){
        $map = [
            's.type'=>1,
            's.way'=>1,
            's.status'=>1,
        ];
        return $this->from("{$this->table} as s")
            ->leftJoin('members as u', 's.uid', '=', 'u.id')
            ->leftJoin('medias as m', 'u.avatar', '=', 'm.id')
            ->select('s.*', 'u.name','u.avatar','m.path')
            ->where($map)
            ->orderBy('s.created_at', 'desc')
            ->take(20)->get()->toArray();
    }

    //今日最快
    public function fastest(){
        $map = [
            's.type'=>1,
            's.way'=>1,
            's.status'=>1,
        ];
        $start = date('Y-m-d 00:00:00');
        $end = date('Y-m-d 23:59:59');
        return $this->from("{$this->table} as s")
            ->leftJoin('members as u', 's.uid', '=', 'u.id')
            ->leftJoin('medias as m', 'u.avatar', '=', 'm.id')
            ->select('s.*', 'u.name','u.avatar','m.path')
            ->where($map)
            ->whereBetween('s.created_at',[$start,$end])
            ->orderBy('s.created_at', 'asc')
            ->take(20)->get()->toArray();
    }

    //总签到榜
    public function leader(){
        $map = [
            's.type'=>1,
            's.way'=>1,
            's.status'=>1,
        ];
        return $this->from("{$this->table} as s")
            ->leftJoin('members as u', 's.uid', '=', 'u.id')
            ->leftJoin('medias as m', 'u.avatar', '=', 'm.id')
            ->select('s.*', 'u.name','u.avatar','m.path')
            ->where($map)
            ->orderBy('s.keep', 'desc')
            ->take(20)->get()->toArray();
    }


}
