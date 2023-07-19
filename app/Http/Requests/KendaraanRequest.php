<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class KendaraanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // dd(Request::route()->getName());
        $rules = [
            'tahun_keluaran' => ['required'],
            'warna' => ['required'],
            'harga' => ['required'],
            'type' => ['required'],
            'kendaraanable_id' => ['required'],
        ];

        return $rules;
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => 'Kolom :attribute harus di isi',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            Response::json([
                'message' => 'Something wrong with your data',
                'error' => true,
                'status' => 'error',
                'result' => collect($errors)->flatten()->toArray(),
            ], HttpResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
