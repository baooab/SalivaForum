<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,username,' . Auth::id(),
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'introduction' => 'max:80',
        ];
    }

    public function messages()
    {
       return [
           'username.unique' => '用户名已被占用，请重新填写',
           'username.regex' => '用户名只支持中英文、数字、横杆和下划线。',
           'username.between' => '用户名必须介于 3 - 25 个字符之间。',
           'username.required' => '用户名不能为空。',
       ];
    }
}
