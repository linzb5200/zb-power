<?php

namespace App\Http\Controllers\Common;

use Intervention\Image\ImageManagerStatic as Image;
use app\Helpers\Util\ImgCompress;
use App\Traits\Msg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Medias;


class UploadController extends Controller
{
    use Msg;
    public $table = "medias";
    public $member;

    public function init()
    {

        $web  = auth('web')->user()->toArray();;
        if($web){
            $this->member  = $web;
            $this->member['from'] = 'admin';
        }else{
            $this->member  = auth('member')->user()->toArray();;
        }

        // 验证是否登录
//        $this->middleware(function ($request, $next) {
//            if (!\Session::get('user')) {
//                echo "<script>alert('请先登录!');location.href='" . url('admin/login') . "';</script>";
//            }
//            return $next($request);
//        });
    }

    //图片上传处理
    public function uploadImg(Request $request)
    {
        $this->init();
        $domain = '';
        $disk='web';
        //上传文件夹
        $savePath = $request->input('path','thumb');
        //上传文件最大大小,单位M
        $maxSize = 10;
        //支持的上传图片类型 pptx|ppt|xlsx|xltm|docx|doc
        $allowImgs = ["png", "jpg", "jpeg", "gif"];
        $allowed_extensions = ["png", "jpg", "gif","ppt","pptx","xlsx","xltm","docx","doc"];
        //返回信息json
        $data = ['code'=>200, 'msg'=>'上传失败', 'data'=>''];

        $file = $request->file('file');
        //检查文件是否上传完成
        if($file->isValid()) {
            //获取原文件名
            $origin_name = $file->getClientOriginalName();
            //扩展名
            $ext = $file->getClientOriginalExtension();
            //文件类型
            $mime_type = $file->getClientMimeType();
            //文件大小
            $size = $file->getClientSize();
            //生成文件名
            $newName = md5($mime_type.$size.$origin_name.$ext).".".$ext;
            //生成MD5
            $md5 = md5($newName);

            //检测图片类型
            if (!in_array(strtolower($ext),$allowed_extensions)){
                $data['msg'] = "请上传".implode(",",$allowed_extensions)."格式的图片";
                return response()->json($data);
            }
            //检测图片大小
            if ($size > $maxSize*1024*1024){
                $data['msg'] = "图片大小限制".$maxSize."M";
                return response()->json($data);
            }
            //判断文件是否已上传
            $pic = $this->isExist($md5);
            //文件上传
            if(empty($pic)){
                $newFolder = "/uploads/{$savePath}/". date('Ymd')."/";
                //保存文件,覆盖同名文件
                $newPath = $file->storeAs($newFolder, $newName,'web' );
                //获取文件url
                $url = Storage::disk($disk)->url($newPath);

                //检测图片类型,图片就压缩
                if (in_array(strtolower($ext),$allowImgs)){
                    //剪切压缩
                    $w = $request->input('w','');
                    $h = $request->input('h','');
                    if($w) img2Resize(public_path().$newFolder.$newName,$w,$h);

                    //====== 无损压缩图片======
                    $source =  public_path().$newFolder.$newName;//原图片名称
                    $dst_img = $source;//压缩后图片的名称
                    $percent = 1;  #原图压缩，不缩放，但体积大大降低
                    $ImgCompress = new ImgCompress($source,$percent);
                    $ImgCompress->compressImg($dst_img);

                }

                $pic = [
                    'from'      => $this->member && isset($this->member['from']) ? $this->member['from'] : '',
                    'from_id'   => $this->member && isset($this->member['id']) ? $this->member['id'] : 0,
                    'disk'      =>$disk,
                    'path'      =>$domain.$newFolder.$newName,
                    'name'      =>$newName,
                    'md5'       =>$md5,
                    'size'      =>$size,
                    'mime_type' =>$mime_type,
                    'origin_name'=>$origin_name,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s'),
                ];
                $pic['id'] = DB::table($this->table)->insertGetId($pic);
            }
            $data['code'] = 0;
            $data['msg'] = "上传成功";
            $data['data'] = $pic;
        } else {
            $data['msg'] = $file->getErrorMessage();
        }
        return response()->json($data);

    }

    public function webUploader(Request $request)
    {
        $this->init();
        $disk='web';
        $domain = '';
        $savePath = $request->input('path','editor');
        $file = $request->file('file');


        if($file && $file->isValid()) {
            //获取原文件名
            $origin_name = $file->getClientOriginalName();
            //扩展名
            $ext = $file->getClientOriginalExtension();
            //文件类型
            $mime_type = $file->getClientMimeType();
            //文件大小
            $size = $file->getClientSize();
            //生成文件名
            $newName = md5($mime_type.$size.$origin_name.$ext).".".$ext;
            //生成MD5
            $md5 = md5($newName);

            //判断文件是否已上传
            $pic = $this->isExist($md5);

            if(empty($pic)){
                //保存文件,覆盖同名文件
                $newPath = $file->storeAs("/uploads/{$savePath}/". date('Ymd'), $newName,'web' );
                //获取文件url
                $url = Storage::disk($disk)->url($newPath);
                $url = $domain."/uploads/{$savePath}/". date('Ymd')."/".$newName;

                $info = [
                    'from'      => $this->member && isset($this->member['from']) ? $this->member['from'] : '',
                    'from_id' => $this->member && isset($this->member['id']) ? $this->member['id'] : 0,
                    'disk'      =>$disk,
                    'path'      =>$url,
                    'name'      =>$newName,
                    'md5'       =>$md5,
                    'size'      =>$size,
                    'mime_type' =>$mime_type,
                    'origin_name'=>$origin_name,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s'),
                ];
                $id = DB::table($this->table)->insertGetId($info);

                $info['state']  = 'SUCCESS';
                $info['id']     = $id;

                return json_encode($info);
            }else{
                $pic['state'] = 'SUCCESS';
                return $pic;
            }


        }
        $info = [
            "state"     => 'ERROR',
            "url"       => '',
            "title"     => '请选择图片',
            "original"  => '',
            "type"      => '',
            "size"      => ''
        ];

        return json_encode($info);
    }


    public function ckEditor(Request $request){

        $ck = $request->get('CKEditorFuncNum','1');
        $file = $request->file('upload');
        if($file && $file->isValid()) {
            //获取原文件名
            $originalName = $file->getClientOriginalName();
            //扩展名
            $ext = $file->getClientOriginalExtension();
            //文件类型
            $type = $file->getClientMimeType();
            //文件类型
            $size = $file->getClientSize();
            //生成文件名
            $newName = md5($type.$size.$originalName.$ext).".".$ext;
            //保存文件,覆盖同名文件
            $path = $file->storeAs('/media/editor/'. date('Ymd'), $newName,'web' );
            //获取文件url
            $url = Storage::disk('web')->url($path);
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($ck,'".$url."','上传成功');</script>";
        }else{
            echo "<script>alert('请选择图片！')</script>";
        }


    }

    public function allImg(Request $request)
    {
        $this->init();
        $domain = '';
        $disk='web';
        //上传文件夹
        $savePath = $request->input('path','allimg');
        //上传文件最大大小,单位M
        $maxSize = 10;
        //支持的上传图片类型
        $allowImgs = ["png", "jpg", "jpeg", "gif"];
        $allowed_extensions = ["png", "jpg", "jpeg", "gif"];
        //返回信息json
        $data = ['state'=>'ERROR', 'msg'=>'上传失败', 'data'=>''];

        $file = $request->file('upfile');
        if($file && $file->isValid()) {
            //获取原文件名
            $origin_name = $file->getClientOriginalName();
            //扩展名
            $ext = $file->getClientOriginalExtension();
            //文件类型
            $mime_type = $file->getClientMimeType();
            //文件大小
            $size = $file->getClientSize();
            //生成文件名
            $newName = md5($mime_type.$size.$origin_name.$ext).".".$ext;
            //生成MD5
            $md5 = md5($newName);

            //检测图片类型
            if (!in_array(strtolower($ext),$allowed_extensions)){
                $data['msg'] = "请上传".implode(",",$allowed_extensions)."格式的图片";
                return response()->json($data);
            }
            //检测图片大小
            if ($size > $maxSize*1024*1024){
                $data['msg'] = "图片大小限制".$maxSize."M";
                return response()->json($data);
            }
            //判断文件是否已上传
            $pic = $this->isExist($md5);
            //文件上传
            if(empty($pic)){
                $newFolder = "/uploads/{$savePath}/". date('Ymd')."/";
                //保存文件,覆盖同名文件
                $newPath = $file->storeAs($newFolder, $newName,'web' );
                //获取文件url
                $url = Storage::disk($disk)->url($newPath);

                //检测图片类型，图片就压缩
                if (in_array(strtolower($ext),$allowImgs)){
                    //剪切压缩
                    $w = $request->input('w',700);
                    $h = $request->input('h',null);
                    $imag = public_path().$newFolder.$newName;
                    $img = Image::make($imag);
                    $width = $img->width();
                    if($width > 700){
                        $w = 700;
                    }else{
                        $w = $width;
                    }
                    if($w) img2Resize($imag,$w,$h);

                    //====== 无损压缩图片======
                    $source =  public_path().$newFolder.$newName;//原图片名称
                    $dst_img = $source;//压缩后图片的名称
                    $percent = 1;  #原图压缩，不缩放，但体积大大降低
                    $ImgCompress = new ImgCompress($source,$percent);
                    $ImgCompress->compressImg($dst_img);

                }


                $pic = [
                    'from'      => $this->member && isset($this->member['from']) ? $this->member['from'] : '',
                    'from_id'   => $this->member && isset($this->member['id']) ? $this->member['id'] : 0,
                    'disk'      =>$disk,
                    'path'      =>$domain.$newFolder.$newName,
                    'name'      =>$newName,
                    'md5'       =>$md5,
                    'size'      =>$size,
                    'mime_type' =>$mime_type,
                    'origin_name'=>$origin_name,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s'),
                ];
                $pic['id'] = DB::table($this->table)->insertGetId($pic);
            }
            $pic['state'] = 'SUCCESS';
            $pic['url']       = $pic['path'];
            $pic['title']       = $pic['name'];
            $pic['original']    = $pic['origin_name'];
            $pic['type']        = $pic['mime_type'];
            return json_encode($pic);
        }
        $info = [
            "state" => 'ERROR',
            "url" => '',
            "title" => '请选择图片',
            "original" => '',
            "type" => '',
            "size" => ''
        ];

        return json_encode($info);
    }

    public function ueditor_video(Request $request)
    {

        $file = $request->file('upfile');
        if($file && $file->isValid()) {
            //获取原文件名
            $originalName = $file->getClientOriginalName();
            //扩展名
            $ext = $file->getClientOriginalExtension();
            //文件类型
            $type = $file->getClientMimeType();
            //文件类型
            $size = $file->getClientSize();
            //生成文件名
            $newName = md5($type.$size.$originalName.$ext).".".$ext;
            //保存文件,覆盖同名文件
            $path = $file->storeAs("/uploads/allimg/". date('Ymd'), $newName,'web' );
            //获取文件url
            $url = Storage::disk('web')->url($path);
            $url = "/uploads/allimg/". date('Ymd')."/".$newName;
            $info = [
                "state" => 'SUCCESS',
                "url" => $url,
                "title" => $newName,
                "original" => $originalName,
                "type" => $type,
                "size" => $size
            ];

        }else{
            $info = [
                "state" => 'ERROR',
                "url" => '',
                "title" => '请选择视频',
                "original" => '',
                "type" => '',
                "size" => ''
            ];
        }

        return json_encode($info);
    }

    public function isExist($md5)
    {

        $ret = DB::table($this->table)->where('md5','=',$md5)->get();

        if($ret->isEmpty()) return [];

        $info = $ret->toArray();
        $info = json_decode(json_encode($info),true);
        return $info[0];
    }

}
