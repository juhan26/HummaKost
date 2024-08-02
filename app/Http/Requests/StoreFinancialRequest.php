<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFinancialRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0|not_regex:/-/',
            'types' => ['required', Rule::in(['Income', 'Expense'])],
            'nominal' => 'required|numeric|min:0|not_regex:/-/',
            'payment_proof' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'status' => ['required', Rule::in(['Pending', 'Accepted', 'Rejected'])],
            'financial_date' => 'required|date',
        ];
    }
}
