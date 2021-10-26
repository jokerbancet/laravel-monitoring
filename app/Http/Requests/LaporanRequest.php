<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function rules()
    {
        return [
            'kegiatan_pekerjaan' => 'required',
            'deskripsi_pekerjaan' => 'required',
            'output' => 'required',
            'durasi' => 'required',
            'capaian_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'kegiatan_pekerjaan.required' => 'Kegiatan Pekerjaan harus diisi.',
            'deskripsi_pekerjaan.required' => 'Deskripsi Pekerjan harus diisi.',
            'output.required' => 'Output Pekerjaan harus diisi.',
            'durasi.required' => 'Durasi Pekerjaan harus diisi.',
            'capaian_id.required' => 'Capaian Pekerjaan harus diisi.'
        ];
    }
}
