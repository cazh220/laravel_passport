<?php
/**
 * Passport 通用模块 获取access Token、刷新access Token
 * @author caoz
 * @date   2019-10-10 09:59
 */
namespace App\Helpers\Lib\Passport;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class Passport {
	private $host;
	const GENERATE_TOKEN 	= '/oauth/token';

	/**
	 * [__construct 构造函数]
	 */
	public function __construct()
	{
		$this->host = request()->root();
	}

	/**
	 * [accessToken 获取accessToken]
	 * @param  array  $form [表单参数]
	 * @return [type]       [description]
	 */
	public function accessToken($form=array())
	{
		$url = $this->host.self::GENERATE_TOKEN;
		$param = array_merge(config('passport.proxy'), $form);
		$http = new Client();
		Log::info('['.__CLASS__.']['.__FUNCTION__.']param:'.json_encode($param));
		$response = $http->request('POST', $url, ['form_params'=>$param]);
		return json_decode((string) $response->getBody(), true);
	}

	/**
	 * [refreshToken 刷新token]
	 * @param  array  $form [表单数据]
	 * @return [type]       [description]
	 */
	public function refreshToken($form=array())
	{
		$url = $this->host.self::GENERATE_TOKEN;
		$param = array_merge(config('passport.proxy'), $form);
		$param['grant_type'] = 'refresh_token';
		$http = new Client();
		Log::info('['.__CLASS__.']['.__FUNCTION__.']param:'.json_encode($param));
		$response = $http->request('POST', $url, ['form_params'=>$param]);
		return json_decode((string) $response->getBody(), true);
	}
}