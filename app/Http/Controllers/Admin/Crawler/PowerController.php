<?php

namespace App\Http\Controllers\Admin\Crawler;

use App\Models\Crawler\CrawlerPower;
use App\Models\Products\Products;
use App\Models\Products\Tags;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Crawler\Rule;
use Illuminate\Support\Facades\File;
use Chumper\Zipper\Zipper;

class PowerController extends Controller
{
    protected $rule;
    public function __construct()
    {
        parent::__construct();
        $this->rule = [
            'title' =>'nullable',
            'content' =>'nullable',
        ];

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.crawler.power.index');
    }

    public function data(Request $request)
    {

        $map = [
            'no' => [
                'title' => ['like','title'],
                'category' => ['like','keyword'],
            ],
            'ok' => [
                'closed' => 0,
            ]
        ];
        $query = CrawlerPower::query();
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
        return view('admin.crawler.power.create');
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

        if (CrawlerPower::create($request->all())){
            return redirect(route('admin.crawler_power'))->with(['status'=>'添加完成']);
        }
        return redirect(route('admin.crawler_power'))->with(['status'=>'系统错误']);

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
        $data = CrawlerPower::findOrFail($id);

        return view('admin.crawler.power.edit',compact(['data']));
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

        $ret = CrawlerPower::findOrFail($id);
        if ($ret->where('id',$id)->update($data)){
            return redirect(route('admin.crawler_power'))->with(['status'=>'更新成功']);
        }
        return redirect(route('admin.crawler_power'))->withErrors(['status'=>'系统错误']);
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
        foreach (CrawlerPower::whereIn('id',$ids)->get() as $model){
            $this->dels($model);
        }
        return response()->json(['code'=>0,'msg'=>'删除成功']);
    }
    //入库
    public function adds(Request $request)
    {
        $ids = $request->get('ids');

        if (empty($ids)){
            return response()->json(['code'=>1,'msg'=>'请选择入库项']);
        }
        foreach (CrawlerPower::whereIn('id',$ids)->get() as $model){
            $data = $model->toArray();

//            if($data['product_id'] > 0) continue;

            $thumb = download($data['thumb'],'thumb/');

            $file = download($data['file'],'attach/');
            $ext = File::extension($data['file']);
            $filesize = filesize(public_path() .$file);
            $size = round($filesize / 1048576 * 100) / 100 ;

            $content = $this->downContentImg($data['content'],'allimg/');

            $today = strtotime(date('Y-m-d 09:00:00'))+ 3600 * mt_rand(0,10) + mt_rand(10,3600) ;

            $insert=[];
            $insert['cate_id'] = 0;
            $insert['title'] = $data['title'];
            $insert['content'] = $content;
            $insert['thumb'] = addMedias($thumb);
            $insert['attachment'] = addMedias($file);
            $insert['format'] = $ext;
            $insert['size'] = $size;
            $insert['rand_clicks'] = mt_rand(900,5000);
            $insert['rand_zan'] = mt_rand(300,700);
            $insert['rand_fav'] =  mt_rand(150,$insert['rand_zan']);
            $insert['rand_used'] = mt_rand(50,$insert['rand_fav']);
            $insert['rand_download'] = mt_rand(200,$insert['rand_clicks']);
            $insert['created_at'] = date('Y-m-d H:i:s',$today);
            $insert['updated_at'] = $insert['created_at'];
            $insert['tag'] = $this->tags($data['tags']);

            $cate_id = 0;
            $insert['cate_id'] = $cate_id;

            $poduct_id =  Products::insertGetId($insert);
            if($poduct_id){
                $ret = $model->where('id',$data['id'])->update(['product_id'=>$poduct_id]);

            }
        }
        return redirect(route('admin.crawler_power'))->with(['status'=>'入库成功']);

    }


    //下载文章中图片
    public function downContentImg($content,$folder)
    {
        $images = findContentImg($content);
        if(empty($images)) return $content;
        $temp = [];
        if($images){
            foreach ($images as $key => $url) {
                $pathInfo = pathinfo($url);
                if(empty($pathInfo))continue;

                $temp[$key] = download($url,$folder);

            }

            $content = str_replace($images, $temp, $content);

        }
        return $content;

    }
    //生成标签
    public function tags($str)
    {
        if(empty($str)) return '';

        $tags = explode(',',$str);
        $ids = [];
        foreach ($tags as $tag){

            $insert = [
                'tag'=>$tag,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s'),
            ];
            $find = Tags::where('tag','=',$tag)->count();

            if($find){
                $find = Tags::where('tag','=',$tag)->get();
                $ids[] =  $find->toArray()[0]['id'];
            }else{
                $ids[] =  Tags::insertGetId($insert);
            }
        }
        $ids = implode(',',$ids);
        return $ids;

    }

    //重名文件
    public function moveto($id)
    {
        $data = Products::findOrFail($id);

        $attachment = getImagePath($data['attachment']);

        if(strstr($attachment,'.zip')){


            $pathinfo = pathinfo(public_path() .$attachment);

            $folder = public_path() ."/uploads/temp/";
            //解压文件
            $zip = new Zipper();
            $zip->make(public_path() .$attachment)->extractTo($folder);
            $zip->close();
            $filesnames = scandir($folder);
            foreach ($filesnames as $file){
                if(strstr($file,'.html') || strstr($file,'.url')){
                    unlink($folder.$file);
                }
                if(strstr($file,'.pptx')){
                    $ppt = pathinfo($folder.$file);
                    $to = str_replace('.'.$pathinfo['extension'],'.'.$ppt['extension'],$attachment);
                    rename($folder.$file,public_path() .$to);

                    $mv = pathinfo(public_path().$to);
                    Db::table('medias')->where('id','=', $data['attachment'])
                        ->update(['path'=>$to,'origin_name'=>$mv['basename']]);
                    $data->update(['format'=>$ppt['extension']]);
//                    unlink(public_path().$attachment);
                }
            }
        }
    }
}
