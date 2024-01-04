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
            'bukti' => ['required'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'order_id.required' => 'Order ID tidak boleh kosong',
            'order_id.integer' => 'Order ID harus berupa angka',

            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'tanggal.date' => 'Tanggal harus berupa tanggal',

            'jumlah.required' => 'Jumlah tidak boleh kosong',
            'jumlah.integer' => 'Jumlah harus berupa angka',

            'bukti.required' => 'Bukti tidak boleh kosong',
        ];
    }
}
