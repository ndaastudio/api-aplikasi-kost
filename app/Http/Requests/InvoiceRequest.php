<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'tanggal' => ['required', 'date'],
            'jumlah' => ['required', 'integer'],
            'bukti' => ['required', 'array'],
            'bukti.base64String' => ['required', 'string'],
            'bukti.format' => ['required', 'string', 'in:jpg,png'],
            'version' => ['required', 'string']
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

            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'tanggal.date' => 'Tanggal harus berupa tanggal',

            'jumlah.required' => 'Jumlah tidak boleh kosong',
            'jumlah.integer' => 'Jumlah harus berupa angka',

            'bukti.required' => 'Bukti tidak boleh kosong',
            'bukti.array' => 'Bukti harus berupa object',

            'bukti.base64String.required' => 'Bukti tidak boleh kosong',
            'bukti.base64String.string' => 'Bukti harus berupa string',

            'bukti.format.required' => 'Format bukti tidak boleh kosong',
            'bukti.format.string' => 'Format bukti harus berupa string',
            'bukti.format.in' => 'Format bukti harus berupa jpg atau png',

            'version.required' => 'Versi aplikasi tidak boleh kosong',
            'version.string' => 'Versi aplikasi harus berupa string',
        ];
    }
}
