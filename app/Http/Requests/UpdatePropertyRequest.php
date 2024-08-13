<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePropertyRequest extends FormRequest
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
            'name' => ['required', Rule::unique('properties', 'name')->ignore($this->route('property'))],
            'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,pdf', 'max:2048'],
            'rental_price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'numeric', 'min:0', 'not_regex:/-/'],
            'gender_target' => ['required', 'string', 'max:50'],
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
            'image.mimes' => 'Gambar harus berformat: jpeg, png, jpg, atau pdf.',
            'image.max' => 'Ukuran file gambar maksimal 2MB.',
            'rental_price.required' => 'Harga sewa wajib diisi.',
            'rental_price.numeric' => 'Harga sewa harus berupa angka.',
            'rental_price.min' => 'Harga sewa tidak boleh kurang dari 0.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'description.max' => 'Deskripsi tidak boleh lebih dari 255 karakter.',
            'address.required' => 'Alamat wajib diisi.',
            'address.string' => 'Alamat harus berupa teks.',
            'address.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            'capacity.required' => 'Kapasitas wajib diisi.',
            'capacity.numeric' => 'Kapasitas harus berupa angka.',
            'capacity.min' => 'Kapasitas tidak boleh kurang dari 0.',
            'capacity.not_regex' => 'Kapasitas tidak boleh mengandung tanda minus (-).',
            'gender_target.required' => 'Target gender wajib diisi.',
            'gender_target.string' => 'Target gender harus berupa teks.',
            'gender_target.max' => 'Target gender tidak boleh lebih dari 50 karakter.',
            'langtitude.required' => 'Latitude wajib diisi.',
            'langtitude.numeric' => 'Latitude harus berupa angka.',
            'longtitude.required' => 'Longitude wajib diisi.',
            'longtitude.numeric' => 'Longitude harus berupa angka.',
        ];
    }
}
