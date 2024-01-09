<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmInvoiceRequest extends FormRequest
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
            'invoice_id' => ['required', 'integer'],
            'kos_id' => ['required', 'integer'],
            'version' => ['required', 'string'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'invoice_id.required' => 'ID Invoice tidak boleh kosong',
            'invoice_id.integer' => 'ID Invoice harus berupa angka',

            'kos_id.required' => 'ID Kos tidak boleh kosong',
            'kos_id.integer' => 'ID Kos harus berupa angka',

            'version.required' => 'Versi aplikasi tidak boleh kosong',
            'version.string' => 'Versi aplikasi harus berupa string',
        ];
    }
}
