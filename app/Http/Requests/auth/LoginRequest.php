<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'username' => ['required', 'min:3', 'max:16', 'alpha_dash'],
            'password' => ['required', 'min:8', 'max:16'],
            'version' => ['required', 'string'],
            'konfirmasi_login' => ['required', 'integer', 'in:1,0'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Username tidak boleh kosong',
            'username.min' => 'Username minimal :min karakter',
            'username.max' => 'Username maksimal :max karakter',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, strip, dan underscore',

            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal :min karakter',
            'password.max' => 'Password maksimal :max karakter',

            'version.required' => 'Versi tidak boleh kosong',
            'version.string' => 'Versi harus berupa string',

            'konfirmasi_login.required' => 'Konfirmasi login tidak boleh kosong',
            'konfirmasi_login.integer' => 'Konfirmasi login harus berupa angka',
            'konfirmasi_login.in' => 'Konfirmasi login harus bernilai 1 atau 0',
        ];
    }
}
