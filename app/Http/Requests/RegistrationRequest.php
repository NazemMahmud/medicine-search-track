<?php

namespace App\Http\Requests;

use App\Helpers\RequestValidationErrorFormat;

class RegistrationRequest extends RequestValidationErrorFormat
{
    protected $stopOnFirstFailure = true;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6'
        ];
    }
}
