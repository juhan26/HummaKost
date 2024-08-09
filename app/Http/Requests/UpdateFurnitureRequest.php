<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFurnitureRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique('furnitures', 'name')->ignore($this->route('furniture'))],
            'description' => 'nullable|string|max:255',
        ];
    }
}
