<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/17
 * Time: 14:43
 */

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UploadController extends Controller
{
    public function index(Request $request)
    {
        /*Storage::disk('xx')->put('ggg.txt', 'Contents');
        $date = date('Y-m-d',time());
        $path = $request->file('file')->storePublicly($date);*/
        $file = Input::file('file');
        if($file->isValid()){
            $extension = $file->getClientOriginalExtension();
            $newName = uniqid().date('YmdHis').mt_rand(100,999).".".$extension;
            $path = $file->move(base_path()."/public/uploads",$newName);
            $returnFilePath ='uploads/'.$newName;
            //return $filepath;
            /*//检验上传的文件是否有效
            $clientName = $file->getClientOriginalName();//获取文件名称
            $tmpName = $file->getFileName();  //缓存在tmp文件中的文件名 例如 php9732.tmp 这种类型的
            $realPath = $file->getRealPath();  //这个表示的是缓存在tmp文件夹下的文件绝对路径。
            $entension = $file->getClientOriginalExtension(); //上传文件的后缀
            $mimeType = $file->getMimeType(); //得到的结果是imgage/jpeg
            $path = $file->move('storage/uploads');
            //如果这样写的话,默认会放在我们 public/storage/uploads/php9372.tmp
            //如果我们希望将放置在app的uploads目录下 并且需要改名的话
            $path = $file->move(app_path().'/uploads'.$newName);
            //这里app_path()就是app文件夹所在的路径。$newName 可以是通过某种算法获得的文件名称
            //比如 $newName = md5(date('YmdHis').$clientName).".".$extension;*/
        }
        return response()->json(array('code'=>0,'msg'=>'上传成功','data'=>array('path'=>$returnFilePath)));
    }
}