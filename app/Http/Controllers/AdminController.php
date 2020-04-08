<?php

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
        $input = ['name'=> $username,'password'=>$password];
        $input['guard'] = 'admin_api';
        $http = new Client();
        $url = request()->root().'/oauth/token';
        $param = array_merge(config('passport.proxy'), $input);
        
        $response = $http->request('POST', $url, ['form_params'=>$param]);
        return json_decode((string) $response->getBody(), true);
    }


    public function index()
    {
    	if (\Auth::guard('admin_api')) {
            return response(['code' => 200, 'msg' => 'ok', 'data'=>\Auth::guard('admin_api')->user()]);
        }
    }
}
