<?php

namespace App\Http\Requests;

use App\Helpers\RequestValidationErrorFormat;

class AddMedicationRequest extends RequestValidationErrorFormat
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'rxcui' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'rxcui.required' => 'rxcui field is missing.',
            'rxcui.string' => 'rxcui value must be a string.',
        ];
    }
}
