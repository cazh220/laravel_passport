<?php
/**
 * 测试
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getCountry()
    {
        return response(['code'=>200, 'msg'=>'ok', 'data'=>'中国']);
    }
}
