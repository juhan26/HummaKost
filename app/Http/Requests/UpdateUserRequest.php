<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required', Rule::unique('users', 'email')->ignore($this->user->id)],
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
            'password.required' => 'Kata sandi wajib diisi.',
        ];
    }
}
