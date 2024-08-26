<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'photo' => ['nullable', 'file', 'mimes:jpeg,png,jpg,pdf', 'max:2048'],
            'name' => ['required'],
            'division' => ['nullable', 'string'],
            'gender'   => ['required', 'string', 'in:male,female'],
            'email' => ['required', 'unique:users,email'],
            'phone_number' => ['required', 'numeric', 'not_regex:/-/', 'min:12', 'max:15'],
        ];
    }

    public function messages(): array
    {
        return [
            'photo.file' => 'Foto harus berupa file.',
            'photo.mimes' => 'Foto harus berformat: jpeg, png, jpg, pdf.',
            'photo.max' => 'Ukuran file foto maksimal 2MB.',
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan, silakan gunakan email lain.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.numeric' => 'Nomor telepon harus berupa angka.',
            'phone_number.min' => 'Nomor telepon minimal harus memiliki 12 karakter',
            'phone_number.max' => 'Nomor telepon maksimal memiliki 15 karakter',
            'phone_number.not_regex' => 'Nomor telepon tidak boleh terdapat minus',
            'division.string'   => 'divisi harus berupa teks.',
            'gender.required'   => 'Jenis kelamin harus diisi.',
            'gender.string'     => 'Jenis kelamin harus berupa teks.',
            'gender.in'         => 'Jenis kelamin harus salah satu dari pilihan berikut: Laki-laki, Perempuan.',
        ];
    }
}
