<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFacilityRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique('facilities', 'name')->ignore($this->facility->id)],
            'description' => 'nullable|string|max:255',
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
            'name.max' => 'Nama maksimal 255 karakter.',
            'name.unique' => 'Nama sudah digunakan, silakan pilih nama lain.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'description.max' => 'Deskripsi maksimal 255 karakter.',
        ];
    }
}
