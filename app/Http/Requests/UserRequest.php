<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username' => ['required', 'min:3', 'max:16', 'alpha_dash', 'unique:users,username'],
            'password' => ['required', 'min:8', 'max:16', 'confirmed'],
            'password_confirmation' => ['required', 'min:8', 'max:16', 'same:password'],
            'level' => ['required', 'integer', 'in:0,1'],
            'version' => ['required', 'string'],
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
            'username.unique' => 'Username sudah terdaftar',

            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal :min karakter',
            'password.max' => 'Password maksimal :max karakter',
            'password.confirmed' => 'Password tidak cocok dengan kolom konfirmasi password',

            'password_confirmation.required' => 'Konfirmasi password tidak boleh kosong',
            'password_confirmation.min' => 'Konfirmasi password minimal :min karakter',
            'password_confirmation.max' => 'Konfirmasi password maksimal :max karakter',
            'password_confirmation.same' => 'Konfirmasi password tidak cocok dengan kolom password',

            'level.required' => 'Level tidak boleh kosong',
            'level.integer' => 'Level harus berupa angka',
            'level.in' => 'Level hanya boleh 0 (Penjaga) atau 1 (Pemilik)',

            'version.required' => 'Versi aplikasi tidak boleh kosong',
            'version.string' => 'Versi aplikasi harus berupa string',
        ];
    }
}
