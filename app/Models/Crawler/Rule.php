<?php

namespace App\Models\Crawler;

use App\Models\Model;

class Rule extends Model
{
    protected $table = 'crawler_rule';

    protected $fillable = ['id','url','name','pick_title','pick_current_page','pick_page','pick_content','pick_link','pick_desc','pick_thumb','pick_file','pick_file_blank','pick_current_page','pick_category','pick_category_text','pick_tag','pick_datetime','remark','now_start_cat','now_start_page','now_remark','now_total'];

}
