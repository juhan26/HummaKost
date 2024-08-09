<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'photo' => ['nullable', 'file', 'mimes:jpeg,png,jpg,pdf', 'max:2048'],
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'phone_number' => ['required'],
            'password' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'email tidak boleh sama',
        ];
    }
}
