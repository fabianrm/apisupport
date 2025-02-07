<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
        $method = $this->method();
        if ($method === "PUT") {
            return [
                'name' => ['required'],
                'document_id' => ['required' ],
                'document_number' => ['required', 'unique:customers'],
                'email' => ['required', 'email', 'unique:customers'],
                'phone' => [''],
                'address' => [''],
                'status' => ['required'],
            ];
        } else {
            return [
                'name' => ['sometimes', 'required'],
                'document_id' => ['sometimes', 'required'],
                'document_number' => ['sometimes', 'required',],
                'email' => ['sometimes','required', 'email',],
                'phone' => ['sometimes', ''],
                'address' => ['sometimes', ''],
                'status' => ['sometimes', 'required'],
            ];
        }
    }
}
