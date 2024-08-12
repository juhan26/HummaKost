<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyFurnitureRequest extends FormRequest
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
            'property_id' => 'required|exists:properties,id',
            'furniture_id' => 'required|exists:furniture,id'
        ];
    }

    public function messages(): array
    {
        return [
            'property_id.required' => 'ID properti wajib diisi.',
            'property_id.exists' => 'Properti tidak ditemukan.',
            'furniture_id.required' => 'ID furnitur wajib diisi.',
            'furniture_id.exists' => 'Furnitur tidak ditemukan.',
        ];
    }
}
