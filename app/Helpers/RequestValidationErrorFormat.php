<?php

namespace App\Helpers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class RequestValidationErrorFormat extends FormRequest
{
    /**
     * Configure the validator instance.
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    public function withValidator(Validator $validator)
    {
        if ($validator->fails()) {
            $errors = $validator->errors();
            $error = [];
            foreach ($errors->messages() as $messages) {
                $error[] = $messages;
            }
            $errors = array_reduce($error, 'array_merge', array());
            throw new HttpResponseException(
                response()->json([
                    'error' => $errors[0],
                    'status' => Constants::FAILED,
                ], 422)
            );
        }
    }
}
