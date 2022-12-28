<?php

namespace App\Http\Requests;

use App\Traits\MessageReturn;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;


class ApiRequest extends FormRequest
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
    public function failedValidation(Validator $validator)
    {
        $errors = MessageReturn::convertArrayMessage($validator->errors()->toArray());
        throw new HttpResponseException(response()->json([
            'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $errors,
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

}
