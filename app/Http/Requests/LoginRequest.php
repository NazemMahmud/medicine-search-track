<?php

namespace App\Http\Requests;

use App\Helpers\RequestValidationErrorFormat;

class LoginRequest extends RequestValidationErrorFormat
{
    protected $stopOnFirstFailure = true;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }
}
