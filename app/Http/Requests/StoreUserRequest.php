<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Lib\UnifiedResponse;
use Illuminate\Http\Response;


class StoreUserRequest extends FormRequest
{
    use UnifiedResponse;
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
            "userName" => "required|min:4|max:50",
            "email" => "required|email|unique:users,email,$this->user,id",
            "phoneNumber" => "required|unique:users,phoneNumber,$this->user,id",
            "dateOfBirth" => "required|date|date_format:Y-m-d",
            "password" => "required|min:6"
        ];
    }

    public function messages() {
        return [
            'userName.required' => 'User name is required.',
            'userName.min' => 'User name must be at least 4 character.',
            'userName.max' => 'User name mus be less than 50 character.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email is not valid.',
            'email.unique' => 'Email is already used.',
            'phoneNumber.required' => 'Phone number is required.',
            'phoneNumber.unique' => 'Phone number is already used.',
            'dateOfBirth.required' => 'Date of birth is required.',
            'dateOfBirth.date' => 'Date of birth must be a date.',
            'dateOfBirth.date_format' => 'Invalid date format, Date format should be yyyy-mm-dd.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 character.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // var_dump($validator->errorBag());
        // return $validator->errors();
        throw new HttpResponseException(self::Response(Response::HTTP_BAD_REQUEST, 'Error', $validator->errors()));
    }
}
