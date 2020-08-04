<?php
/**
 * 文章
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
	protected $table = 'articles';
    protected $primaryKey = 'article_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'article_category_id', 'category_name', 'content_id', 'is_recommend', 'author', 'author_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];


    /**
     * [getArticles 获取文章]
     * @param  integer $cid  [分类]
     * @param  integer $page [页码]
     * @return [type]        [description]
     */
    public function getArticles($cid = 0, $page = 1)
    {
    	$Articles = $this;
    	if ($cid) 
    	{
    		$Articles = $Articles->where('article_category_id', $cid);
    	}
    	
    	$list = $Articles->orderBy('article_id', 'desc')->paginate(15);
    	return $list;
    }
}
