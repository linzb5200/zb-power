<?php

use app\Helpers\Util\Tree;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Storage;
use App\Models\Products\ProductsCate;


function p($array) {
    dump($array, 1, '<pre>', 0);
}

/**
 * 站点配置
 */
function settings($key = '')
{
    if (Cache::has('settings'))
    {
        $settings = Cache::get('settings');
    }else{
        $settings = \App\Models\System::all(['key', 'value'])->pluck('value', 'key')->toArray();
        Cache::put('settings', $settings, time() + 60);
    }

    if($key != ''){
        if(isset($settings[$key])) return $settings[$key];
        return '';
    }
    return $settings;
}
/**
 * 打印SQL
 */
function getSql(){
    \Illuminate\Support\Facades\DB::listen(function($query) {
        $bindings = $query->bindings;
        $sql = $query->sql;
        foreach ($bindings as $replace){
            $value = is_numeric($replace) ? $replace : "'".$replace."'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }
        dd($sql);
    });

}
/**
 * 同时更新多个记录
 */
function updateBatch($tableName,$multipleData = [])
{
    try {
        if (empty($multipleData)) {
            throw new \Exception("数据不能为空");
        }
        $firstRow  = current($multipleData);

        $updateColumn = array_keys($firstRow);
        // 默认以id为条件更新，如果没有ID则以第一个字段为条件
        $referenceColumn = isset($firstRow['id']) ? 'id' : current($updateColumn);
        unset($updateColumn[0]);
        // 拼接sql语句
        $updateSql = "UPDATE " . $tableName . " SET ";
        $sets      = [];
        $bindings  = [];
        foreach ($updateColumn as $uColumn) {
            $setSql = "`" . $uColumn . "` = CASE ";
            foreach ($multipleData as $data) {
                $setSql .= "WHEN `" . $referenceColumn . "` = ? THEN ? ";
                $bindings[] = $data[$referenceColumn];
                $bindings[] = $data[$uColumn];
            }
            $setSql .= "ELSE `" . $uColumn . "` END ";
            $sets[] = $setSql;
        }
        $updateSql .= implode(', ', $sets);
        $whereIn   = collect($multipleData)->pluck($referenceColumn)->values()->all();
        $bindings  = array_merge($bindings, $whereIn);
        $whereIn   = rtrim(str_repeat('?,', count($whereIn)), ',');
        $updateSql = rtrim($updateSql, ", ") . " WHERE `" . $referenceColumn . "` IN (" . $whereIn . ")";
        // 传入预处理sql语句和对应绑定数据
        return DB::update($updateSql, $bindings);
    } catch (\Exception $e) {
        return false;
    }
}
/**
 * 获取搜索条件
 */
function getMap($query, $temp)
{
    $input = \Request::all();

    if(isset($temp['no'])){
        foreach ($temp['no'] as $key => $val) {
            if (!is_array($val)) {
                if (isset($input[$val]) && $input[$val] == '') continue;
                if (is_integer($key)) continue;
                $query->where($key,$val);
                continue;
            }
            // 条件判断
            list($type, $value) = array_values($val);

            if(isset($input[$value]) && $input[$value] != ''){
                if ($type == 'like' || $type == 'not like') {
                    $query->where($key, $type, '%'.$input[$value].'%');
                }else if ($type == 'between') {
                    $query->whereBetween($key, $input[$value]);
                }else if ($type == 'not between') {
                    $query->whereNotBetween($key, $input[$value]);
                }else if ($type == 'in') {
                    $query->whereIn($key, $input[$value]);
                }else if ($type == 'not in') {
                    $query->whereNotIn($key, $input[$value]);
                }else if ($type == 'is null') {
                    $query->whereNull($key);
                }else if ($type == 'not null') {
                    $query->whereNotNull($key);
                }else if(in_array($type, ['=', '<', '>', '<=', '>=', '<>', '!=', '<=>'])) { // 比较
                    $query->where($key, $type, $input[$value]);
                }else{
                    if (strstr($value,'time') != '') {
                        $query->where($key, '<', strtotime($input[$value]));
                    } else {
                        $query->where($key, '<', $input[$value]);
                    }
                }
            }

            if(isset($input[$type]) && $input[$type] != ''){
                if (strstr($type,'time') != '') {
                    $query->where($key, '>=', strtotime($input[$type]));
                } else {
                    $query->where($key, '>=', $input[$type]);
                }
            }

        }

    }

    if(isset($temp['ok'])){
        foreach ($temp['ok'] as $key => $val) {
            if (!is_array($val)) {
                if (is_integer($key)) continue;
                $query->where($key,$val);
                continue;
            }
            // 条件判断
            list($type, $value) = array_values($val);

            if( $type == '') continue;
            if( $value == '') continue;

            if ($type == 'like' || $type == 'not like') {
                $query->where($key, $type, '%'.$value.'%');
            }else if ($type == 'between') {
                $query->whereBetween($key, $value);
            }else if ($type == 'not between') {
                $query->whereNotBetween($key, $value);
            }else if ($type == 'in') {
                $query->whereIn($key, $value);
            }else if ($type == 'not in') {
                $query->whereNotIn($key, $value);
            }else if ($type == 'is null') {
                $query->whereNull($key);
            }else if ($type == 'not null') {
                $query->whereNotNull($key);
            }else if(in_array($type, ['=', '<', '>', '<=', '>=', '<>', '!=', '<=>'])) { // 比较
                $query->where($key, $type, $value);
            }
        }
    }

    if(isset($temp['or'])){
        foreach ($temp['or'] as $key => $val) {
            if (!is_array($val)) {
                if (is_integer($key)) continue;
                $query->orWhere($key,$val);
                continue;
            }
            // 条件判断
            list($type, $value) = array_values($val);

            if( $type == '') continue;
            if( $value == '') continue;
            if ($type == 'like' || $type == 'not like') {
                $query->orWhere($key, 'like', '%'.$value.'%');
            }else if(in_array($type, ['=', '<', '>', '<=', '>=', '<>', '!=', '<=>'])) { // 比较
                $query->orWhere($key, $type, $value);
            }
        }
    }

    return $query;
}

/**
 * 批量获取路由参数
 */
function getArg($args){
    $arr = [];
    foreach ($args as $arg){
        $v = request()->route($arg);
        if($v == null && $v != '0' && in_array($arg,['color','style','trade','soft','type','scale'])){
            $v = '0';
        }
        if($v == null && $v != '0' && in_array($arg,['sort','page'])){
            $v = '1';
        }
        $arr[$arg] = $v;
    }
    return $arr;
}

// 获取图片路径
function getImagePath($id)
{
    if(empty($id)){
        return '';
    }
    $media = new \App\Models\Medias();
    return $media->getPathById($id);
}
// 设置可用
function delMedias($key)
{
    $media = new \App\Models\Medias();
    return $media->del($key);
}


/*
* 递归调用数据
*/
function setChild($data,$pid=0,$sort = 'SORT_ASC',$sort_column = '',$child='child')
{
    $arr = [];
    if (empty($data)) {
        return [];
    }

    foreach ($data as $key => $value) {
        if ($value['parent_id'] == $pid) {
            $arr[$key] = $value;
            $arr[$key][$child] = setChild($data,$value['id'],$sort,$sort_column,$child);
        }
    }

    if($sort_column != ''){
        foreach ($arr as $key => &$val) {
            if ($val[$child]) {
                $temp = array_column($val[$child], $sort_column);
                if($sort == 'SORT_ASC')array_multisort($temp,SORT_ASC,SORT_NUMERIC,$val[$child]);
                if($sort == 'SORT_DESC')array_multisort($temp,SORT_DESC,SORT_NUMERIC,$val[$child]);

            }
        }
    }

    return $arr;
}

/*
* 设置树形分类
*/
function getTree($data,$config = [])
{
    $tree = new Tree($data,$config);
    return $tree->getArray();
}

function getTreeChild($data,$config = [])
{
    $tree = new Tree($data,$config);
    return $tree->getChildArray();
}
/*
* 邮件发送
*/
function sendMailer($to, $subject, $body)
{

    $mail = new PHPMailer(true);
    try {
        //服务器配置
        $mail->CharSet ="UTF-8";                     //设定邮件编码
        $mail->SMTPDebug = 0;                        // 调试模式输出
        $mail->isSMTP();                             // 使用SMTP
        $mail->Host = 'smtp.163.com';                // SMTP服务器
        $mail->SMTPAuth = true;                      // 允许 SMTP 认证
        $mail->Username = '17689218655@163.com';     // SMTP 用户名  即邮箱的用户名
        $mail->Password = 'lzb123456';               // SMTP 密码  部分邮箱是授权码(例如163邮箱)
        $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
        $mail->Port = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

        $mail->setFrom('17689218655@163.com', '管理员');  //发件人
        $mail->addAddress($to, '');  // 收件人
        //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
        $mail->addReplyTo('17689218655@163.com', '管理员'); //回复的时候回复给哪个邮箱 建议和发件人一致
        //$mail->addCC('cc@example.com');                    //抄送
        //$mail->addBCC('bcc@example.com');                    //密送

        //发送附件
        // $mail->addAttachment('../xy.zip');         // 添加附件
        // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');    // 发送附件并且重命名

        //Content
        $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = '邮件客户端不支持HTML';

        $mail->send();
        return ['status'=>0,'msg'=>'邮箱验证码已发送成功，请登录邮箱查看'];
    } catch (Exception $e) {
        return ['status'=>1099,'msg'=>'邮件发送失败'. $mail->ErrorInfo];
    }
}


/*
 * html生成pdf文件
*/
function html2pdf($html, $save){
    $save = $save ? $save : public_path() . '/uploads/temp/pdf.png';
    if(file_exists($save)) unlink($save);
    $pdf = \App::make('snappy.pdf.wrapper');
    $pdf->loadHTML($html)->setOption('encoding', 'utf-8');
    return $pdf->save($save);
}
/**
 * html生成图片
 */
function html2img($html, $save){
    $save = $save ? $save : public_path() . '/uploads/temp/img.png';
    if(file_exists($save)) unlink($save);
    $pdf = \App::make('snappy.image.wrapper');
    $pdf->loadHTML($html)->setOption('encoding', 'utf-8');
    return $pdf->save($save);
}
/**
 * 下载远程文件到本地
 */
function download($url, $saveFolder =''){

    if(empty($url)) return '';

    $ext = File::extension($url);
    $saveName = md5($url) . '.'.$ext;
    $savePath = "/uploads/{$saveFolder}". date('Ymd').'/';
    $saveTo = public_path() . "/uploads/{$saveFolder}". date('Ymd').'/'.$saveName;

    if (!file_exists($savePath)) {
        $directory = public_path().$savePath;
        File::isDirectory($directory) or File::makeDirectory($directory, 0777, true, true);
    }

    if (!file_exists($saveTo)) {
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $response = $client->get($url, ['save_to' => $saveTo]);

        if ($response->getStatusCode() == 200) {
            return $savePath.$saveName;
        }
        return '';

    }
    return $savePath.$saveName;

}

/**
 * 添加到媒体库
 */
function addMedias($save, $disk = 'web'){

    $path = public_path().$save;
    $md5 = md5($save);

    if(!is_file($path)) return 0;

    $ret = DB::table('medias')->where('md5','=',$md5)->get();
    if($ret->isEmpty()) {


        $info = pathinfo($path);
        $basename =  $info['basename'];

        $pic = [
            'from'      => 'admin',
            'from_id'   => 1,
            'disk'      =>$disk,
            'path'      =>$save,
            'name'      =>$basename,
            'md5'       =>md5($save),
            'size'      =>filesize($path),
            'mime_type' =>filetype($path),
            'origin_name'=>$basename,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
        ];
        return DB::table('medias')->insertGetId($pic);
    }

    $info = $ret->toArray();
    $info = json_decode(json_encode($info),true);
    return $info[0]['id'];

}

/**
 * 查找內容中的图片
 */
function findContentImg($content){

    $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png|\.jpeg|\.JPEG|\.PNG|\.JPG]))[\'|\"].*?[\/]?>/";
    preg_match_all($pattern,$content,$match);

    $result = preg_match_all($pattern, $content, $matches);
    if ($result == 0 || $result == FALSE) {
        return FALSE;
    } else {
        $images = array_unique ( $match [1] );
        return $images;
    }

}
/**
 * 删除指定内容里包含的文件
 */
function delContentPic($content) {
    $images = findContentImg($content);

    if ($images != FALSE) {
        foreach ($images as $v) {
            deleteFile($v);
        }
    }
}
/**
 * 删除文件
 */
function deleteFile($file) {

    if(!$file) return false;
    if(is_array($file)){
        foreach ($file as $v){
            deleteFile($v);
        }
    }else{
        delMedias($file);

        $file = public_path().$file;
        if (trim($file) != '') {
            if (file_exists($file)) {
                return unlink($file);
            }
        }
    }

}

/**
 * 图片剪切
 */
function img2crop($image, $w, $h=null){
    Image::configure(array('driver' => 'imagick'));
    $height = Image::make($image)->height();
    $h = $h ? $h : $height;
    Image::make($image)->crop($w,$h,0,0)->save($image);
    return true;
}
/**
 * 图片压缩
 */
function img2Resize($image,$w=null,$h=null) {
    $img = Image::make($image);
    $width = $img->width();
    $w = $w ? $w : $width ;

    if(empty($h)){
        $img->resize($w, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($image);
    }else{
        $img->resize($w, $h)->save($image);
    }

    return true;
}
/**
 * 图片加水印
 */
function imgWater($image,$water,$x=15,$y=10) {
    Image::make($image)->insert($water, 'bottom-right', $x, $y)->save($image);
    return true;
}

/**
 * 文件大小并转化为KB、MB、GB单位
 */
function getSize($filesize){
    if($filesize >= 1073741824){
        $filesize = round($filesize / 1073741824 * 100) / 100 . ' GB';
    }elseif($filesize >= 1048576) {
        $filesize = round($filesize / 1048576 * 100) / 100 . ' MB';
    }elseif($filesize >= 1024) {
        $filesize = round($filesize / 1024 * 100) / 100 . ' KB';
    }else {
        $filesize = $filesize . ' 字节';
    }
    return $filesize;
}

//输出两个数组的非交集
//$type 等于0 单向非交集
//$type 等于1 双向非交集
function diff_out($arr1, $arr2,$type = 0){
    if( !array_diff($arr1, $arr2) && !array_diff($arr2, $arr1)){
        // 即相互都不存在差集，那么这两个数组就是相同的了，多数组也一样的道理
        return [];
    }else{
        $out1 = array_diff($arr1,$arr2);
        $out2 = $type ? array_diff($arr2,$arr1) :  [];
        $out3 = $out1 ? array_merge($out1, $out2) : $out2;
        return $out3;
    }
}


//获取分类字符串
function getCateStr($str,$splt='/')
{
    if(empty($str)) return '';
    $model = new ProductsCate();
    $temps = $model->getCacheList();
    $ids = explode('/',$str);
    $new = [];
    foreach ($ids as $id){
        $new[] = $temps[$id]['title'];
    }
    $new = implode($splt,$new);

    return $new;
}

//字母标记数组
function getZm($array)
{
    $str = 'a|b|c|d|e|f|g|h|i|j|k|l|m|n|o|p|q|r|s|t|u|v|w|x|y|z';
    $zm = explode('|',$str);
    foreach ($array as $k => &$arr){
        $arr['zm'] = $zm[$k];
    }
    return $array;
}

//产品列表页分页伪静态
function myPageUrl($url = '')
{

    $arr     = parse_url($url);

    $query = [];
    if(isset($arr['query'])){
        parse_str($arr['query'],$query);
    }


    if(isset($query['cate'])){
        $query['cate'] = '/'.$query['cate']."/";
    }
    if(isset($query['zm'])){
        $query['zm'] = $query['zm']."/";
    }

    $args = array_values($query);

    $url = implode('',$args).'.html';

    return $url;

}


/**
 * 计算几分钟前、几小时前、几天前、几月前、几年前。
 * $agoTime string Unix时间
 * @author tangxinzhuan
 * @version 2016-10-28
 */
function timeAgo($agoTime)
{
    if(!is_numeric($agoTime)){
        $agoTime = strtotime($agoTime);
    }

    // 计算出当前日期时间到之前的日期时间的毫秒数，以便进行下一步的计算
    $time = time() - $agoTime;

    if ($time >= 31104000) { // N年前
        $num = (int)($time / 31104000);
        return $num . '年前';
    }
    if ($time >= 2592000) { // N月前
        $num = (int)($time / 2592000);
        return $num . '月前';
    }
    if ($time >= 86400) { // N天前
        $num = (int)($time / 86400);
        return $num . '天前';
    }
    if ($time >= 3600) { // N小时前
        $num = (int)($time / 3600);
        return $num . '小时前';
    }
    if ($time > 60) { // N分钟前
        $num = (int)($time / 60);
        return $num . '分钟前';
    }
    return '1分钟前';
}

function hello(){
    date_default_timezone_set('Asia/Shanghai');
    $h=date("H");
    if($h<6) echo "凌晨好!";
    else if($h<9) echo "早上好！";
    else if($h<12) echo "上午好！";
    else if($h<14) echo "中午好！";
    else if($h<18) echo "下午好！";
    else echo "晚上好！";
}