<?php
/**
 * 用户
 */
namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Register;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Lib\Passport\Passport;

class UserController extends Controller
{
    /**
     * [login 登录]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function login(Request $request)
    {
        $input = $request->all();
        $username = !empty($input['username']) ? trim($input['username']) : '';
        $password = !empty($input['password']) ? trim($input['password']) : '';

        if (Auth::attempt(['username'=>$username, 'password'=>$password]))
        {

            $user = Auth::user();
            // $token = $user->createToken('myToken')->accessToken;//简易token
            //passport Oauth2.0 认证token
            $passport = new Passport();
            $token = $passport->accessToken(['username'=> $username,'password'=>$password]);
            $result = ['user'=>$user, 'token'=>$token];

            return response(['code' => 200, 'msg' => 'ok', 'data'=>$result]);
        }
        else
        {
            return response(['code' => 401, 'msg' => '用户名或密码不正确']);
        }
    }

    /**
     * [register 注册]
     * @param  Request $request [description]
     * @return [json]           [description]
     */
    public function register(Request $request)
    {
    	$input = $request->all();
        $user_input = array(
            'username'      => !empty($input['username']) ? trim($input['username']) : '',
            'name'          => !empty($input['name']) ? trim($input['name']) : '',
            'password'      => !empty($input['password']) ? trim($input['password']) : '',
            'c_password'    => !empty($input['c_password']) ? trim($input['c_password']) : '',
            'email'         => !empty($input['email']) ? trim($input['email']) : '',
            'sex'           => !empty($input['sex']) ? intval($input['sex']) : 0,
            'province'      => !empty($input['province']) ? intval($input['province']) : 0,
            'city'          => !empty($input['city']) ? intval($input['city']) : 0,
            'district'      => !empty($input['district']) ? intval($input['district']) : 0,
            'address'       => !empty($input['address']) ? trim($input['address']) : '',
            'photo'         => !empty($input['photo']) ? trim($input['photo']) : ''
        );
    	
    	$Register = new Register();
    	$validator = Validator::make($user_input, $Register->rules(), $Register->messages());
    	if ($validator->fails()) 
        {
        	return response(['code'=>-1001, 'msg'=>'failed', 'data'=>get_validator_error($validator->errors(),0)]);
        }
        //写入数据库
        $user_input['password'] = bcrypt($user_input['password']);//加密
        $user = User::create($user_input);
        if ($user->id) 
        {
            return response(['code'=>200, 'msg'=>'ok', 'data'=>$user]);
        }

    	return response(['code'=>-1000, 'msg'=>'register failed']);
    }

    public function eidtPassword()
    {

    }


    public function delete()
    {

    }
}
