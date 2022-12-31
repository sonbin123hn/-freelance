<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EKYCRequest extends ApiRequest
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
            "idFront" => 'required',
            "idBack" => 'required',
            "face" => 'required'
        ];
    }

    public function messages()
    {
        return [
            'idFront.required' => "idFront is required",
            'idBack.required' => "idBack is required",
            'face.required' => "face is required"
        ];
    }
}
