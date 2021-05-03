<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditIndikatorCapaianRequest extends FormRequest
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
            'jurusan' => 'required',
            'deskripsi_capaian' => 'required|min:5',
            'kategori_capaian' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'jurusan.required' => 'Jurusan/Prodi harus diisi.',
            'deskripsi_capaian.required' => 'Deskripsi Indikator Capaian harus diisi.',
            'deskripsi_capaian.min' => 'Deskripsi Indikator Capaian minimal 5 karakter.',
            'kategori_capaian.required' => 'Kategori Capaian harus diisi.',
        ];
    }
}
