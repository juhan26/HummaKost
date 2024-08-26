<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstanceRequest extends FormRequest
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
            'name' => 'required|unique:instances,name',
            'address' => 'required|max:255',
            'description' => 'nullable|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'nama sekolah tidak boleh kosong',
            'name.unique' => 'nama sekolah sudah terdaftar',
            'address.required' => 'alamat tidak boleh kosong',
            'address.min' => 'karakter tidak boleh kurang dari 20',
            'address.max' => 'karakter tidak boleh lebih dari 255 karakter',
            'description.required' => 'deskripsi tidak boleh kosong',
            'description.min' => 'karakter tidak boleh kurang dari 10',
            'description.max' => 'karakter tidak boleh lebih dari 1000 karakter',

        ];
    }
}
