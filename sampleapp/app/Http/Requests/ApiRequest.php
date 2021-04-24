<?php
declare(strict_types=1);

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

abstract class ApiRequest extends FormRequest
{
    //Validate route params
    public function validationData(): ?array
    {
        return $this->route()->parameters() + $this->all();
    }

    protected function failedValidation(Validator $validator)
    {
        $response['message'] = 'Failed validation.';
        $response['errors'] = $validator->errors()->toArray();
        throw new HttpResponseException(
            response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
