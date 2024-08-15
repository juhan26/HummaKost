<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyFacilityRequest extends FormRequest
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
            'facility_id' => 'required|exists:facilities,id'
        ];
    }

    public function messages(): array
    {
        return [
            'property_id.required' => 'ID properti wajib diisi.',
            'property_id.exists' => 'Properti tidak ditemukan.',
            'facility_id.required' => 'ID furnitur wajib diisi.',
            'facility_id.exists' => 'Furnitur tidak ditemukan.',
        ];
    }
}
