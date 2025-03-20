<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ValidatorResponseTrait
{
    protected function failedValidation(Validator $validator)
    {
        $response = [
            'status' => "error",
            'message' => implode(',', $validator->errors()->all())
        ];
        throw new HttpResponseException(response()->json($response, 422));
    }
}
