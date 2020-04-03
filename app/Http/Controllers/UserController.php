<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class UserController extends Controller
{
    public function test()
    {
        echo "Test";
    }

    public function test2()
    {
        $http = new Client();
        $url = request()->root().'/oauth/token';
        $param = array_merge(config('passport.proxy'), ['username'=>'admin', 'password'=>111111]);
        $response = $http->request('POST', $url, ['form_params'=>$param]);

        return json_decode((string) $response->getBody(), true);
    }

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

    // 登录并生成token;简易的token生成方式
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

    // 生成oauth2.0 token与refresh_token
    public function login2(Request $request)
    {
        $username = $request->input('username', '');
        $password = $request->input('password', '');
        $input = ['username'=> $username,'password'=>$password];
        $http = new Client();

        $url = request()->root().'/oauth/token';
        $param = array_merge(config('passport.proxy'), $input);
        $response = $http->request('POST', $url, ['form_params'=>$param]);
        return json_decode((string) $response->getBody(), true);
    }


}
