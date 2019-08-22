<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;
use Zhuzhichao\IpLocationZh\Ip;

class Login extends Model
{
    protected $table = 'members_login';

    protected $fillable = [
        'user_id','log_type', 'log_ip', 'log_agent', 'log_remark', 'log_status',
    ];

    public function log($user_id, $type = '1', $remark = '', $status = '1')
    {
        $agent = new Agent();
        $platform = $agent->platform();
        $ip = \request()->getClientIp();
        $addresses = Ip::find($ip);

        $agent_info = [];
        $agent_info['device'] = $agent->device();
        $agent_info['browser'] = $agent->browser();
        $agent_info['platform'] = $platform . ' ' . $agent->version($platform); //操作系统
        $agent_info['language'] = implode(',', $agent->languages()); //语言
        $agent_info['device_type'] = '';

        if ($agent->isTablet()) {
            // 平板
            $agent_info['device_type'] = 'tablet';
        } else if ($agent->isMobile()) {
            // 便捷设备
            $agent_info['device_type'] = 'mobile';
        } else if ($agent->isRobot()) {
            // 爬虫机器人
            $agent_info['device_type'] = 'robot';
            $agent_info['device'] = $agent->robot(); //机器人名称
        } else {
            // 桌面设备
            $agent_info['device_type'] = 'desktop';
        }
        $insert = [
            'user_id'=>$user_id,
            'log_type'=>$type,
            'log_ip'=>$ip,
            'log_address'=>implode(' ', $addresses),
            'log_agent'=> serialize($agent_info),
            'log_remark'=>$remark,
            'log_status'=>$status ? $status : 0,
            'created_at'=>date('Y-m-d H:i:s'),
        ];

        return $this->insert($insert);
    }
}
