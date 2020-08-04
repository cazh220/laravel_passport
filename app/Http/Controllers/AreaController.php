<?php
/**
 * 区域模块
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
	//获取所有省
    public function listProvinces(Request $request)
    {
    	$list = Area::provinces();
    	return response(['code'=>200, 'msg'=>'ok', 'data'=>$list->toArray()]);
    }

    //获取父级区域下所有区域
    public function listChildAreas(Request $request)
    {
    	$pid = $request->input('pid', '');//父id
    	$list = Area::getSubAreas($pid);
    	return response(['code'=>200, 'msg'=>'ok', 'data'=>$list->toArray()]);
    }

    //获取省市区联动信息
    public function listAreas(Request $request)
    {
    	$provinces = Area::provinces();
    	$cities = Area::cities();
    	$districts = Area::districts();

    	foreach ($provinces->toArray() as $key => $value) 
    	{
    		$province_list[$value['id']] = $value['name'];
    	}

    	foreach ($cities->toArray() as $key => $value) 
    	{
    		$city_list[$value['id']] = $value['name'];
    	}

    	foreach ($districts->toArray() as $key => $value) 
    	{
    		$county_list[$value['id']] = $value['name'];
    	}

    	$result = ['province_list'=>$province_list, 'city_list'=>$city_list, 'county_list'=>$county_list];

    	return response(['code'=>200, 'msg'=>'ok', 'data'=>$result]);
    }

}
