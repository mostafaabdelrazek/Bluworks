<?php

namespace App\Http\Requests;

use App\Http\Lib\ValidationResponse;

class LoginUserRequest extends ValidationResponse
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
            "userName" => "required|min:4|max:50",
            "password" => "required|min:6"
        ];
    }

    public function messages() {
        return [
            'userName.required' => 'User name is required.',
            'userName.min' => 'User name must be at least 4 character.',
            'userName.max' => 'User name mus be less than 50 character.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 character.'
        ];
    }
}
