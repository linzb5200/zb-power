<?php

namespace App\Models\Crawler;

use App\Models\Model;

class CrawlerPower extends Model
{
    protected $table = 'crawler_power';

    protected $fillable = ['power_id','product_id','title','status','rule_id','link','photo','category','tags','created_at','closed'];

}
