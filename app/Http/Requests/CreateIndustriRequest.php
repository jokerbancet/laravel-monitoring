<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateIndustriRequest extends FormRequest
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
            'nama_industri' => 'required|min:3',
            'kategori_industri' => 'required',
            'email' => 'required|email',
            'alamat' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'nama_industri.required' => 'Nama Industri harus diisi.',
            'nama_industri.min' => 'Nama Industri minimal diisi 3 karakter.',
            'kategori_industri.required' => 'Kategori Industri harus diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.'
        ];
    }
}
