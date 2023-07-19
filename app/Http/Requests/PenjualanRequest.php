<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PenjualanRequest extends FormRequest
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
        $id = Route::current()->penjualan;
        $rules = [
            'pembeli' => ['required'],
            'telpon' => ['required'],
            'kendaraan_id' => ['required', Rule::unique('penjualans')->ignore($id, '_id')],
            'netto' => ['required', 'numeric'],
            'bruto' => ['required', 'numeric'],
            'discount' => ['required', 'numeric', 'lte:bruto'],
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
            'numeric' => ':attribute harus angka',
            'lte' => 'Nilai :attribute tidak boleh lebih besar dari :value',
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
