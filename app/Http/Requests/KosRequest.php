<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KosRequest extends FormRequest
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
            'nama_kos' => ['required', 'min:5', 'max:16'],
            'alamat' => ['required', 'min:10', 'max:255'],
            'provinsi' => ['required', 'integer'],
            'kota' => ['required', 'integer'],
            'kecamatan' => ['required', 'min:5', 'max:255'],
            'kelurahan' => ['required', 'min:5', 'max:255'],
            'jumlah_kamar' => ['required', 'integer'],
            'version' => ['required', 'string'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nama_kos.required' => 'Nama kos tidak boleh kosong',
            'nama_kos.min' => 'Nama kos minimal :min karakter',
            'nama_kos.max' => 'Nama kos maksimal :max karakter',

            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.min' => 'Alamat minimal :min karakter',
            'alamat.max' => 'Alamat maksimal :max karakter',

            'provinsi.required' => 'Provinsi tidak boleh kosong',
            'provinsi.integer' => 'Provinsi harus berupa angka',

            'kota.required' => 'Kota tidak boleh kosong',
            'kota.integer' => 'Kota harus berupa angka',

            'kecamatan.required' => 'Kecamatan tidak boleh kosong',
            'kecamatan.min' => 'Kecamatan minimal :min karakter',
            'kecamatan.max' => 'Kecamatan maksimal :max karakter',

            'kelurahan.required' => 'Kelurahan tidak boleh kosong',
            'kelurahan.min' => 'Kelurahan minimal :min karakter',
            'kelurahan.max' => 'Kelurahan maksimal :max karakter',

            'jumlah_kamar.required' => 'Jumlah kamar tidak boleh kosong',
            'jumlah_kamar.integer' => 'Jumlah kamar harus berupa angka',

            'version.required' => 'Versi aplikasi tidak boleh kosong',
            'version.string' => 'Versi aplikasi harus berupa string',
        ];
    }
}
