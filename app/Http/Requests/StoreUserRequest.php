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
            'email' => ['required', 'unique:users,email'],
            'phone_number' => ['required','numeric','min_digits:8','max_digits:20'],
            'password' => ['required'],
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
        'password.required' => 'Kata sandi wajib diisi.',
    ];
}

}
