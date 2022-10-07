<?php

namespace App\Support\Http;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class Request extends FormRequest
{
    protected $errorMessage;

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
        return [];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        $message = $this->errorMessage ?? 'Erro na validação de dados';

        throw new HttpResponseException(response()->json(['message' => $message, 'errors' => $errors, 'code' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
