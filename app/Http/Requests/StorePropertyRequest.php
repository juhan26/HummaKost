<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
            'name' => ['required', 'unique:properties,name'],
            'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,pdf', 'max:2048'],
            'langtitude' => ['required', 'numeric'],
            'longtitude' => ['required', 'numeric'],
        ];
    }

    public function messages(): array
{
    return [
        'name.required' => 'Nama wajib diisi.',
        'name.unique' => 'Nama sudah digunakan, silakan pilih nama lain.',
        'image.file' => 'Gambar harus berupa file.',
        'image.mimes' => 'Gambar harus berformat: jpeg, png, jpg, pdf.',
        'image.max' => 'Ukuran file gambar maksimal 2MB.',
        'langtitude.required' => 'Latitude wajib diisi.',
        'langtitude.numeric' => 'Latitude harus berupa angka.',
        'longtitude.required' => 'Longitude wajib diisi.',
        'longtitude.numeric' => 'Longitude harus berupa angka.',
    ];
}

}
