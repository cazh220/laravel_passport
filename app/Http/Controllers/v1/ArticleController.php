<?php
/**
 * 文章模块
 */
namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articles;
use Validator;

class ArticleController extends Controller
{
	/**
	 * [articles 获取文章]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
   	public function articles(Request $request)
   	{
   		$input = $request->all();
   		$validator = Validator::make($input, [
            'cid'  => 'required|numeric',
            'page' => 'numeric'
        ]);
    	if ($validator->fails()) 
        {
        	return response(['code'=>-1001, 'msg'=>'failed', 'data'=>get_validator_error($validator->errors(),0)]);
        }
   		$cid = !empty($input['cid']) ? intval($input['cid']) : 0;
   		$page = !empty($input['page']) ? intval($input['page']) : 1;
   		$Articles = new Articles();
   		$list = $Articles->getArticles($cid, $page);

   		return response(['code'=>200, 'msg'=>'ok', 'data'=>$list]);
   	}
}
