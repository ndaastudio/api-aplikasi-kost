<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'kamar_id' => ['required', 'integer'],
            'tanggal_masuk' => ['required', 'date'],
            'durasi' => ['required', 'integer'],
            'keterangan' => ['string', 'nullable'],
            'version' => ['required', 'string'],
            'penghuni' => ['required', 'array'],
            'penghuni.*.nama_customer' => ['required', 'string', 'min:3', 'max:255'],
            'penghuni.*.pekerjaan' => ['required', 'string', 'min:3', 'max:255'],
            'penghuni.*.telepon' => ['required', 'string', 'min:11', 'max:13'],
            'penghuni.*.whatsapp' => ['required', 'string', 'min:11', 'max:13'],
            'penghuni.*.ktp' => ['required', 'array'],
            'penghuni.*.ktp.base64String' => ['required', 'string'],
            'penghuni.*.ktp.format' => ['required', 'string', 'in:jpg,png'],
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
            'kamar_id.required' => 'ID Kamar tidak boleh kosong',
            'kamar_id.integer' => 'ID Kamar harus berupa angka',

            'tanggal_masuk.required' => 'Tanggal masuk tidak boleh kosong',
            'tanggal_masuk.date' => 'Tanggal masuk harus berupa tanggal',

            'durasi.required' => 'Durasi tidak boleh kosong',
            'durasi.integer' => 'Durasi harus berupa angka',

            'keterangan.string' => 'Keterangan harus berupa string',

            'version.required' => 'Versi tidak boleh kosong',
            'version.string' => 'Versi harus berupa string',

            'penghuni.required' => 'Data penghuni tidak boleh kosong',
            'penghuni.array' => 'Data penghuni harus berupa array',

            'penghuni.*.nama_customer.required' => 'Nama penghuni tidak boleh kosong',
            'penghuni.*.nama_customer.string' => 'Nama penghuni harus berupa string',
            'penghuni.*.nama_customer.min' => 'Nama penghuni minimal :min karakter',
            'penghuni.*.nama_customer.max' => 'Nama penghuni maksimal :max karakter',

            'penghuni.*.pekerjaan.required' => 'Pekerjaan penghuni tidak boleh kosong',
            'penghuni.*.pekerjaan.string' => 'Pekerjaan penghuni harus berupa string',
            'penghuni.*.pekerjaan.min' => 'Pekerjaan penghuni minimal :min karakter',
            'penghuni.*.pekerjaan.max' => 'Pekerjaan penghuni maksimal :max karakter',

            'penghuni.*.telepon.required' => 'Nomor telepon penghuni tidak boleh kosong',
            'penghuni.*.telepon.string' => 'Nomor telepon penghuni harus berupa string',
            'penghuni.*.telepon.min' => 'Nomor telepon penghuni minimal :min karakter',
            'penghuni.*.telepon.max' => 'Nomor telepon penghuni maksimal :max karakter',

            'penghuni.*.whatsapp.required' => 'Nomor WhatsApp penghuni tidak boleh kosong',
            'penghuni.*.whatsapp.string' => 'Nomor WhatsApp penghuni harus berupa string',
            'penghuni.*.whatsapp.min' => 'Nomor WhatsApp penghuni minimal :min karakter',
            'penghuni.*.whatsapp.max' => 'Nomor WhatsApp penghuni maksimal :max karakter',

            'penghuni.*.ktp.required' => 'KTP penghuni tidak boleh kosong',
            'penghuni.*.ktp.array' => 'KTP penghuni harus berupa array',

            'penghuni.*.ktp.base64String.required' => 'Foto KTP penghuni tidak boleh kosong',
            'penghuni.*.ktp.base64String.string' => 'Foto KTP penghuni harus berupa string',

            'penghuni.*.ktp.format.required' => 'Format foto KTP penghuni tidak boleh kosong',
            'penghuni.*.ktp.format.string' => 'Format foto KTP penghuni harus berupa string',
            'penghuni.*.ktp.format.in' => 'Format foto KTP penghuni harus berupa jpg atau png',
        ];
    }
}
