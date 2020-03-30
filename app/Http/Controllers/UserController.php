<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
 use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // 验证登陆信息
    public function index()
    {
    	$user = Auth::user();
        if ($user->username)
        {
            return response(['code' => 200, 'msg' => 'ok', 'data'=>$user]);
        }
    }

    // 注册
    public function register(Request $request)
    {
    	$input = $request->all();
        $input['password'] = bcrypt($input['password']);
    	$User = new User();
        $res = $User::create($input);
        if ($res)
        {
            return response(['code' => 200, 'msg' => 'ok']);
        }
    }

    // 登录并生成token
    public function login(Request $request)
    {
        $username = $request->input('username', '');
        $password = $request->input('password', '');

        if (Auth::attempt(['username'=>$username, 'password'=>$password]))
        {
            $user = Auth::user();
            $token = $user->createToken('myToken')->accessToken;

            return response(['code' => 200, 'msg' => 'ok', 'data'=>$user, 'token'=>$token]);
        }
        else
        {
            return response(['code' => 401, 'msg' => '登录失败']);
        }
    }


}
