<?php
namespace App\Http\Lib;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Lib\UnifiedResponse;
use Illuminate\Http\Response;

class ValidationResponse extends FormRequest {
    use UnifiedResponse;
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(self::Response(Response::HTTP_BAD_REQUEST, 'Error', $validator->errors()));
    }
}