<?php
/**
 * 文件处理模块
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;//图片处理库

class FileController extends Controller
{
	//上传图片
    public function uploadPic(Request $request)
    {
    	//自定义目录
    	$dir = 'avatars/'.date("Ym", time());
    	//上传并设置磁盘配置public
    	$path = $request->file('file')->store($dir, 'public');
        // return response(['code'=>200, 'msg'=>'ok', 'data'=>asset(Storage::url($path))]);
        return response(['code'=>200, 'msg'=>'ok', 'data'=>$path]);
    }

    //查看目录下所有文件包括子目录
    public function allFiles(Request $request)
    {
    	//path 默认空；即从项目目录/storage始
    	$directory = $request->input('path', '');
    	$files = Storage::allFiles($directory);
        // return response(['code'=>401, 'msg'=>'failed', 'data'=>[]])
    	return response(['code'=>200, 'msg'=>'ok', 'data'=>$files]);
    }

    //删除文件（支持多文件）
    public function deleteFiles(Request $request)
    {
    	//file参数格式array 
    	//参考格式:{"file":["public/avatars/202004/1.png","public/avatars/202004/2.png"]}
    	$file = $request->input('file', []);
    	$res = Storage::delete($file);
    	var_dump($res);
    }

    public function viewPic(Request $request)
    {
    	$pid = $request->input('id', 0);
    	print_r($pid);
    }
}
