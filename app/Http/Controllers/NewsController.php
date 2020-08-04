<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    //
    public function list(Request $request)
    {
        $dir = 'public/avatars/'.date("Ym", time());
    	$path = $request->file('file')->store($dir);

        return response(['code'=>200, 'msg'=>'ok', 'data'=>asset($path)]);
    }

    public function addNews()
    {

    }

    public function editNews()
    {

    }

    public function deleteNews()
    {

    }

}
