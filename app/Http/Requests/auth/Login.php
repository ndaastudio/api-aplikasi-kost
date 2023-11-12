<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest
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
            'password' => ['required', 'min:8', 'max:16']
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
        ];
    }
}
