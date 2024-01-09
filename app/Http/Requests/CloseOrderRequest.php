<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CloseOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order_id' => ['required', 'integer'],
            'kamar_id' => ['required', 'integer'],
            'version' => ['required', 'string'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'order_id.required' => 'ID Order tidak boleh kosong',
            'order_id.integer' => 'ID Order harus berupa angka',

            'kamar_id.required' => 'ID Kamar tidak boleh kosong',
            'kamar_id.integer' => 'ID Kamar harus berupa angka',

            'version.required' => 'Versi aplikasi tidak boleh kosong',
            'version.string' => 'Versi aplikasi harus berupa string',
        ];
    }
}
