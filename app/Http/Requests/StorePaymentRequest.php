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
            'payment_date' => ['required', 'date'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'lease_id.required' => 'ID sewa wajib diisi.',
            'lease_id.exists' => 'ID sewa tidak ditemukan.',
            'payment_date.required' => 'Tanggal pembayaran tidak boleh kosong.',
            'payment_date.date' => 'Tanggal pembayaran harus berformat tanggal.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'description.max' => 'Deskripsi maksimal 255 karakter.',
        ];
    }
}
