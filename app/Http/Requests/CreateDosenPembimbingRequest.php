<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDosenPembimbingRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'nidn' => 'required|numeric',
            'jk' => 'required',
            'avatar' => 'image|mimes:jpg,jpeg,png'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama depan harus diisi.',
            'nama.min' => 'Nama depan harus diisi minimal 5 karakter.',
            'gelar_belakang.required' => 'Gelar Belakang harus diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nidn.required' => 'Nomor Induk Dosen Nasional wajib diisi.',
            'nidn.numeric' => 'Nomor Induk Dosen Nasional harus berisi angka.',
            'jk.required' => 'Jenis Kelamin wajib diisi.',
            'avatar.image' => 'File harus gambar.',
            'avatar.mimes' => 'Avatar harus berekstensi .jpg, .jpeg, .png.'
        ];
    }
}
