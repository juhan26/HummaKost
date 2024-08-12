<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'lease_id' => ['required', 'exists:leases,id'],
            // 'month' => ['required', 'string', 'max:255'],
            // 'nominal' => ['required', 'numeric', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }
}
