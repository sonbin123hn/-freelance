<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends ApiRequest
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
            'phoneNumber' => 'required|regex:/^[0-9]+$/|unique:users',
            'password' => 'required|string|confirmed|min:6'
        ];
    }

    public function messages()
    {
        return [
            'phoneNumber.required' => "phải nhập số điện thoại", 
            'phoneNumber.regex' => "sai định dạng", 
            'phoneNumber.unique' => "số điện thoại đã được sử dụng",
            'password.required' => "phải nhập mật khẩu"
        ];
    }
}
