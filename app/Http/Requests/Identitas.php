<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Identitas extends FormRequest
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
            'nama' => ['required', 'min:5', 'max:16'],
            'telepon' => ['required', 'min:10', 'max:13'],
            'whatsapp' => ['required', 'min:10', 'max:13'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.min' => 'Nama minimal :min karakter',
            'nama.max' => 'Nama maksimal :max karakter',

            'telepon.required' => 'Nomor telepon tidak boleh kosong',
            'telepon.min' => 'Nomor telepon minimal :min karakter',
            'telepon.max' => 'Nomor telepon maksimal :max karakter',

            'whatsapp.required' => 'Nomor whatsapp tidak boleh kosong',
            'whatsapp.min' => 'Nomor whatsapp minimal :min karakter',
            'whatsapp.max' => 'Nomor whatsapp maksimal :max karakter',
        ];
    }
}
