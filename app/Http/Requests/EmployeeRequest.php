<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            "link" => 'required',
            "name" => 'required',
            "type" => 'required',
        ];
    }

    public function messages()
    {
        return [
            'link.required' => "Đường dẫn chưa được nhập",
            'name.required' => "Tên chưa được nhập",
            'type.required' => "Loại chưa được nhập",
        ];
    }
}
