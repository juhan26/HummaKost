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
            'phone_number' => ['required', 'numeric', 'min_digits:4', 'max_digits:20','min:1'],
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
            'phone_number.min_digits' => 'Nomor telepon minimal harus terdiri dari 8 digit.',
            'phone_number.max_digits' => 'Nomor telepon maksimal harus terdiri dari 20 digit.',
            'phone_number.min' => 'Nomor telepon tidak boleh minus',
            'division.string'   => 'divisi harus berupa teks.',
            'gender.required'   => 'Jenis kelamin harus diisi.',
            'gender.string'     => 'Jenis kelamin harus berupa teks.',
            'gender.in'         => 'Jenis kelamin harus salah satu dari pilihan berikut: Laki-laki, Perempuan.',
        ];
    }
}
