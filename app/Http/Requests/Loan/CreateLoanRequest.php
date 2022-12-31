<?php

namespace App\Http\Requests\Loan;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateLoanRequest extends ApiRequest
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
            "loanValue" => 'required',
            "loanTime" => 'required|in:6,12,24,36,48,60',
            "signature" => 'required',
        ];
    }

    public function messages()
    {
        return [
            'loanValue.required' => "loanValue is required",
            'loanTime.required' => "loanTinme is required",
            'loanTime.in' => "loanTime in 6,12,24,36,48,60",
            'signature.required' => "signature is required",

        ];
    }
}
