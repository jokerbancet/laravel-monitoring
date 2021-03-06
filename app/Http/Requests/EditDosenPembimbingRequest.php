<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditDosenPembimbingRequest extends FormRequest
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
            'nama' => 'required|min:5',
            'gelar_belakang' => 'required',
            'nidn' => 'required|numeric',
            'jk' => 'required',
            'avatar' => 'image|mimes:jpg,jpeg,png'
        ];
    }

    public function messages()
    {
        return [
            'nama_depan.required' => 'Nama depan harus diisi.',
            'nama_depan.min' => 'Nama depan harus diisi minimal 5 karakter.',
            'gelar_belakang.required' => 'Gelar Belakang harus diisi.',
            'nidn.required' => 'Nomor Induk Dosen Nasional wajib diisi.',
            'nidn.numeric' => 'Nomor Induk Dosen Nasional harus berisi angka.',
            'jk.required' => 'Jenis Kelamin wajib diisi.',
            'avatar.image' => 'File harus gambar.',
            'avatar.mimes' => 'Avatar harus berekstensi .jpg, .jpeg, .png.'
        ];
    }
}
