<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePembimbingIndustriRequest extends FormRequest
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

    public function rules()
    {
        return [
            'nama_depan' => 'required|min:3',
            'nama_belakang' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'jk' => 'required',
            'avatar' => 'image|mimes:jpg,jpeg,png'
        ];
    }

    public function messages()
    {
        return [
            'nama_depan.required' => 'Nama depan harus diisi.',
            'nama_depan.min' => 'Nama depan harus diisi minimal 3 karakter.',
            'nama_belakang.required' => 'Nama belakang harus diisi.',
            'nama_belakang.min' => 'Nama belakang harus diisi minimal 3 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'jk.required' => 'Jenis Kelamin wajib diisi.',
            'avatar.image' => 'File harus gambar.',
            'avatar.mimes' => 'Avatar harus berekstensi .jpg, .jpeg, .png.'
        ];
    }
}
