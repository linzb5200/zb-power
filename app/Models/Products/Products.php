<?php

namespace App\Models\Products;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{

    use SoftDeletes;
    protected $table = 'products';
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'cate_id','cate_str','title','keywords','description','color','tag', 'points','size','clicks','fav','zan','used','download','rand_clicks','rand_fav','rand_zan','rand_used','rand_download','soft','type','format','page','thumb','attachment','content','sort','status','created_at','updated_at'
    ];
    public $otherAttr = [
        'soft'=>[
            1=>'PowerPoint 2003',
            2=>'PowerPoint 2007',
            3=>'PowerPoint 2010',
            4=>'PowerPoint 2016',
            5=>'其他版本',
        ],
        'type'=>[
            1=>'动态模版',
            2=>'静态模版',
        ],
        'scale'=>[
            1=>'宽屏16:9',
            2=>'普屏4:3',
            3=>'竖屏A4',
        ],
        'sort'=>[
            1=>'综合排序',
            2=>'热门下载',
            3=>'最多收藏',
            4=>'最新上传',
        ]
    ];

    //文章所属分类
    public function category()
    {
        return $this->belongsTo('App\Models\Products\ProductsCate','id','cate_id');
    }

    //与标签多对多关联
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag','products_tag','product_id','tag_id');
    }
    //与颜色多对多关联
    public function colors()
    {
        return $this->belongsToMany('App\Models\Color','products_color','product_id','color_id');
    }
    //与风格多对多关联
    public function styles()
    {
        return $this->belongsToMany('App\Models\Style','products_style','product_id','style_id');
    }
    //与行业配置多对多关联
    public function trades()
    {
        return $this->belongsToMany('App\Models\Trades','products_trade','product_id','trade_id');
    }

    public function getInfo($id = 0){
        $info = $this->where('id', $id)->first()->toArray();
        return $info;
    }
    //获取指定分类下的产品
    public function getByCateIds($ids = '')
    {
        $arr = explode(',',$ids);
        return $this->whereIn('cate_id',$arr)->get()->toArray();

    }
    //获取搜索产品
    public function getByKeyword($keyword = '',$ids = '')
    {
        if($ids){
            $arr = explode(',',$ids);
            return $this->where('title','like','%'.$keyword.'%')->whereIn('cate_id',$arr)->get()->toArray();
        }else{
            return $this->where('title','like','%'.$keyword.'%')->get()->toArray();
        }
        return [];
    }
    //首页热门推荐
    public function getHots()
    {
        $model = new ProductsCate();
        $tops = $model->getCacheList(1);

        $hots = [];
        if($tops){
            foreach ($tops as $top )
            {
                $id = $top['id'];
                $children = $top['children'];

                $childIds = array_column($children,'id');
                $items = $this->whereIn('cate_id',$childIds)
                    ->limit(8)
                    ->orderBy('download')
                    ->get()->toArray();

                if($items){
                    foreach ($items as &$item )
                    {
                        $cate = $children[$item['cate_id']];
                        $item['pinyin_1'] = $top['pinyin'];
                        $item['pinyin_2'] = $cate['pinyin'];
                        $item['url'] = "/".$item['pinyin_1']."/".$item['pinyin_2']."/".$item['id'];
                    }
                    $hots[$id] = $items;
                }

            }
        }

        return $hots;
    }
}
