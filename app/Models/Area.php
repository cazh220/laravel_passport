<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //初始化表/字段信息
    protected $table = 'areas';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'name', 'pid', 'sname', 'level', 'citycode', 'yzcode', 'mername', 'Lng', 'Lat'];

    protected $hidden = [];

    //获取省
    public static function provinces()
    {
    	$provinces = Area::where('level', 1)->get();
    	return $provinces;
    }

    //获取所有城市
    public static function cities()
    {
    	$cities = Area::where('level', 2)->get();
    	return $cities;
    }

    //获取所有地区
    public static function districts()
    {
    	$districts = Area::where('level', 3)->get();
    	return $districts;
    }

    //获取父级区域下所有地区
    public static function getSubAreas($pid = '')
    {
    	$areas = Area::where('pid', $pid)->get();
    	return $areas;
    }
}
