<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
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
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'document' => 'required|string|',
            'invoice_number' => 'required|string|',
            'subtotal' => 'numeric',
            'igv' => 'numeric',
            'total' => 'numeric',
            'status' => 'boolean',
            'store_id' => 'required',
            'details' => 'required|array', // Los detalles deben estar presentes
        ];
    }


    /**
     * Mensajes de error personalizados para las validaciones.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'supplier_id.required' => 'El proveedor es obligatorio.',
            'purchase_date.required' => 'La fecha es obligatoria.',
            'invoice_number.required' => 'Debe ingresar un número de factura.',
            'details.required' => 'La compra no tiene items.',
        ];
    }
}
