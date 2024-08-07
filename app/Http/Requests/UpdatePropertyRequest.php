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
            'langtitude' => ['required', 'numeric'],
            'longtitude' => ['required', 'numeric'],
        ];
    }
}
