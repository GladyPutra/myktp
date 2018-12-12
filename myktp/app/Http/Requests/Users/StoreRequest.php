<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
             'name' => 'Required',
             'nik' => 'Required|unique:users|numeric',
             'password' => 'Required|min:6'
         ];
     }

     public function messages()
     {
         return [
             'name.required' => 'Nama Lengkap Tidak Boleh Kosong',
             'nik.required' => 'NIK Tidak Boleh Kosong',
             'nik.numeric' => 'NIK Harus Numerik',
             'nik.unique' => 'NIK Sudah Terdaftar',
             'password.min' => 'Password Minimal 6 Karakter',
         ];
     }
}
