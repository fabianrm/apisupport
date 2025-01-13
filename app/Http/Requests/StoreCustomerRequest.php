<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
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
            'name' => ['required'],
            'document_type' => ['required', Rule::in(['dni', 'ruc', 'ce'])],
            'document_number' => ['required', 'unique:customers'],
            'email' => ['required', 'email', 'unique:customers'],
            'phone' => [''],
            'address' => [''],
            'status' => ['required'],
        ];
    }
}
