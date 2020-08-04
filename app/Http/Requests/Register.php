<?php
/**
 * 用户注册表单验证
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'      => 'required | unique:users',
            'name'          => [
                                    'regex: /^[\x{4e00}-\x{9fa5}]{2,4}$/u'
                               ],//2-4个中文字符
            'password'      => [
                                    'required', 
                                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[^]]{8,16}$/'
                                ],//8-16位必须包含大小写字母和数字 正则的写法
            'c_password'    => 'required | same:password',
            'email'         => 'email | unique:users',
            'sex'           => 'boolean',
            'province'      => 'numeric',
            'city'          => 'numeric',
            'district'      => 'numeric'
        ];
    }


    /**
     * 获取已定义的验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => '用户名不为空',
            'name.regex'  => '姓名必须为2-4个中文字符',
            'password.required' => '密码不为空',
            'c_password.required' => '确认密码不为空',
            'password.regex'    => '密码必须为8-16位包含大小写字母和数字的组合',
            'c_password.same'   => '确认密码和密码不一致',
            'email.email'    => '邮箱格式不正确',
            'sex.boolean'       => '性别必须为布尔值',
            'photo.mimes'     => '上传图片类型格式不正确',
            'province.numeric' => '省id必须为数字',
            'city.numeric' => '市id必须为数字',
            'district.numeric' => '县区id必须为数字'
        ];
    }

}
