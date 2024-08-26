<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFacilityRequest extends FormRequest
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
            'photo' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
            'name' => ['required', 'string', 'max:50', Rule::unique('facilities', 'name')->ignore($this->facility->id)],
            'description' => 'nullable|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'photo.file' => 'Foto harus berupa file.',
            'photo.mimes' => 'Foto harus berformat: png, jpg, jpeg.',
            'photo.max' => 'Ukuran file foto maksimal 2MB.',
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 50 karakter.',
            'name.unique' => 'Fasilitas telah ada, silakan buat fasilitas lain.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'description.max' => 'Deskripsi maksimal 50 karakter.',
        ];
    }
}
