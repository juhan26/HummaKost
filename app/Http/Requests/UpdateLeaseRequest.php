<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaseRequest extends FormRequest
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
            // 'user_id' => 'required|exists:users,id',
            // 'property_id' => 'required|exists:properties,id',
            // 'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required',
            // 'status' => 'required|in:active,inactive,pending,expired',
            'description' => 'nullable|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'end_date.required' => 'Tanggal akhir wajib diisi.',
            // 'end_date.date' => 'Tanggal akhir harus berupa tanggal yang valid.',
            // 'end_date.after' => 'Tanggal akhir harus setelah tanggal mulai.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'description.max' => 'Deskripsi maksimal 255 karakter.',
        ];
    }
}
