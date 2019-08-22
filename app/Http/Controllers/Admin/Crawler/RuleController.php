<?php

namespace App\Http\Controllers\Admin\Crawler;

use App\Models\Products\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Crawler\Rule;
use App\Models\Crawler\CrawlerPower;
use Illuminate\Support\Facades\DB;
use QL\QueryList;

class RuleController extends Controller
{
    protected $rule;
    public function __construct()
    {
        parent::__construct();
        $this->rule = [
            'url'=>'nullable',
            'name' =>'nullable',
            'pick_title' =>'nullable',
            'pick_page' =>'nullable',
            'pick_content' =>'nullable',
            'pick_link' =>'nullable',
            'pick_thumb' =>'nullable',
            'pick_current_page' =>'nullable',
            'pick_category' =>'nullable',
            'pick_pick_category_text' =>'nullable',
            'pick_tag' =>'nullable',
            'pick_datetime' =>'nullable',
            'pick_file' =>'nullable',
            'pick_file_blank' =>'nullable',
            'remark' =>'nullable',
        ];

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.crawler.rule.index');
    }

    public function data(Request $request)
    {

        $map = [
            'ok' => [
                'closed' => 0,
            ]
        ];
        $query = Rule::query();
        $res = getMap($query,$map)->orderBy('id')->paginate($request->get('limit',30))->toArray();

        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res['total'],
            'data'  => $res['data']
        ];
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.crawler.rule.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,$this->rule);
        $tags = $request['tags'];
        $data['tag'] = $tags ? implode(',',$tags) : '';

        if (Rule::create($request->all())){
            return redirect(route('admin.products'))->with(['status'=>'添加完成']);
        }
        return redirect(route('admin.products'))->with(['status'=>'系统错误']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Rule::findOrFail($id);

        return view('admin.crawler.rule.edit',compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request,$this->rule);

        $tags = $request['tags'];
        $data['tag'] = $tags ? implode(',',$tags):'';

        $ret = Rule::findOrFail($id);
        if ($ret->update($data)){
            return redirect(route('admin.crawler_rule'))->with(['status'=>'更新成功']);
        }
        return redirect(route('admin.crawler_rule'))->withErrors(['status'=>'系统错误']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择删除项']);
        }
        foreach (Rule::whereIn('id',$ids)->get() as $model){
            $this->dels($model,true);
        }
        return response()->json(['code'=>0,'msg'=>'删除成功']);
    }
    //复制
    public function copy(Request $request, $id)
    {
        $rule = Rule::findOrFail($id);
        $insert = $rule->toArray();
        $insert['now_total'] = 0;
        $insert['now_start_cat'] = 0;
        $insert['now_start_page'] = 1;
        $insert['now_remark'] = '';
        unset($insert['id']);
        $ret =  Rule::insert($insert);
        if($ret){
            return response()->json(['code'=>0,'msg'=>'复制成功']);
        }

        return response()->json(['code'=>1,'msg'=>'复制失败']);
    }

    //采集
    public function pick(Request $request, $id)
    {
        set_time_limit(0);

        $rule = Rule::findOrFail($id);

        $page = $rule['now_start_page'];
        $cat = $rule['now_start_cat'];

        //============分类采集============
        $categorys = $this->pick_cate($rule);
        $total_cate = count($categorys);
        if (!isset($categorys[$cat])) {

            $total = CrawlerPower::where('source',$rule->url)->count();

            $temp_cat = $cat+1;
            $update = [
                'now_total'=>$total,
                'now_start_cat'=>0,
                'now_start_page'=>1,
                'now_remark'=>"共有{$total_cate}个分类,采集到第{$temp_cat}分类，已采集所有分类"
            ];
            Rule::where('id',$id)->update($update);

            $msg = "已采集所有分类";
            $href = route('admin.crawler_rule');
            echo $msg;
            echo ("<script>location='".$href."'</script>");
        }else{

            $currCate = $categorys[$cat];


            //============采集页码============
            $pages = $this->pick_pages($rule,$currCate);
            $total_page = count($pages);

            if($pages && $total_page >= $page){
                $curr_page = [];
                if(isset($pages[$page])){
                    $curr_page = $pages[$page];
                }
                //============采集文章列表============
                $lists = $this->pick_list($rule,$currCate,$curr_page);
                $insert = [];
                foreach ($lists as &$item){
                    if($this->pick_check($item) == 0) {
                        $insert[] = $item;
                    }
                }
                //============写入采集库============
                $ret = true;
                if($insert){
                    $ret =  Db::table('crawler_power')->insert($insert);
                }


                if($ret){
                    $next = $page +1;


                    $total = CrawlerPower::where('source',$rule->url)->count();

                    $temp_cat = $cat+1;
                    $update = [
                        'now_total'=>$total,
                        'now_start_cat'=>$cat,
                        'now_start_page'=>$next,
                        'now_remark'=>"共{$total_cate}个分类,采集第{$temp_cat}分类：{$currCate['category_text']}，第{$page}页"
                    ];
                    Rule::where('id',$id)->update($update);

                    $temp_cat = $cat+1;
                    $msg = "共有{$total_cate}个分类,采集到第{$temp_cat}分类：{$currCate['category_text']}，共{$total_page}页，采集第{$next}页";
                    $href = route('admin.crawler_rule.pick',['id'=>$id,'cat'=>$cat,'page'=>$next]);
                    echo $msg;
                    echo ("<script>location='".$href."'</script>");
                }

            }else{


                $total = CrawlerPower::where('source',$rule->url)->count();

                $update = [
                    'now_total'=>$total,
                    'now_start_cat'=>$cat + 1,
                    'now_start_page'=>1,
                ];
                Rule::where('id',$id)->update($update);

                $temp_cat = $cat+1;
                $msg = "共有{$total_cate}个分类,采集到第{$temp_cat}分类：{$currCate['category_text']}完成,采集下一分类";
                $href = route('admin.crawler_rule.pick',['id'=>$id,'page'=>1,'cat'=>$cat + 1]);
                echo $msg;
                echo ("<script>location='".$href."'</script>");
            }
        }


    }
    //采集分类
    public function pick_cate($rule)
    {
        // 源网站链接
        $url = $rule->url;
        $md5 = md5($url);
        $cateList = cache($md5);
        if(empty($cateList)){

            // 域名
            $urlArray = parse_url($url);
            $domain = $urlArray['scheme'] . '://' . $urlArray['host'];

            $rules = [
                'category_url' => [$rule->pick_category, 'href'], // 所有分类链接
                'category_text' => [$rule->pick_category_text, 'text'], // 所有分类名称
            ];
            $rt = QueryList::get($url)->rules($rules)->query()->getData();

            $cates = $rt->all();

            if($cates){
                foreach ($cates as $k => $cate){
                    if(strpos( $cate['category_url'], 'http') === false ){
                        $cate['category_url'] = $domain . $cate['category_url'];
                    }
                    $cate['category_text'] = $this->convert_encoding($cate['category_text']);
                    $cateList[] = $cate;
                }
            }
            cache($md5,$cateList);
        }
        return $cateList;

    }
    //采集文章列表
    public function pick_list($rule,$cateInfo,$curr_page = [])
    {
        // 源网站链接
        $source = $rule->url;
        // 域名
        $urlArray = parse_url($source);
        $domain = $urlArray['scheme'] . '://' . $urlArray['host'];

        if(empty($curr_page)){
            $url = $cateInfo['category_url'];
            $pick_category_text = $cateInfo['category_text'];
            $pick_category_url = $cateInfo['category_url'];
        }else{
            $url = $curr_page['page_link'];
            $pick_category_text = $curr_page['category_text'];
            $pick_category_url = $curr_page['category_url'];
        }

        $rules = [
            'title' => [$rule->pick_title, 'text'],
            'link' => [$rule->pick_link, 'href'],
            'thumb' => [$rule->pick_thumb, 'src'],
        ];
        $rt = QueryList::get($url)->rules($rules)->query()->getData();

        $lists = $rt->all();
        $data = [];
        if($lists){
            foreach ($lists as $k => &$list){
                $list['link'] = $this->add_pre($list['link'],$domain);
                if(strpos( $list['link'], 'http') === false ){
                    $list['link'] = $domain . $list['link'];
                }
                $list['title'] = $this->convert_encoding($list['title']);

                //============采集文章标签============
                $tags = $this->pick_tag($rule,$list['link']);

                //============采集文章详情============
                $url = $list['link'];
                $ql = QueryList::get($url);
                $content = $ql->find($rule->pick_content)->html();

                //============采集文件独立页面链接============
                $file_blank = $this->pick_file_blank($rule,$list['link'],$domain);

                //============文件采集============
                $rules = [
                    'file' => [$rule->pick_file, 'href'],
                ];
                $rt = QueryList::get($file_blank)->rules($rules)->query()->getData();

                $files = $rt->all();
                $content = $this->convert_encoding($content);

                if(isset($files[0]) && $files[0]['file']){

                    $data[] = [
                        'source' =>$source,
                        'category' =>$pick_category_text,
                        'tags' =>$tags,
                        'category_url' =>$pick_category_url,
                        'thumb' =>$list['thumb'],
                        'link' =>$url,
                        'title' =>$list['title'],
                        'file' => isset($files[0]) ? $files[0]['file'] : '',
                        'content' =>$content,
                    ];
                }
            }
        }

        return $data;

    }
    //采集文章标签
    public function pick_tag($rule,$url)
    {
        if(empty($rule->pick_tag)) return '';
        $rules = [
            'tag_text' => [$rule->pick_tag, 'text'],
        ];
        $tags = QueryList::get($url)->rules($rules)->query()->getData();
        $temp_tags = [];
        if($tags){
            foreach ($tags as $kt => $tag){
                $temp_tags[] = $this->convert_encoding($tag['tag_text']);
            }
        }

        return $temp_tags ? implode(',',$temp_tags) : '';

    }
    //采集文件独立页面链接
    public function pick_file_blank($rule,$url,$domain)
    {
        if(empty($rule->pick_file_blank)) return $url;
        $rules = [
            'file_blank' => [$rule->pick_file_blank, 'href'],
        ];
        $blank = QueryList::get($url)->rules($rules)->query()->getData();

        if(isset($blank[0])){
            $link = $blank[0]['file_blank'];
            $link = $this->add_pre($link,$domain);

        }
        return $link;

    }
    //采集分类的页码
    public function pick_pages($rule,$cateInfo)
    {
        $url = $cateInfo['category_url'];
        $md5 = md5($url);
        $pages = cache($md5);
        $pages = [];
        if(empty($pages)){
            $rules = [
                'page_link' => [$rule->pick_page, 'href'],
                'page_text' => [$rule->pick_page, 'text'],
                'now' => [$rule->pick_current_page, 'text'],
            ];
            $pageInfo = QueryList::get($url)->rules($rules)->query()->getData();
            if($pageInfo){
                $temp_page = [];
                foreach ($pageInfo as $k => $p){
                    $p['category_url'] = $cateInfo['category_url'];
                    $p['category_text'] = $cateInfo['category_text'];
                    $p['page_link'] = $url.$p['page_link'];
                    $p['page_text'] = $this->convert_encoding($p['page_text']);
                    if(is_numeric($p['page_text'])){
                        $temp_page[$p['page_text']] = $p;
                    }
                }
                $pageInfo = $temp_page;
                cache($md5,$temp_page);
            }
        }
        return $pageInfo;

    }
    //采集页码
    public function pick_check($data)
    {
        return CrawlerPower::where('link',$data['link'])->count();
    }


    public function add_pre($link,$domain)
    {
        if(strpos( $link, 'http') === false ){
            $link = $domain . $link;
        }
        return $link;
    }
    /**
     * 编码转换
     */
    public function convert_encoding($str,$debug = 0)
    {
        if(empty($str)) return $str;

        $encode = mb_detect_encoding($str, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
        $str = mb_convert_encoding($str, 'UTF-8', $encode);
        if($debug){
            echo $str;
            exit();
        }
        return $str;
    }
}
