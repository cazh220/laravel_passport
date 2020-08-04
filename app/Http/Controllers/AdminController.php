<?php
/**
 * 后台登录
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admins;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class AdminController extends Controller
{
	public function test()
	{
		echo "admin";
	}

    public function register(Request $request)
    {
    	$input = $request->all();
        $input['password'] = bcrypt($input['password']);
    	$Admins = new Admins();
        $res = $Admins::create($input);
        if ($res)
        {
            return response(['code' => 200, 'msg' => 'ok']);
        }
    }

    public function login(Request $request)
    {
    	$username = $request->input('username', '');
        $password = $request->input('password', '');
        $input = ['username'=> $username,'password'=>$password];
        $input['guard'] = 'admin_api';
        $http = new Client();
        $url = request()->root().'/oauth/token';
        $param = array_merge(config('passport.proxy'), $input);
        
        $response = $http->request('POST', $url, ['form_params'=>$param]);
        return json_decode((string) $response->getBody(), true);
    }

    //验证用户信息
    public function index()
    {
    	if (\Auth::guard('admin_api')) {
            return response(['code' => 200, 'msg' => 'ok', 'data'=>\Auth::guard('admin_api')->user()]);
        }
    }

    //注销登录时删除token以免产生垃圾信息变大
    public function logout()
    {
        if (\Auth::guard('admin_api')->check()) {
            \Auth::guard('admin_api')->user()->token()->delete();
        }

        return response(['code' => 200, 'msg' => '退出登陆']);
    }
}
