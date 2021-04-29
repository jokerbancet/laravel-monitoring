<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMahasiswaRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'nim' => 'required|numeric',
            'jk' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'jurusan' => 'required',
            'tahun_angkatan' => 'required|numeric',
            'avatar' => 'image|mimes:jpg,jpeg,png'
        ];
    }
    public function messages()
    {
        return [
            'nama.required' => 'Nama harus diisi.',
            'nama.min' => 'Nama minimal diisi 5 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nim.required' => 'Nomor Induk Mahasiswa wajib diisi.',
            'nim.numeric' => 'Nomor Induk Mahasiswa harus berisi angka.',
            'jk.required' => 'Jenis Kelamin wajib diisi.',
            'agama.required' => 'Agama wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'jurusan.required' => 'Jurusan wajib diisi.',
            'tahun_angkatan.required' => 'Tahun Angkatan wajib diisi.',
            'tahun_angkatan.numeric' => 'Tahun Angkatan harus berisi angka.',
            'avatar.image' => 'File harus gambar.',
            'avatar.mimes' => 'Avatar harus berekstensi .jpg, .jpeg, .png.'
        ];
    }
}
