<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchaseRequest extends FormRequest
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
                'supplier_id' => ['required'],
                'purchase_date' => ['required'],
                'invoice_number' => ['required'],
                'subtotal' => ['required'],
                'igv' => ['required'],
                'total' => ['required'],
                'status' => ['required']
            ];
        } else {
            return [
                'supplier_id' => ['sometimes','required'],
                'purchase_date' => ['sometimes','required'],
                'invoice_number' => ['sometimes','required'],
                'subtotal' => ['sometimes','required'],
                'igv' => ['sometimes','required'],
                'total' => ['sometimes','required'],
                'status' => ['sometimes','required']
            ];
        }
    }
}
