<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseDetailRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'store_id' => 'required|exists:stores,id',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'remaining_quantity' => '',
            'model' => '',
            'serial' => '',
            'imei' => '',
            'ubication_detail' => 'string'
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
            'product_id.required' => 'El campo product_id es obligatorio.',
            'product_id.exists' => 'El producto seleccionado no existe.',
            'store_id.required' => 'El campo store_id es obligatorio.',
            'store_id.exists' => 'La tienda seleccionada no existe.',
            'purchase_price.required' => 'El campo purchase_price es obligatorio.',
            'purchase_price.numeric' => 'El campo purchase_price debe ser un número.',
            'sale_price.required' => 'El campo sale_price es obligatorio.',
            'sale_price.numeric' => 'El campo sale_price debe ser un número.',
            'quantity.required' => 'El campo quantity es obligatorio.',
            'quantity.integer' => 'El campo quantity debe ser un número entero.',
            'quantity.min' => 'El campo quantity debe ser al menos 1.',
        ];
    }
}
