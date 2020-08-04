<?php
/**
 * 全局函数
 */

/**
 * [get_validator_error 返回验证的错误信息整理]
 * @param  [array]  $errors [错误信息]
 * @param  integer $flag   [是否显示第一条，默认展示第一条，否则展示全部]
 * @return [string]          [错误信息]
 */
if (!function_exists('get_validator_error')) {
	function get_validator_error($errors = [], $flag = 1) {
		$err = '';
		$errors = object_to_array($errors);
		if (empty($errors)) {
			return $err;
		}
		$errors_arr = [];
		foreach ($errors as $key => $value) {
			foreach ($value as $k => $v) {
				array_push($errors_arr, $v);
			}
		}

		if ($flag) {
			// 获取第一条错误信息
			$err = $errors_arr[0];
		} else {
			// 获取所有错误信息
			$err = implode("\n", $errors_arr);
		}
		return $err;
	}
}



/**
 * [object_to_array eloquent对象转数组]
 * @param  [type] $object [对象]
 * @return [type]         [数组]
 */
if (!function_exists('object_to_array')) {
	function object_to_array($object) {
		return json_decode(json_encode($object), true);
	}
}
